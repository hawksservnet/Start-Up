<?php // fuel/app/classes/controller/events.php

class Controller_Admin_Events extends Controller_Admin
{


	/**
	 * イベント一覧
	 */
	public function action_index()
	{
		// オーガナイザの場合は、自分の作成したイベントのみ閲覧できる
		$query = Model_Event::BuildSearchQuery(Input::get());
		if (empty(Input::get('order'))) {
			$query->order_by('id', 'desc');
		} else {
			if (Input::get('order') == 'start_date' or Input::get('order') == 'start_time') {
				$query->order_by('start_date', Input::get('desc')?'desc':'asc');
				$query->order_by('start_time', Input::get('desc')?'desc':'asc');
			} else {
				$query->order_by(Input::get('order'), Input::get('desc')?'desc':'asc');
			}
		}

		$data = Input::get();
		$count = count($query->as_object('Model_Event')->execute());
		// $count = $query->count();
		$pagination = myPagination::create($count,20);
		$data["per_page"] = $pagination->per_page;
		$data["page"] = $pagination->current_page;
		$data["pagination"] = $pagination;
		$data['events'] = $query->limit($pagination->per_page)->offset($pagination->offset)->as_object('Model_Event')->execute()->as_array();
		// $data['events'] = $query->limit($pagination->per_page)->offset($pagination->offset)->get();
		$data['count'] = $count;
		$data['total_count'] = Model_Event::count();
		$data['event_statuses'] = Model_Event_Status::find('all');
		$data['categories'] = Model_Category::find('all');


		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'event.js';
		$this->template->extra_css = 'event.css';

		$this->template->page_id = 'index'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'イベントリトス';
		$this->template->page_title_inner_en = 'EVENT LIST';
		$this->template->page_title_inner_jp = 'イベントリスト';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$this->template->content = View::forge('admin/events/index', $data); // コンテンツ
	}

	public function action_view($id) {
		$current_date = new \DateTime();
		$event = Model_Event::find($id);
		// オーガナイザの場合は、自分の作成したイベントのみ閲覧できる
		if (!$this->current_user->isAdmin()) {
			if($event->user_id != $this->current_user->id) {
				Session::set_flash('error', '閲覧権限がありません。');
				Response::redirect('admin/events/index');
			}
		}
		if (!isset($event)) {
			Response::redirect('admin/events/index');
		}
		$query = Model_Event_Request::query();
		$query->order_by('id', 'asc');
		$query->where('event_id', $id);
		$query = Model_Event_Request::setSearchCondition($query, Input::param('condition'));
		$event_requests = $query->get();
		$approval = 0;
		$non_approved =0;
		$approval_waiting =0;
		$status_cancel = 0;
		$status_wait = 0;
		$status_reserv = 0;
		$status_partic = 0;
		$status_total = 0;


		/*
        foreach($event_requests as &$event_request){
            $event_request['interview_answers'] = Model_Interview_Answer::findByEventRequestId($event_request->id);
        }
		*/
		if(!empty(Input::post('event_status_change'))) {
			$event->status = Input::post('event_status');
			$event->save();
			Session::set_flash('success', 'ステータスを変更しました。');
		}

		if(!empty(Input::post('target_requests')) and !empty(Input::post('user_status')) and !empty(Input::post('user_status_change'))){
			$cancel_wait = Model_Event_Request::STATUS_CANCEL_WAIT;
			$cancel = Model_Event_Request::STATUS_CANCEL;
			$reserved = Model_Event_Request::STATUS_RESERVED;

			foreach (Input::post('target_requests') as $event_request_id => $target_user_id) {
				$event_request = $event->event_requests[$event_request_id];
				if(empty($event_request)) continue;

				$before_status = $event_request->status;
				$event_request->status = Input::post('user_status');
				$event->event_requests[$event_request_id] = $event_request;
				// 予約済からキャンセルに変更なら、キャンセル待ちを一件予約済に繰り上げて通知メール送信
				if(($before_status == $reserved) and ($event_request->status == $cancel)) {
					$oldest_cancel_wait = Model_Event_Request::getOldestCancelWait($event->id);
					if(!empty($oldest_cancel_wait)) {
						$oldest_cancel_wait->status = $reserved;
						$event->event_requests[$oldest_cancel_wait->id] = $oldest_cancel_wait;
						SendMail::notifyReservedFromCancelWait($oldest_cancel_wait->id);
					}
				}
				// キャンセル待ちから予約済に変更なら、通知メール送信
				if(($before_status == $cancel_wait) and ($event_request->status == $reserved)) {
					SendMail::notifyReservedFromCancelWait($event_request->id);
				}
			}
			if($event->save()) {
				Session::set_flash('success', 'イベント参加者のステータスを更新しました。');
			}else {
				Session::set_flash('error', 'イベント参加者のステータス更新に失敗しました。');
			}
		}
        if(!empty(Input::post('all_approval_change')) and $event->approval == 1){
            if(!empty(Input::post('target_requests'))){
                foreach (Input::post('target_requests') as $event_request_id => $target_user_id) {
                    $event_request = $event->event_requests[$event_request_id];
                    if(!empty($event_request) && $event_request->approval != Input::post('approval_status')){
                        $event_request->approval = Input::post('approval_status');
                        $event_request->updated_at = \Date::forge()->get_timestamp();
                        $event->event_requests[$event_request_id] = $event_request;
                        $approvalCancelComment = !empty(Input::post('approval_cancel_comment')) ? Input::post('approval_cancel_comment') : '';
                        if($event_request->approval == Model_Event_Request::APPROVAL){
                            SendMail::notifyEventRequestApprovalChange($event_request->id, $approvalCancelComment);
                        } elseif($event_request->approval == Model_Event_Request::NON_APPROVED) {
                            SendMail::notifyEventRequestNonApprovalChange($event_request->id, $approvalCancelComment);
                        }
                    }
                }
                if($event->save()) {
                    if(Input::post('approval_status') == Model_Event_Request::NON_APPROVED){
                        Session::set_flash('success', 'イベント予約の非承認を更新しました。');
                    }else{
                        Session::set_flash('success', 'イベント予約の承認を更新しました。');
                    }
                }else {
                    Session::set_flash('error', 'イベント予約の承認・非承認の更新に失敗しました。');
                }
            }else{
                Session::set_flash('error', 'ステータスを変更するデータを選択してください。');
            }
        }
        if(!empty(Input::post('individual_approval_change')) and $event->approval == 1){
            if(!empty(Input::post('individual_approval_id'))){
                $approvalId = Input::post('individual_approval_id');
                $event_request = $event->event_requests[$approvalId];
                if(!empty($event_request) && $event_request->approval != Input::post('individual_approval_value')){
                    $event_request->approval = Input::post('individual_approval_value');
                    $event_request->updated_at = \Date::forge()->get_timestamp();
                    $event->event_requests[$approvalId] = $event_request;
                    if($event->save()) {
                        $approvalCancelComment = !empty(Input::post('approval_cancel_comment')) ? Input::post('approval_cancel_comment') : '';
                        if($event_request->approval == Model_Event_Request::APPROVAL){
                            SendMail::notifyEventRequestApprovalChange($event_request->id, $approvalCancelComment);
                        } elseif($event_request->approval == Model_Event_Request::NON_APPROVED) {
                            SendMail::notifyEventRequestNonApprovalChange($event_request->id, $approvalCancelComment);
                        }
                        if($event_request->approval == Model_Event_Request::NON_APPROVED){
                            Session::set_flash('success', 'イベント予約の非承認を更新しました。');
                        }else{
                            Session::set_flash('success', 'イベント予約の承認を更新しました。');
                        }
                    }else {
                        Session::set_flash('error', 'イベント予約の承認・非承認の更新に失敗しました。');
                    }
                }
            }else{
                Session::set_flash('error', 'ステータスを変更するデータを選択してください。');
            }
        }


		foreach($event_requests as $request){
			if (empty($request->user)) continue;

			//ステータスチェック
			if ($request->status == Model_Event_Request::STATUS_CANCEL ){
				 $status_cancel ++;
				 $start_date= date("Y-m-d H:i", strtotime($event->start_time));
				 if ($start_date < $current_date->format('Y-m-d H:i') || $request->status==99 ||  $request->status ==31){

				 }
			 }elseif ($request->status == Model_Event_Request::STATUS_RESERVED ){
			   $status_reserv ++;
		   } elseif ($request->status == Model_Event_Request::STATUS_CANCEL_WAIT ){
				 $status_wait ++;
			 } elseif ($request->status == Model_Event_Request::STATUS_PARTICIPATED ){
			 	 $status_partic ++;
			 }

			 //承認・非承認チェック
			 if($request->approval == 0 ){
				$approval_waiting++;
			 } elseif($request->approval == 1) {
				$approval++;
			 }  elseif($request->approval == 2) {
				$non_approved++;
			 }
			 $status_total++;

		}
        $approval_numbers = [];
				$status_numbers = [];
        if ($event->approval != 0) {
            $approval_numbers = [
                'approval' => $approval,
                'approved' => $non_approved,
                'approval_waiting' =>$approval_waiting,
								'status_cancel' => $status_cancel,
								'status_total' => $status_total,
            ];
        }else{
					$status_numbers = [
							'status_wait' => $status_wait,
							'status_reserv' => $status_reserv,
							'status_partic' => $status_partic,
							'status_cancel' => $status_cancel,
							'status_total' => $status_total,
					];
				}



		$data = array();
		$data['event'] = $event;
		$data['event_statuses'] = Model_Event_Status::find('all');
		$data['request_statuses'] = Model_Event::getRequestStatus();
		$data['event_requests'] = $event_requests;
        $data['approval_numbers'] = $approval_numbers;
				$data['status_numbers'] = $status_numbers;
		$data['categories'] = $event->getCategoryNames(); // カテゴリー名
		$data['tags'] = $event->getTagNames(); // タグ名

        $this->template->extra_css = 'admin.renew.css';
		$this->template->content = View::forge('admin/events/view', $data);

	}

	/**
	 * edit
	 */
	public function action_edit($id = null)
	{
		$event = Model_Event::find($id);
		if (strpos(Input::referrer(), 'edit_confirm')) {
			// 確認画面からの戻りならば、セッションを読み込む
			$inputs = Session::get('Events.input.'. $id);
			$event->set($inputs);
		}

		// オーガナイザの場合は、自分の作成したイベントのみ閲覧できる
		if (!$this->current_user->isAdmin()) {
			if($event->user_id != $this->current_user->id) {
				Session::set_flash('error', '閲覧権限がありません。');
				Response::redirect('admin/events/index');
			}
		}
		if (empty($event)) {
			Response::redirect('events/');
		}
		if (Input::method() == 'POST')
		{
			$val = Model_Event::validate('edit', $id);
			if ($val->run())
			{
				//$user = Model_User::getLoginUser();
				$event->title = Input::post('title');
 				$event->wp_url = Input::post('wp_url');
 				$event->img_url = Input::post('img_url');
 				$event->start_date = (string) Input::post('start_year')
 						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
 						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT);
 				$event->start_time = (string) Input::post('start_year')
 						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
 						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT)
 						.' '. str_pad(Input::post('start_hour'), 2, 0, STR_PAD_LEFT)
 						.':'. str_pad(Input::post('start_min'), 2, 0, STR_PAD_LEFT)
 						.':00';
 				$event->end_time = (string) Input::post('start_year')
 						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
 						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT)
 						.' '. str_pad(Input::post('end_hour'), 2, 0, STR_PAD_LEFT)
 						.':'. str_pad(Input::post('end_min'), 2, 0, STR_PAD_LEFT)
 						.':00';
 				$event->reception_open = (string) Input::post('start_year')
 						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
 						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT)
 						.' '. str_pad(Input::post('reception_hour'), 2, 0, STR_PAD_LEFT)
 						.':'. str_pad(Input::post('reception_min'), 2, 0, STR_PAD_LEFT)
 						.':00';
 				$event->organizer = Input::post('organizer');
 				$event->capacity = Input::post('capacity');
 				$event->charge = Input::post('charge');
 				$event->status = Input::post('status');
                $auth = Auth::instance("Accountauth");
                list(, $userid) = $auth->get_user_id();
                $event->user_id = $userid; //$user->id;

                $interview_items = $event->interview_items;
                foreach($interview_items as &$interview_item){
                    $newSortNo = Input::post('sort_no_' . $interview_item->id);
                    if (!empty($newSortNo) && $interview_item->sort_no != $newSortNo) {
                        $interview_item->sort_no = $newSortNo;
                    }
                    if(!empty($interview_item->interview_lists)){
                        $interview_item['interview_lists'] = $interview_item->interview_lists;
                    }
                }
                usort($interview_items, function ($a, $b) {
                    return $a->sort_no - $b->sort_no;
                });
                $event->interview_items = $interview_items;

                $event->approval = Input::post('event_approval', 0);

				if (Input::post('categories')) {
					$categories = Input::post('categories');
				}

				if (Input::post('tags')) {
					$tags = Input::post('tags');
				}

				Session::set('Events.input.'. $id , $event->to_array() + compact('categories', 'tags'));
				Response::redirect('admin/events/edit_confirm/'. $id);
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'event.js';
		$this->template->extra_css = ['event.css', 'admin.renew.css'];

		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'イベント登録情報編集'; //ページ名
		$this->template->page_title_inner_en = 'EVENT EDIT';
		$this->template->page_title_inner_jp = 'イベント編集';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$data = array();
		$data['event'] = $event;
		$data['event_statuses'] = Model_Event_Status::find('all');
		$data['categories'] = Model_Category::find('all');
		$data['tags'] = Model_Tag::find('all');

		$this->template->content = View::forge('admin/events/edit', $data); // コンテンツ
	}
	/**
	 * edit confirm
	 */
	public function action_edit_confirm($id) {
		$event = Model_Event::find($id);

		// 入力情報
		$inputs = Session::get('Events.input.'. $id);

		if (Input::method() == 'POST')
		{
			// イベントカテゴリを消す
			foreach ($event->event_categories as $key => $event_category) {
				$event_category->delete();
			}
			// タグを消す
			foreach ($event->event_tags as $key => $event_tag) {
				$event_tag->delete();
			}

			$event->set($inputs);
			// カテゴリ
			$event->event_categories = array();
			if (!empty($inputs['categories'])) {
				foreach ($inputs['categories'] as $key => $category_id) {
					$event_category = Model_Event_Category::forge();
					$event_category->category_id = $category_id;
					$event->event_categories[] = $event_category;
				}
			}
			// タグ
			$event->event_tags = array();
			if (!empty($inputs['tags'])) {
				foreach ($inputs['tags'] as $key => $tag_id) {
					$event_tag = Model_Event_Tag::forge();
					$event_tag->tag_id = $tag_id;
					$event->event_tags[] = $event_tag;
				}
			}
            if (!empty($event['interview_items'])) {
                $oldItems = $event['interview_items'];
                $interview_items = array();
                foreach ($oldItems as $interview_item) {
                    $update_item = Model_Interview_Item::find($interview_item['id']);
                    $update_item->sort_no = $interview_item['sort_no'];
                    $interview_items[] = $update_item;
                }
                $event->interview_items = $interview_items;
            }

            if ($event->save())
			{
				Session::set_flash('success', 'イベント情報を更新しました');
				Response::redirect('admin/events/view/'. $id);
			}
			else
			{
				Session::set_flash('error', 'イベント情報を更新できませんでした');
			}
		}

		$event->set($inputs);
		// カテゴリ
		$event->event_categories = array();
		if (!empty($inputs['categories'])) {
			foreach ($inputs['categories'] as $key => $category_id) {
				$event_category = Model_Event_Category::forge();
				$event_category->category_id = $category_id;
				$event->event_categories[] = $event_category;
			}
		}
		// タグ
		$event->event_tags = array();
		if (!empty($inputs['tags'])) {
			foreach ($inputs['tags'] as $key => $tag_id) {
				$event_tag = Model_Event_Tag::forge();
				$event_tag->tag_id = $tag_id;
				$event->event_tags[] = $event_tag;
			}
		}

		$data = array();
		$data['event'] = $event;
		$data['event_statuses'] = Arr::assoc_to_keyval(Model_Event_Status::find("all"), 'id', 'name');
		$data['categories'] = $event->getCategoryNames(); // カテゴリー名
		$data['tags'] = $event->getTagNames(); // タグ名
        $this->template->extra_css = ['admin.renew.css'];
		$this->template->content = View::forge('admin/events/edit_confirm', $data);
	}

	/**
	 * add
	 */
	public function action_add()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Event::validate('add');
			$val = Model_Event::setAddEventValidate($val);

			if ($val->run())
			{
                $auth = Auth::instance("Accountauth");
                list(, $userid) = $auth->get_user_id();

				$event = Model_Event::forge(array(
					'title' => Input::post('title'),
					'wp_url' => Input::post('wp_url'),
					'img_url' => Input::post('img_url'),
					'start_date' => (string) Input::post('start_year')
						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT),
					'start_time' => (string) Input::post('start_year')
						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT)
						.' '. str_pad(Input::post('start_hour'), 2, 0, STR_PAD_LEFT)
						.':'. str_pad(Input::post('start_min'), 2, 0, STR_PAD_LEFT)
						.':00',
					'end_time' => (string) Input::post('start_year')
						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT)
						.' '. str_pad(Input::post('end_hour'), 2, 0, STR_PAD_LEFT)
						.':'. str_pad(Input::post('end_min'), 2, 0, STR_PAD_LEFT)
						.':00',
					'reception_open' => (string) Input::post('start_year')
						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT)
						.' '. str_pad(Input::post('reception_hour'), 2, 0, STR_PAD_LEFT)
						.':'. str_pad(Input::post('reception_min'), 2, 0, STR_PAD_LEFT)
						.':00',
					'organizer' => Input::post('organizer'),
					'capacity' => Input::post('capacity', 0),
					'charge' => Input::post('charge', 0),
					'status' => Input::post('status', null),
					'user_id' => $userid,
                    'approval' => Input::post('event_approval', 0),
				));
				if(Input::post('categories')) {
					foreach (Input::post('categories') as $key => $category_id) {
						$event_category = Model_Event_Category::forge();
						$event_category->category_id = $category_id;
						$event->event_categories[] = $event_category;
					}
				}

				if (Input::post('categories')) {
					$categories = Input::post('categories');
				}

				if (Input::post('tags')) {
					$tags = Input::post('tags');
				}

				Session::set('Events.input.add', $event->to_array() + compact('categories', 'tags'));
				Response::redirect('admin/events/add_confirm');
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'event.js';
		$this->template->extra_css = ['event.css', 'admin.renew.css'];

		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'イベント登録'; //ページ名
		$this->template->page_title_inner_en = 'EVENT ADD';
		$this->template->page_title_inner_jp = 'イベント登録';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		if (strpos(Input::referrer(), 'add_confirm')) {
			// 確認画面からの戻りならば、セッションを読み込む
			$inputs = Session::get('Events.input.add');
			$event = Model_Event::forge($inputs);
			$data = compact('event');
		} else {
			$data = array();
		}
		$data['event_statuses'] = Model_Event_Status::find('all');
		$data['categories'] = Model_Category::find('all');
		$data['tags'] = Model_Tag::find('all');
		$this->template->content = View::forge('admin/events/add', $data); // コンテンツ
	}
	/**
	 * add confirm
	 */
	public function action_add_confirm() {
		// 入力情報
		$inputs = Session::get('Events.input.add');
		$event = Model_Event::forge($inputs);
		// カテゴリ
		$event->event_categories = array();
		if (!empty($inputs['categories'])) {
			foreach ($inputs['categories'] as $key => $category_id) {
				$event_category = Model_Event_Category::forge();
				$event_category->category_id = $category_id;
				$event->event_categories[] = $event_category;
			}
		}
		// タグ
		$event->event_tags = array();
		if (!empty($inputs['tags'])) {
			foreach ($inputs['tags'] as $key => $tag_id) {
				$event_tag = Model_Event_Tag::forge();
				$event_tag->tag_id = $tag_id;
				$event->event_tags[] = $event_tag;
			}
		}

		if (Input::method() == 'POST')
		{
			if ($event->save())
			{
				Session::set_flash('success', 'イベントを追加しました');
				Response::redirect('admin/events');
			}
			else
			{
				Session::set_flash('error', 'イベントを追加できませんでした');
			}
		}

		$data = array();
		$data['event'] = $event;
		$data['event_statuses'] = Arr::assoc_to_keyval(Model_Event_Status::find("all"), 'id', 'name');
		$data['categories'] = $event->getCategoryNames(); // カテゴリー名
		$data['tags'] = $event->getTagNames(); // タグ名
		$this->template->content = View::forge('admin/events/edit_confirm', $data);
	}


	public function action_export_csv($id) {
		$event = Model_Event::find($id);
		// オーガナイザの場合は、自分の作成したイベントのみ閲覧できる
		if (!$this->current_user->isAdmin()) {
			if($event->user_id != $this->current_user->id) {
				Session::set_flash('error', '閲覧権限がありません。');
				Response::redirect('admin/events/index');
			}
		}

		$query = Model_Event_Request::query();
		$query->order_by('id', 'asc');
		$query->where('event_id', $id);
		$query = Model_Event_Request::setSearchCondition($query, Input::param('condition'));
		$event_requests = $query->get();

		$array_request_id= array();
		// CSV
		$csv_array = array();
		foreach($event_requests as $request){
			if (empty($request->user)) continue;
			$array = array(); $hdr = array();
			$array_request_id[] = $request->id ;
			//$array[] = $request->id; $hdr[]= "'ID'";
			$array[] = $request->user->id; $hdr[] = '"ユーザーID"';
			$array[] = '"'. trim($request->user->getName()) .'"'; $hdr[] = '"名前"';
			$array[] = '"'.trim($request->user->getHiraganaName()).'"'; $hdr[] = '"よみがな"';
			$array[] = $request->user->getBirthday(); $hdr[] = '"生年月"';
			$array[] = '"'.$request->user->getSex().'"'; $hdr[] = '"性別"';
			$array[] = '"'.trim($request->user->nationality).'"'; $hdr[] = '"国籍"';
			$array[] = '"'.trim($request->user->zip).'"'; $hdr[] = '"郵便番号"';
			$array[] = '"'.$request->user->getPref().'"'; $hdr[] = '"都道府県"';
			$array[] = '"'.$request->user->city.'"'; $hdr[] = '"市区町村"';
			$array[] = $request->user->tel; $hdr[] ='"電話番号"';
			$array[] = '"'.$request->user->email.'"'; $hdr[] = '"メールアドレス"';
			$array[] = '"'.$request->user->organization.'"'; $hdr[] = '"所属組織名"';
			$array[] = '"'.$request->user->position.'"'; $hdr[] = '"役職"';
			$array[] = '"'.$request->user->getJob().'"'; $hdr[] = '"職種"';
			$array[] = $request->user->interest==1?'"あり"':'"なし"'; $hdr[] = '"起業についての興味"';
			$array[] = '"'.$request->user->getPreparation().'"'; $hdr[] = '"起業の準備"';
			$array[] = $request->user->mailmagazine_info?'"受け取る"':'"受け取らない"'; $hdr[] = '"DMによる案内"';
			$array[] = $request->user->group?'"'.Config::get('master.USER_GROUP')[$request->user->group].'"':''; $hdr[] = '"アカウント種別"';
			$array[] = $request->user->type?'"'.Config::get('master.USER_TYPES')[$request->user->type].'"':''; $hdr[] = '"会員種別"';
			$array[] = '"'. $request->getStatus() . '"'; $hdr[] = '"ステータス"';
			$array[] = !empty($request->getAppvoral())?'"'. $request->getAppvoral().'"':''; $hdr[] = '"承認"';
			$array[] = '"'.date('Y-m-d H:i',$request->created_at).'"'; $hdr[] = '"申込日時"';

			$csv_array[$request->id] = $array;

		}
		$count = Model_Interview_Answer::getTotalAnswerEvent($array_request_id);
		if (count($event_requests)) {
			$query = Model_Interview_Item::query();
			$query->order_by('id', 'asc');
			$query->where('event_id', $id);
			$interview_item = $query->get();
			//count($interview_item);die;
			if (count($interview_item)) {
				foreach($interview_item as $item) {
					$hdr[] = '"'.$item->item_name .'"';
				}
			}
			foreach($event_requests as $request) {
				if (isset ($csv_array[$request->id])) {
					$array = $csv_array[$request->id];
					$anws = Model_Interview_Answer::findByEventRequestIdToArray($request->id);
					foreach($anws as $row) {
						if($row->interview_items->type == Model_Interview_Item::INTERVIEW_TEXT ||
						$row->interview_items->type == Model_Interview_Item::INTERVIEW_TEXTAREA){
						$array[] = !empty( trim($row->answer_text)) ?'"'.trim($row->answer_text).'"':'' ;
						} elseif ($row->interview_items->type == Model_Interview_Item::INTERVIEW_RADIO ) {
							$value_= !empty( trim($row->answer_value))?trim($row->answer_value):'';
							if (trim($value_)=='その他') {
								if (!empty($row->answer_text)) {
									$value_ .=' '.$row->answer_text;
								}
							}
							$array[] = '"'.$value_ .'"' ;

						}
						elseif($row->interview_items->type == Model_Interview_Item::INTERVIEW_CHECKBOX) {
							$str_ ='';
							if (!empty( trim($row->answer_value))){
								$value_=explode(';',trim($row->answer_value));
								if (is_array($value_)) {
									for($i=0;$i<count($value_);$i ++) {
										if (trim($value_[$i])=='その他') {
											if (!empty($row->answer_text)) {
												$value_[$i]=$row->answer_text;
											}
										}
									}
									$value_ = implode('/', $value_);
								} else {
									$str_ =trim($row->answer_value);
									if (trim($row->answer_value)=='その他') {
											if (!empty($row->answer_text)) {
												$str_=$row->answer_text;
											}
									}

								}
							}
							$array[] ='"'.preg_replace("([ ])", '',urldecode($value_)).'"' ;
						}
					}
					$csv_array[$request->id]=$array;
				}
			}

		}
		$csv = implode(',', $hdr) ."\n";
		foreach($csv_array as $key => $array){
			foreach($array as $key => $value){
				//$value = preg_replace('/"/', '"', $value);
				if(preg_match('/["\r\n,]/', $value) > 0){
					$value =  $value ;
				}
				$csv .= trim($value) . ',';
			}
			$csv .= "\n";
		}
		$file_name = Config::get('master.EXPORT_FILE_PREFIX')
				   // 日本語ファイル名使う場合 //. '-event-requests['. Util::convertFileName($event->title) .']'
				   . '-Event'. $event->id .'-'
				   . Date::forge()->format("%Y%m%d", true)
				   . '.csv';
		header("Content-Type: application/octet-stream");
		header('Content-Disposition: attachment; filename="'. $file_name .'"');
		$csv = mb_convert_encoding($csv, "SJIS-win", "UTF-8");
		return $csv;
	}
    /**
     * regidter / edit interview
     * @author huynh
     * @param int $eventId Event id
     * $param int | null $id Interview id
     */
    public function action_interview($eventId,$id = null)
    {
        $event = Model_Event::find($eventId);

        // オーガナイザの場合は、自分の作成したイベントのみ閲覧できる
        if (!$this->current_user->isAdmin()) {
            if($event->user_id != $this->current_user->id) {
                Session::set_flash('error', '閲覧権限がありません。');
                Response::redirect('admin/events/index');
            }
        }
        if (empty($event)) {
            Response::redirect('events/');
        }
        $interview = [];
        if(!empty($id)){
            $interview = Model_Interview_Item::queryFromId($id, $eventId);
            if(empty($interview)) Response::redirect('admin/events/edit/' . $eventId);

            // delete interview item
            if(!empty(Input::post('delete_interview')) &&
                !empty(Input::post('delete_interview_id')) &&
                Input::post('delete_interview_id') == $id &&
                !empty(Input::post('delete_interview_event_id')) &&
                Input::post('delete_interview_event_id') == $eventId
            ){
                try
                {
                    DB::start_transaction();

                    $interview_lists = Model_Interview_List::queryFromItemId($id,$eventId);
                    $interview_lists->delete();
                    $interview->delete();

                    DB::commit_transaction();

                    Session::set_flash('success', '削除が完了しました。');
                    Response::redirect('admin/events/edit/' . $eventId);
                } catch (Exception $e) {
                    // rollback pending transactional queries
                    DB::rollback_transaction();
                    Session::set_flash('error', '削除に失敗しました。');
                }
            }
        }
        // register / update Interview
        if(!empty(Input::post('update_interview')) && !empty(Input::post('event_id')) && Input::post('event_id') == $eventId){
            $val = Validation::forge('add');
            $val = Model_Interview_Item::setAddInterviewValidate($val);
            if($val->run()){
                $curTimeStamp = \Date::forge()->get_timestamp();
                if(empty($interview)){
                    $maxNo = Model_Interview_Item::selectMaxSort($eventId);
                    $interview = Model_Interview_Item::forge(array(
                        'event_id' => $eventId,
                        'sort_no' => ($maxNo + 1),
                        'created_at' => $curTimeStamp,
                    ));
                }
                $interview->type = Input::Post('interview_types');
                $interview->item_name = Input::Post('item_name');
                $interview->required = !empty(Input::Post('required')) ? Input::Post('required') : 0;
                $interview->select_max = 0;
                $interview->other_check = 0;
                if($interview->type == 2 || $interview->type == 3){
                    $interview->other_check = Input::Post('other_check');
                    if($interview->type == 3){
                        $interview->select_max = Input::Post('select_max');
                    }
                }
                $interview->updated_at = $curTimeStamp;
                try
                {
                    DB::start_transaction();
                    $interview->save();
                    if(!empty($id)){
                        $interview_lists = Model_Interview_List::queryFromItemId($id,$eventId);
                        $interview_lists->delete();
                    }
                    if($interview->type == 2 || $interview->type == 3){
                        $newInterviewListValue = explode(PHP_EOL,Input::Post('list_text'));
                        if(!empty($newInterviewListValue)){
                            foreach($newInterviewListValue as $key => $value){
                                $newInterviewList = Model_Interview_List::forge(array(
                                    'event_id' => $eventId,
                                    'interview_item_id' => $interview->id,
                                    'list_value' => $value,
                                    'list_text' => $value,
                                    'sort_no' => ($key + 1),
                                    'created_at' => $curTimeStamp,
                                    'updated_at' => $curTimeStamp,
                                ));
                                $newInterviewList->save();
                            }
                        }
                    }

                    DB::commit_transaction();

                    Session::set_flash('success', '更新が完了しました。');
                    Response::redirect('admin/events/edit/' . $eventId);
                } catch (Exception $e) {
                    // rollback pending transactional queries
                    DB::rollback_transaction();
                    Session::set_flash('error', '更新に失敗しました。');
                }
            } else  {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->page_path = Uri::base(false);
        $this->template->extra_css = ['admin.renew.css'];

        $this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
        $this->template->page_title = 'イベント問診設定'; //ページ名
        $this->template->page_title_inner_en = 'EVENT INTERVIEW EDIT';
        $this->template->page_title_inner_jp = 'イベント問診設定';
        $this->template->page_description = '';
        $this->template->page_keyword = '';

        $data = array();
        $data['interview'] = $interview;
        $data['id'] = $id;
        $data['event_id'] = $eventId;

        $this->template->content = View::forge('admin/events/interview', $data); // コンテンツ
    }
}
