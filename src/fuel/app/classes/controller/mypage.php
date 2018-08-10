<?php

class Controller_Mypage extends Controller_Base
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

	public function action_index()
	{
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = '';
		$this->template->extra_css = 'main.css';

		$this->template->page_id = 'mypage';
		$this->template->page_title = '';
		$this->template->page_title_inner_en = 'MY PAGE';
		$this->template->page_title_inner_jp = 'マイページ';
		$this->template->page_description = '';
		$this->template->page_keyword = '';
		$requests = Model_Event_Request::query()
				  ->related('event')
				  ->where('user_id', $this->current_user->id)
				  ->where('status', '<', 20) // キャンセル待ち、予約済み
				  ->where('event.start_date', '>=', date('Y-m-d')) // 開催日を過ぎているイベントは除く
				  ->order_by('event.start_date', 'asc') // 古い順
				  ->get();
		$data['requests'] = $requests; //$this->current_user->my_requests;
		$accepted_requests = Model_Event_Request::query()
				  ->related('event')
				  ->where('user_id', $this->current_user->id)
				  ->where('status', '>', 20)  // 開催済み
				  ->where('status', '<', 50)  // 開催済み
				  ->order_by('event.start_date', 'desc') // 新しい順
				  ->get();
		$data['accepted_requests'] = $accepted_requests; //$this->current_user->accepted_requests;
        $event_request['interview_answers']='';

        foreach($requests as &$request){
            $event_request['interview_answers'] = Model_Interview_Answer::findByEventRequestId($request->id);
        }
        
		$this->template->content = View::forge('mypage/index', $data);
	}
	public function action_event_history()
	{
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'event-history.js';
		$this->template->extra_css = '';

		$this->template->page_id = 'mypage';
		$this->template->page_title = '';
		$this->template->page_title_inner_en = 'MY PAGE';
		$this->template->page_title_inner_jp = 'マイページ';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$data['requests'] = $this->current_user->accepted_requests;
		$this->template->content = View::forge('mypage/event_history', $data);
	}
	public function action_profile()
	{
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = '';
        $this->template->extra_css = 'main.css';

		$this->template->page_id = 'mypage';
		$this->template->page_title = '';
		$this->template->page_title_inner_en = 'MY PAGE';
		$this->template->page_title_inner_jp = 'マイページ';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$user = $this->current_user;
		$this->template->content = View::forge('mypage/profile', compact('user'));
	}
	public function action_profile_edit()
	{
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'user-registration.js';
		$this->template->extra_css = 'user-registration.css';

		$this->template->page_id = 'user-registration'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = '';
		$this->template->page_title_inner_en = 'MY PAGE';
		$this->template->page_title_inner_jp = 'マイページ';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$jobs = Config::get('master.JOBS');
		$preparations = Config::get('master.PREPARATIONS');
		$business_types = Config::get('master.BUSINESS_TYPES');
		$this->template->content = View::forge('mypage/profile_edit', compact('onetimes', 'jobs', 'preparations', 'business_types'));
	}

	public function action_logout()
	{
		Auth::logout();
		Session::set_flash('success', 'ログアウトしました');
		Response::redirect('login');
	}

	public function action_account()
	{
		$data['page_id'] = 'mypage';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = '会員情報編集';

		$data['user'] = Model_User::getLoginUser();
		if( $session = Session::get('front_user_edit') ) $data['session'] = $session;

		if( Input::method() == 'POST' ){
			if(!Security::check_token()){
				Session::set_flash('error', 'csrf攻撃');
			}else{
				$val = Model_User::validate('front_edit');
				if (empty(Input::post('password_confirm'))
				or Auth::hash_password(Input::post('password_confirm')) != $data['user']['password']) {
					Session::set_flash('error', '現在のパスワードを正しく入力してください。');
				} elseif(!$val->run()) {
					Session::set_flash('error', $val->error());
				} else {
					Session::set('front_user_edit', array(
						'name'     => Input::post('name'),
						'email'    => Input::post('email'),
						'tel'      => Input::post('tel'),
						'password' => Input::post('password')
					));
					Response::redirect('mypage/confirm');
				}
			}
		}

		Asset::css(array("account.css", "mypage.css"), array(), 'extra_css', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('mypage/account', $data); // コンテンツ
	}

	public function action_confirm()
	{
		$data['page_id'] = 'mypage';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = '会員情報編集';

		$session = Session::get('front_user_edit');
		if( !$session ){
			Session::set_flash('error', 'セッションエラー：編集情報を入力して下さい');
			Response::redirect('mypage/account');
		}
		$data['session'] = $session;

		if( Input::method() == 'POST' and Input::post('edit_complete', '1') ){
			if(!Security::check_token()){
				Session::set_flash('error', 'csrf攻撃');
			}else{
				Session::set('front_user_edit', array('edit_complete' => '1') + $session);
				Response::redirect('mypage/complete');
			}

		}

		Asset::css(array("account.css", "mypage.css"), array(), 'extra_css', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('mypage/confirm', $data); // コンテンツ
	}

	public function action_complete()
	{
		$data['page_id'] = 'mypage';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = '会員情報編集';

		$session = Session::get('front_user_edit');
		if( !$session or !$session['edit_complete'] ){
			Session::set_flash('error', 'セッションエラー：編集情報を入力して下さい');
			Response::redirect('mypage/account');
		}

		$user = Model_User::getLoginUser();
		$user->name     = $session['name'];
		$user->email    = $session['email'];
		$user->tel      = $session['tel'];
		//$user->password = $session['password'];
		if (!empty($session['password'])) {
			$user->password = Auth::hash_password($session['password']);
		}
		$user->save();
		//$user_pass = $user->password;
		//$newpass = Auth::reset_password($user->email);
		//Auth::update_user(array('password'=>$user->password,'old_password' => $newpass),$user->email);
		\SendMail::userEdit($user, $user_pass);

		Session::delete('front_user_edit');

		Asset::css(array("account.css", "mypage.css"), array(), 'extra_css', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('mypage/complete', $data); // コンテンツ
	}

	public function action_reserve()
	{
		$data['page_id'] = 'mypage';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = '予約・利用履歴';

		$user = Model_User::getLoginUser();

		$query = Model_Order::BuildSearchQuery();
		$query->where('user_id', $user->id)
			->where('status', Model_Order::status_now_rental);
		$query->order_by('created_at', 'desc');

		// if( Input::get("start_time") ) $query->where('start_time', '>', strtotime(Input::get("start_time")));
		// if( Input::get("start_time") ) $query->where('start_time', '<', strtotime(Input::get("start_time")." +1 day"));
		// if( Input::get("id") )
		// 	$query->where('id', '=',Input::get("id"));
		$data['rental_orders'] = $query->get();
		$query = Model_Order::BuildSearchQuery();
		$query->where('user_id', $user->id)
			->where('status', Model_Order::status_reserve);
		$query->order_by('created_at', 'desc');
		$data['reserve_orders'] = $query->get();

		Asset::css(array("mypage.css", '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css'), array(), 'extra_css', false);
		Asset::js(array("_min/common/script.js", '//code.jquery.com/ui/1.11.4/jquery-ui.js','mypage.js',"countdown.js"), array(), 'extra_js', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('mypage/reserve', $data); // コンテンツ
	}

	public function action_reserve_cancel()
	{
		$data['page_id'] = 'mypage';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = '予約キャンセル';

		$user = Model_User::getLoginUser();

		$query = Model_Order::BuildSearchQuery();
		$query->where('user_id', $user->id)
			->and_where_open()
				->where('status', Model_Order::status_cancel) // キャンセルした件
			->and_where_close();
		$query->order_by('created_at', 'desc')->limit(50);

		// if( Input::get("start_time") ) $query->where('start_time', '>', strtotime(Input::get("start_time")));
		// if( Input::get("start_time") ) $query->where('start_time', '<', strtotime(Input::get("start_time"))." +1 day");
		// if( Input::get("id") )
		// 	$query->where('id', '=',Input::get("id"));
		$data['cancel_orders'] = $query->get();
		$query = Model_Order::BuildSearchQuery();
		$query->where('user_id', $user->id)
			->and_where_open()
				->where('status', Model_Order::status_return) // 返却済みの件
			->and_where_close();
		$query->order_by('created_at', 'desc')->limit(50);
		$data['return_orders'] = $query->get();

		Asset::css(array("mypage.css", '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css'), array(), 'extra_css', false);
		Asset::js(array("_min/common/script.js", '//code.jquery.com/ui/1.11.4/jquery-ui.js','mypage.js'), array(), 'extra_js', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('mypage/reserve_cancel', $data); // コンテンツ
	}

	public function action_history()
	{
		$data['page_id'] = 'mypage';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = 'ご利用履歴一覧';

		$user = Model_User::getLoginUser();

		$query = Model_Order::BuildSearchQuery();
		$query->where('user_id', $user->id)->where('status' ,Model_Order::status_return);
		$query->order_by('created_at', 'desc')->limit(50);

		if( Input::get("start_time") ){
			$query->where('start_time', '>', strtotime(Input::get("start_time")));
			$query->where('start_time', '<', strtotime(Input::get("start_time"))." +1 day");
		}
		if( Input::get("id") )
			$query->where('id', '=',Input::get("id"));

		$data['orders'] = $query->get();

		Asset::css(array("mypage.css", '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css'), array(), 'extra_css', false);
		Asset::js(array("_min/common/script.js", '//code.jquery.com/ui/1.11.4/jquery-ui.js'), array(), 'extra_js', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('mypage/history', $data); // コンテンツ
	}


	public function action_ic_card()
	{
		$data['page_id'] = 'mypage';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = 'ICカード一覧';

		$data['user'] = Model_User::getLoginUser();

		Asset::css(array("mypage.css", '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css'), array(), 'extra_css', false);
		Asset::js(array("_min/common/script.js", '//code.jquery.com/ui/1.11.4/jquery-ui.js'), array(), 'extra_js', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('mypage/ic_card', $data); // コンテンツ
	}


	public function action_ic_card_add()
	{
		$data['page_id'] = 'mypage';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = 'ICカード新規登録';

		$user = Model_User::getLoginUser();

		if((count($user->ic_cards)+1)>=Model_Ic_Card::num_register_limit){
			Session::set_flash('error', "ICカードは".Model_Ic_Card::num_register_limit."枚以上は登録できません");
			Response::redirect('mypage/ic_card');
		}

		if(Input::post()){
			if(Security::check_token()){
				$val = Model_Ic_Card::validate("edit");
				if($val->run()){
					$result = Model_Ic_Card::saveNewIcCard($user, Input::post("card_num"));
					if( $result ){
						Session::set_flash('success', "ICカードを更新しました");
						Response::redirect('mypage/ic_card');
					} else {
						Session::set_flash('error', "保存に失敗しました");
					}
				} else {
					Session::set_flash('error', $val->error());
				}
			}else{
				Session::set_flash('error', 'csrf攻撃');
			}
		}

		$data['next_message'] = "登録";

		Asset::css(array("mypage.css", "account.css"), array(), 'extra_css', false);
		Asset::js(array("check.js" ), array(), 'extra_js', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('users/add_card', $data); // コンテンツ
	}


	public function action_ic_card_edit($id=null)
	{
		$data['page_id'] = 'mypage';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = 'ICカード変更';

		$user = Model_User::getLoginUser();
		$ic_card = Model_Ic_Card::find($id);

		if( !$ic_card or $user->id!=$ic_card->user_id ) {
			Session::set_flash('error', "ICカードのデータが見つかりませんでした");
			Response::redirect("mypage");
		}

		if(Input::post()){
			if(Security::check_token()){
				$val = Model_Ic_Card::validate("edit",$ic_card->id);
				if($val->run()){
					$ic_card->code = Input::post("card_num");
					if( $ic_card->save() ){
						\SendMail::addIcCard($ic_card);
						Session::set_flash('success', "ICカードを更新しました");
						Response::redirect('mypage/ic_card');
					} else {
						Session::set_flash('error', "ICカードの更新に失敗しました");
					}
				} else {
					Session::set_flash('error', $val->error());
				}
			}else{
				Session::set_flash('error', 'csrf攻撃');
			}
		}

		$data['next_message'] = "登録";

		$data["ic_card"] = $ic_card;

		Asset::css(array("mypage.css", "account.css"), array(), 'extra_css', false);
		Asset::js(array("check.js" ), array(), 'extra_js', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('users/add_card', $data); // コンテンツ
	}

		public function action_ic_card_delete($id=null)
		{
			$data['page_id'] = 'mypage';
			$data['back_link'] = 'back';
			$data['parent_title'] = 'マイページ';
			$data['parent_link'] = 'mypage';
			$data['page_title'] = 'ICカード変更';

			$user = Model_User::getLoginUser();
			$ic_card = Model_Ic_Card::find($id);

			if( !$ic_card or $user->id!=$ic_card->user_id ) {
				Session::set_flash('error', "ICカードのデータが見つかりませんでした");
				Response::redirect("mypage");
			}

			if( $ic_card->delete() ){
				Session::set_flash('success', "ICカードを削除しました");
			} else {
				Session::set_flash('error', "ICカードの削除に失敗しました");
			}

			Response::redirect("mypage/ic_card");

		}

		// 予約のキャンセル
		public function action_cancel_order($order_id=null)
		{
			$order = Model_Order::find($order_id);
			if (empty($order)) {
				Session::set_flash('error', "予約が見つかりませんでした");
				Response::redirect("mypage/reserve");
			}
			if ($order->cancelOrder()) {
				Session::set_flash('success', "予約をキャンセルしました");
			} else {
				Session::set_flash('error', "予約のキャンセルに失敗しました");
			}
			Response::redirect("mypage/reserve");
		}

	// クーポン一覧
	public function action_user_coupon()
	{
		$data['page_id'] = 'mypage';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = 'クーポン一覧';

		$user = Model_User::getLoginUser();
		$data['user_coupons'] = $user->user_coupons;

		Asset::css(array("mypage.css", '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css'), array(), 'extra_css', false);
		Asset::js(array("_min/common/script.js", '//code.jquery.com/ui/1.11.4/jquery-ui.js'), array(), 'extra_js', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('mypage/user_coupon', $data); // コンテンツ
	}

	// クーポン追加
	public function action_user_coupon_add()
	{
		$data['page_id'] = 'mypage';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = 'クーポン新規登録';
		$user = Model_User::getLoginUser();
		if(Input::post()){
			if(Security::check_token()){
				$coupon = Model_Coupon::getCoupon(Input::post("code"));
				if (empty($coupon)) {
					Session::set_flash('error', "該当するクーポンがありません");
				} elseif (!$coupon->isValid()) {
					Session::set_flash('error', "該当するクーポンがありません");
				} elseif ($user->hasCoupon($coupon->id)) {
					Session::set_flash('error', "このクーポンは登録済みです");
				} else {
					$user_coupon = Model_User_Coupon::forge(array(
							'user_id' => $user->id,
							'coupon_id' => $coupon->id,
							'quantity' => $coupon->quantity
					));
					$result = $user_coupon->save();
					if( $result ){
						Session::set_flash('success', "クーポンを登録しました");
						Response::redirect('mypage/user_coupon');
					} else {
						Session::set_flash('error', "保存に失敗しました");
					}
				}
			}else{
				Session::set_flash('error', 'csrf攻撃');
			}
		}
		$data['next_message'] = "登録";
		Asset::css(array("mypage.css", "account.css"), array(), 'extra_css', false);
		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('users/add_coupon', $data); // コンテンツ
	}

	// クーポン削除
	public function action_user_coupon_delete($id=null)
	{
		$data['page_id'] = 'mypage';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = 'クーポン変更';
		$user = Model_User::getLoginUser();
		$user_coupon = Model_User_Coupon::find($id);
		if( !$user_coupon or $user->id!=$user_coupon->user_id ) {
			Session::set_flash('error', "クーポンのデータが見つかりませんでした");
			Response::redirect("mypage/user_coupon");
		}
		if( $user_coupon->delete() ){
			Session::set_flash('success', "クーポンを削除しました");
		} else {
			Session::set_flash('error', "クーポンの削除に失敗しました");
		}
		Response::redirect("mypage/user_coupon");
	}



}
