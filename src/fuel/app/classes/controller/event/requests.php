<?php // fuel/app/classes/controller/event/requests.php

class Controller_Event_Requests extends Controller_Base
{
	public function before()
	{
		parent::before();
		{
			// アクセス権を確認
			if (!Auth::has_access('userPage.browse')) {
				Session::set_flash('error', 'アクセス権がありません');
				Response::redirect('404');
			}
			$this->template = View::forge('template'); // テンプレート
		}
	}

	/**
     * イベント申請一覧
     */
	public function action_index()
	{
		$query = Model_Event_Request::BuildSearchQuery(Input::get());
		$query->order_by('id', 'desc');

		$data = Input::get();
		$count = $query->count();
		$pagination = myPagination::create($count,20);
		$data["per_page"] = $pagination->per_page;
		$data["page"] = $pagination->current_page;
		$data["pagination"] = $pagination;
		$data['requests'] = $query->limit($pagination->per_page)->offset($pagination->offset)->get();
		$data['count'] = $count;
		$data['total_count'] = Model_Event_Request::count();

		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'event.js';
		$this->template->extra_css = 'event.css';

		$this->template->page_id = 'index'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'イベント申請リトス';
		$this->template->page_title_inner_en = 'EVENT REQUEST LIST';
		$this->template->page_title_inner_jp = 'イベント申請リスト';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$this->template->content = View::forge('event_requests/index', $data); // コンテンツ
	}

	/**
     * edit
     */
	public function action_edit($id = null)
	{
		$event = Model_Event_Request::find($id);

		if (empty($event)) {
			Response::redirect('event/requests/');
		}
		if (Input::method() == 'POST')
		{
			$val = Model_Event_Request::validate('edit', $id);
			if ($val->run())
			{
				$event->title = Input::post('title');
                $event->status = Input::post('status');

				if ($event->save())
				{
					Session::set_flash('success', 'イベント申請情報を更新しました');
					Response::redirect('event/requests/');
				}
				else
				{
					Session::set_flash('error', 'イベント申請情報を更新できませんでした');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'event.js';
		$this->template->extra_css = 'event.css';

		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'イベント申請登録情報編集'; //ページ名
		$this->template->page_title_inner_en = 'EVENT REQUEST EDIT';
		$this->template->page_title_inner_jp = 'イベント申請編集';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$data['event'] = $event;
		$this->template->content = View::forge('event_requests/edit', $data); // コンテンツ
	}
    /**
     * add
     * WordPress側からgetパラメータ付きで呼ばれてfuel側でも登録できるようにする
     */
	public function action_add()
	{

        if (Input::method() == 'POST')
            $event = Model_Event::find(Input::post("event_id"));
        else 
            $event = Model_Event::find(Input::get("event_id"));
        
        if (empty($event)) {
			Response::redirect('mypage/');
		}

        $query = DB::select('interview_items.id', 'interview_items.event_id','interview_items.item_name',
        'interview_items.type','interview_items.other_check','interview_items.select_max','interview_items.required')
         ->from('interview_items') 
         ->where('interview_items.event_id','=',$event->id) ->order_by('sort_no', 'asc');
        $interview_items = $query->execute();
        $postback=Input::post("postback");
       
		if (Input::method() == 'POST' && !isset($postback))
		{
          
			// キャンセルされていない同じイベントの重複追加は、させない
			$request = Model_Event_Request::query()
					 ->where('user_id', $this->current_user->id)
					 ->where('event_id', Input::post('event_id'))
					 ->where('status', '!=', 99)
					 ->get_one();
			if (!empty($request)) {
				Session::set_flash('error', '既に申請済みのイベントです');
				Response::redirect_back();
			}
			else
			{
                if(count($interview_items)==0){
                    $requestSave = Model_Event_Request::forge(array(
                'user_id' => $this->current_user->id,
                'event_id' => Input::post('event_id'),
                'status' => Input::post('status'),
                'approval' =>0
                // 使わない 'waiting_order' => Input::post('waiting_order'),
				));
                    if ($requestSave->save())
                    {
                        if ($requestSave->status == Model_Event_Request::STATUS_CANCEL_WAIT) {
                            // キャンセル待ちに入る
                            SendMail::notifyEventRequestWaiting($requestSave->id); // メール送信
                            Session::set_flash('success', 'イベント申請はキャンセル待ちに入りました');
                        } else {
                            // 申請を受付
                            SendMail::notifyEventRequestAdd($requestSave->id); // メール送信
                            Session::set_flash('success', ['イベント申し込みを受け付けました。', 'また、審査があるイベントの場合、後日結果をご連絡いたしますので、メール到着までお待ちくださいませ。']);
                        }
                        Response::redirect('mypage/');
                        die;
                    }
                    else
                    {
                        Session::set_flash('error', 'イベント申請を追加できませんでした');
                    }
                }

                
                $data_s=[];
                foreach($interview_items as $item)
                {
                    $data_s['s_'.$item['id']]['id']=$item['id'];
                    $data_s['s_'.$item['id']]['event_id']=$item['event_id'];
                    $data_s['s_'.$item['id']]['name']=$item['item_name'];
                    $data_s['s_'.$item['id']]['type']=$item['type'];
                    if($item['type']==1  )
                    {
                        $data_s['s_'.$item['id']]['value']='';
                        $data_s['s_'.$item['id']]['text']=Security::strip_tags(Input::post('item_'.$item['id'].'_name'));
                    }
                    else if ($item['type']==2)
                    {
                        $data_s['s_'.$item['id']]['text']= Security::strip_tags(Input::post('other_check_'.$item['id']));
                        $data_s['s_'.$item['id']]['value']=Input::post('radio_'.$item['id']);
                    }
                    else if ($item['type']==3){
                        $data_s['s_'.$item['id']]['text']= Security::strip_tags(Input::post('other_check_'.$item['id']));;
                        $data_s['s_'.$item['id']]['value']= Input::post('check'.$item['id'] );
                    }
                    else if (  $item['type']==4)
                    {
                        $data_s['s_'.$item['id']]['value']='';
                        $data_s['s_'.$item['id']]['text']= strip_tags( Input::post('item_'.$item['id'].'_name'));

                    }
                }
                Session::set('data_interview_'.Input::post('event_id'), $data_s);

          
                if ($this->check_validate($interview_items))
                {
                    $data['event_id']=Input::post('event_id');
                    $data['item_name']=Input::post('item_name');
                    // $this->template->content = View::forge('event_requests/confirm', $data); // コンテンツ
                    Response::redirect('event/requests/confirm?event_id='.Input::post('event_id'));
                    die;
                }
                else 
                {
                    
                    //Response::redirect('event/requests/add?event_id='.Input::post('event_id'));
                    //die;
                }
                
                
                /*
				$request = Model_Event_Request::forge(array(
                'user_id' => $this->current_user->id,
                'event_id' => Input::post('event_id'),
                'status' => Input::post('status'),
                // 使わない 'waiting_order' => Input::post('waiting_order'),
				));
				if ($request->save())
				{
                if ($request->status == Model_Event_Request::STATUS_CANCEL_WAIT) {
                // キャンセル待ちに入る
                SendMail::notifyEventRequestWaiting($request->id); // メール送信
                Session::set_flash('success', 'イベント申請はキャンセル待ちに入りました');
                } else {
                // 申請を受付
                SendMail::notifyEventRequestAdd($request->id); // メール送信
                Session::set_flash('success', 'イベント申請を追加しました');
                }
                Response::redirect('mypage/');
				}
				else
				{
                Session::set_flash('error', 'イベント申請を追加できませんでした');
				}
                 */
			}
		}
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'event.js';
        $this->template->extra_css =array( 'event.css','front.css','main.css');

		$this->template->page_id = 'mypage'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'イベント申請登録'; //ページ名
		$this->template->page_title_inner_en = 'EVENT REQUEST ADD';
		$this->template->page_title_inner_jp = 'イベント申請登録';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		//$data['name_users'] = Model_User::getNameList();
		$data['title_events'] = Model_Event::getTitleList();

        $query = Model_Interview_Item::query();
        $data['interview_items']=$interview_items;
		$this->template->content = View::forge('event_requests/add', $data); // コンテンツ
	}
	/**
     * cancel
     */
	public function action_cancel($id)
	{
		$event = Model_Event_Request::find($id);
		if (empty($event)) {
			Session::set_flash('error', '対象のイベント申請が見つかりません');
			Response::redirect('mypage/');
		}
		if (Input::method() == 'POST')
		{
			{
				$before_status = $event->status;
                $event->status = 99; // キャンセル

				if ($event->save())
				{
					// メール送信
					SendMail::notifyEventRequestCancel($id);
					
					$cancel_wait = Model_Event_Request::STATUS_CANCEL_WAIT;
					$cancel = Model_Event_Request::STATUS_CANCEL;
					$reserved = Model_Event_Request::STATUS_RESERVED;

					if(($before_status == $reserved) and ($event->status == $cancel)) {
						$cancel_wait = Model_Event_Request::getOldestCancelWait($event->event_id);
						if(!empty($cancel_wait)) {
							$cancel_wait->status = $reserved;
							$cancel_wait->save();
							// メール送信（キャンセル待ちから予約済み）
							SendMail::notifyReservedFromCancelWait($cancel_wait->id);
						}
					}

					Session::set_flash('success', 'イベント申請をキャンセルしました');
					Response::redirect('mypage/');
				}
				else
				{
					Session::set_flash('error', 'イベント申請をキャンセルできませんでした');
					Response::redirect('mypage/');
				}
			}
		}
	}

    
    public function action_confirm()
    {
        if (Input::method() == 'POST')
            $event = Model_Event::find(Input::post("event_id"));
        else 
            $event  = Model_Event::find(Input::get("event_id"));
        if (empty($event)) {
            Session::set_flash('error', '既に申請済みのイベントです');
            Response::redirect_back();
        }
        $data_interview =Session::get('data_interview_'.$event->id);
        if (!isset($data_interview ) || empty($data_interview))
        {
            Response::redirect('event/requests/add?event_id='.$event->id);
            die;
        }
        if (Input::method() == 'POST')
        {
            // キャンセルされていない同じイベントの重複追加は、させない
            $request = Model_Event_Request::query()
                     ->where('user_id', $this->current_user->id)
                     ->where('event_id', Input::post('event_id'))
                     ->where('status', '!=', 99)
                     ->get_one();
            if (!empty($request)) {
                Session::set_flash('error', '既に申請済みのイベントです');
                Response::redirect_back();
            }
            else
            {
                $request = Model_Event_Request::forge(array(

                    'user_id' => $this->current_user->id,
                    'event_id' => Input::post('event_id'),
                    'status' => Input::post('status'),
                    'approval' =>0
                       // 使わない 'waiting_order' => Input::post('waiting_order'),
                   ));
                try {
                    \DB::start_transaction();
                    if ($request->save())
                    {
                        if ($request->status == Model_Event_Request::STATUS_CANCEL_WAIT) {
                            // キャンセル待ちに入る
                            SendMail::notifyEventRequestWaiting($request->id); // メール送信
                            Session::set_flash('success', 'イベント申請はキャンセル待ちに入りました');
                        } else {
                            // 申請を受付
                            SendMail::notifyEventRequestAdd($request->id); // メール送信
                            Session::set_flash('success', ['イベント申し込みを受け付けました。', 'また、審査があるイベントの場合、後日結果をご連絡いたしますので、メール到着までお待ちくださいませ。']);
                        }
                        $data_interview =Session::get('data_interview_'.Input::post('event_id'));
                        if(count($data_interview))
                            
                            foreach($data_interview as $item)
                            {
                                $value='';
                                if($item['type']==3)
                                    $value=implode(';',$item['value']);
                                else $value=$item['value'];
                                $answer=Model_Interview_Answer::forge(array(
                                    'user_id' => $this->current_user->id,
                                    'event_id' =>$item['event_id'],
                                    'event_request_id'=>$request->id,
                                    'interview_item_id' =>$item['id'],
                                    'answer_text' =>$item['text'],
                                    'answer_value' =>$value,
                                    'answer_count'=>count($item['value'])
                                    ));
                                $answer->save();
                            }
                        \DB::commit_transaction();
                        Session::set('data_interview_'.Input::post('event_id'),'');
                        Response::redirect('mypage/');
                    }
                    else
                    {
                        Session::set_flash('error', 'イベント申請を追加できませんでした');
                    }
                }
                catch (Exception $ex) {
                    
                    Session::set_flash('error', 'イベント申請を追加できませんでした');
                    \DB::rollback_transaction();
                }
            }
        }

        $query = DB::select('interview_items.id', 'interview_items.event_id','interview_items.item_name',
       'interview_items.type','interview_items.other_check','interview_items.select_max','interview_items.required')
        ->from('interview_items') 
        ->where('interview_items.event_id','=',$event->id) ->order_by('sort_no', 'asc');
        $interview_items = $query->execute();

        $this->template->page_path = Uri::base(false);
        $this->template->extra_js = 'event.js';
        $this->template->extra_css =array( 'event.css','front.css','main.css');
        $this->template->page_id = 'mypage'; //ページ独自にスタイルを指定する場合は入力
        $this->template->page_title = 'イベント申請登録'; //ページ名
        $this->template->page_title_inner_en = 'EVENT REQUEST COMFIRM';
        $this->template->page_title_inner_jp = 'イベント申請登録';
        $this->template->page_description = '';
        $this->template->page_keyword = '';
        $data['name_users'] = Model_User::getNameList();
        $data['title_events'] = Model_Event::getTitleList();
        $data['interview_items']=$interview_items;
        $this->template->content = View::forge('event_requests/confirm', $data); 
    }


    /**
     * vailidate post
     * */
    private function check_validate($interview_item)
    {
        $error=0;
        $msg=[];
        if(count($interview_item)>0)
        {
            foreach($interview_item as $item)
            {
                if ($this->validate($item,$msg)==false)
                {
                    $error++;
                }
            }
        }
        else 
        {
            Session::set_flash('error', 'イベント申請を追加できませんでした');
            return false;
        }
        if ($error>0)
        {
            Session::set_flash('error',$msg);
            return false;
        }
        return true;
    }
    /**$event
     * vailidate
     */
    private function validate($interview_item,&$errormsg)
    {
        $MSG_043='{0} は必須入力です。';
        $MSG_044='{0}は{1}個以上は選択できません。';
        if (empty($interview_item)) {
            Session::set_flash('error', 'イベント申請を追加できませんでした');
            return false;
        }
        else 
        {
            if ( $interview_item['type']==1 || $interview_item['type'] == 4 )
            {
                if ($interview_item['required']==1 && empty(Input::post('item_'.$interview_item['id'].'_name')))
                {
                    array_push($errormsg,  str_replace('{0}',$interview_item['item_name'],$MSG_043));
                    return false;
                }
            }
            else if ($interview_item['type']==2)
            {
                if ($interview_item['required']==1 &&  empty(Input::post('radio_'.$interview_item['id'])))
                {
                    array_push($errormsg,  str_replace('{0}',$interview_item['item_name'],$MSG_043));
                    return false;
                } else if ($interview_item['required']==1 && !empty(Input::post('radio_'.$interview_item['id']))
                 && Input::post('radio_'.$interview_item['id'])=='その他' && empty(Input::post('other_check_'.$interview_item['id']))  )
                {
                    array_push($errormsg, str_replace('{0}',$interview_item['item_name'],$MSG_043));
                    return false;
                }
            }else if ($interview_item['type']==3)
            {
                if ($interview_item['required'] && empty(Input::post('check'.$interview_item['id'])))
                {
                    array_push($errormsg,  str_replace('{0}',$interview_item['item_name'],$MSG_043));
                    return false;
                }
                else 
                {
                    if ((int)$interview_item['select_max']>0) {
                        $checkbox=Input::post('check'.$interview_item['id']);
                        if (count($checkbox)> $interview_item['select_max'] )
                        {
                            $arr = array("{0}" => $interview_item['item_name'],"{1}" => $interview_item['select_max']); 
                            array_push($errormsg, strtr($MSG_044,$arr));
                            return false;
                        }
                        var_dump($checkbox);
                        
                        if (count($checkbox)>0) {
                            for( $i =0 ; $i<count($checkbox); $i++) {
                              if (trim($checkbox[$i])=='その他' && empty(Input::post('other_check_'.$interview_item['id'])) ) {
                                array_push($errormsg, str_replace('{0}',$interview_item['item_name'],$MSG_043));
                                return false;
                              }  
                            }
                        }

                    }
                }
            }
        }
        return true;
    }
}
