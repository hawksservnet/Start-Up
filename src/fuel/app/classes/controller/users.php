<?php // fuel/app/classes/controller/users.php

class Controller_Users extends Controller_Basenologin
{
	public function before()
	{
		parent::before();
 		if (strpos(Request::active()->action, 'registration') === false
 		and strpos(Request::active()->action, 'email_verification') === false
 		and strpos(Request::active()->action, 'add_complete') === false
		and strpos(Request::active()->action, 'login') === false
		and strpos(Request::active()->action, 'password') === false
 		and strpos(Request::active()->action, 'logout') === false) {
			// ログイン確認
			if (!Auth::check()) {
				Session::set_flash('error', 'ログインしてください');
				Response::redirect('users/login');
			}
			// アクセス権を確認
			if (!Auth::has_access('userPage.browse')) {
				Session::set_flash('error', 'アクセス権がありません');
				Response::redirect('404');
			}
			// 引数ないか、自分のIDではない場合、管理者権限が必要
			$arg1 = Request::main()->uri->segment(3);
 			if (empty($arg1) or $arg1 != $this->current_user->id) {
				if (!Auth::has_access('adminPage.browse')) {
					Session::set_flash('error', 'アクセス権がありません');
					Response::redirect('mypage/');
				}
			}

			$this->template = View::forge('template'); // テンプレート
		} else {
			// ログイン前のページ
			$this->template = View::forge('template_nologin'); // ログイン前のテンプレート
		}
	}

	/**
	 * ログイン
	 */
	public function action_login()
	{
		// ログイン済みなら、ホームへ
		Auth::check() and Auth::has_access('userPage.browse') and Response::redirect('mypage/');

        $data = Input::get();
		$val = Validation::forge();
		if (Input::method() == 'POST')
		{
			$val->add('email', 'メールアドレス')
				->add_rule('required');
			$val->add('password', 'パスワード')
				->add_rule('required');
			if (!$val->run()) {
				Session::set_flash('error', $val->error());
			} elseif (!Security::check_token()) {
				Session::set_flash('error', 'csrf攻撃');
			} else {
                if ( Auth::check()){
                    session_name('CAKEPHP');
                    session_set_cookie_params(Config::get('cake_cookie.expiration'),Config::get('cake_cookie.path'),Config::get('cake_cookie.domain'));
                    session_start();
                    if(isset($_SESSION['LOGIN']))
                        unset($_SESSION['LOGIN']);
                    if(isset($_SESSION['MYPAGE']))
                        unset($_SESSION['MYPAGE']);
                    session_write_close();
                    //end
                    Auth::logout();
                }
                if (Auth::login(Input::post('email'), Input::post('password')) )
                {
                    if( Auth::has_access('userPage.browse') ){
                        // リクエストURLがあったら、そちらに遷移
                        if (!empty($requested_url = Session::get('requested_url'))) {
                            Session::delete('requested_url');
                            Response::redirect($requested_url);
                        } else {
                            //save session cakephp
                            session_name('CAKEPHP');
                            session_set_cookie_params(Config::get('cake_cookie.expiration'),Config::get('cake_cookie.path'),Config::get('cake_cookie.domain'));
                            session_start();
                            $_SESSION['MYPAGE'] = [
                                'ID'=>Auth::get('id'),
                                'NAME'=>Auth::get('name_last').' '.Auth::get('name_first')
                            ];
                            session_write_close();
                            //end
                            $url = "https://startuphub.tokyo/";
                            if (strpos($_SERVER["HTTP_HOST"],'dev-mp') !== false) {
                                $url ='https://dev.startuphub.tokyo/';
                            }
                            $redirectList = array(
                                '104' => 'concierge/top',
                                '106' => 'concierge/schedule/month',
                                '107' => 'concierge/schedule/week',
                                '108' => 'concierge/schedule/day',
                            );
                            if(empty($data["h"]) || empty($redirectList[$data["h"]])){
                                Response::redirect('mypage/');
                            }else{
                                Response::redirect($url . $redirectList[$data["h"]]);
                            }
                        }
                    } else {
                        Session::set_flash('error', '権限がありません');
                        Auth::logout();
                    }
                }
                else
                {
                    Session::set_flash('error', 'ログインに失敗しました。入力内容にお間違いがないかご確認下さい。');
                }
			}
		}

		$this->template->page_path = Uri::base(false);

		$this->template->page_id = 'login';
		$this->template->page_title = 'ログイン';
		$this->template->page_title_inner_en = 'LOGIN';
		$this->template->page_title_inner_jp = 'ログイン';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$this->template->content = View::forge('users/login', $data); // コンテンツ
	}

	/**
	 * ログアウト
	 */
	public function action_logout()
	{
		//delete session cakephp
		session_name('CAKEPHP');
		session_set_cookie_params(Config::get('cake_cookie.expiration'),Config::get('cake_cookie.path'),Config::get('cake_cookie.domain'));
		session_start();
		unset($_SESSION['MYPAGE']);
		session_write_close();
		//end
		Auth::logout();
		Response::redirect('users/login');
	}

	public function action_forgot_password()
	{
		$val = Validation::forge();
		if (Input::method() == 'POST'){
			$val->add('email', 'メールアドレス')
				->add_rule('required');
			if ($val->run() and Security::check_token()){
				$user = Model_User::query()->where('email', Input::post("email"))->get_one();
				if( $user ){
					$newpass = Auth::reset_password($user->email);
					if( $user->save() ){
						$email = Email::forge();
						$email->from(Config::get('master.SERVICE_MAIL_ADDRESS'), Config::get('master.HOME_DOMAIN'));
						$email->to($user->email, $user->getName());
						$email->subject('【'. Config::get('master.SERVICE_NAME') .'】ログインパスワード再発行のお知らせ');
						$data = [
							'name' => $user->getName(),
							'pass' => $newpass,
						];
						$body = View::forge("email/password_remind", $data);
						$email->body($body);
						try
						{
							$email->send();
						}
						catch(\EmailValidationFailedException $e)
						{
							// バリデーションが失敗したとき
						}
						catch(\EmailSendingFailedException $e)
						{
							// ドライバがメールを送信できなかったとき
						}
						Response::redirect('users/remind_password_complete');
					} else {
						Session::set_flash('error', "新しいパスワードの発行に失敗しました");
					}
				} else {
					Session::set_flash('error', "メールアドレスに一致するアカウントが見つかりませんでした");
				}
			}
		}

		$this->template->page_path = Uri::base(false);

		$this->template->page_id = 'login';
		$this->template->page_title = 'パスワード再設定';
		$this->template->page_title_inner_en = 'PASSWORD';
		$this->template->page_title_inner_jp = 'パスワード再設定';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$this->template->content = View::forge('users/forgot_password'); // コンテンツ
	}

	public function action_remind_password_complete()
	{
		$this->template->page_path = Uri::base(false);

		$this->template->page_id = '';
		$this->template->page_title = 'パスワード再設定完了';
		$this->template->page_title_inner_en = 'PASSWORD';
		$this->template->page_title_inner_jp = 'パスワード再設定完了';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$this->template->content = View::forge('users/remind_password_complete'); // コンテンツ
	}

	/**
	 * メンバー一覧
	public function action_index()
	{

		$query = Model_User::BuildSearchQuery(Input::get());
		//$query->where("group", "!=", 100); // 管理者(admin)はリストに出さない
		$query->order_by('id', 'desc');

		$data = Input::get();
		$count = $query->count();
		$pagination = myPagination::create($count,20);
		$data["per_page"] = $pagination->per_page;
		$data["page"] = $pagination->current_page;
		$data["pagination"] = $pagination;
		$data['users'] = $query->limit($pagination->per_page)->offset($pagination->offset)->get();
		$data['count'] = $count;
		$data['total_count'] = Model_User::count();
		$data["order_by"] = array(
			'' => '表示順',
			"id" => "ユーザーID順",
			"name_last" => "名前順",
		);

		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'user-registration.js';
		$this->template->extra_css = 'user-registration.css';

		$this->template->page_id = 'index';
		$this->template->page_title = 'メンバーリトス';
		$this->template->page_title_inner_en = 'MEMBER LIST';
		$this->template->page_title_inner_jp = 'メンバーリスト';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$this->template->content = View::forge('users/index', $data); // コンテンツ
	}
	 */

	/**
	 * メンバー登録
	 */
	public function action_registration()
	{
		if (Auth::check())
		{ // ログインしてたらマイページへ
			Response::redirect('mypage/');
		}
		if( Input::method() == 'POST' ){
			$val = Model_Onetime::validate('registration');
			if (!$val->run()) {
				Session::set_flash('error', $val->error());
			} else {
				$onetimes = array(
					'name_last'    => Input::post('name_last'),
					'name_first'   => Input::post('name_first'),
					'email'        => Input::post('email'),
					'tel'          => Input::post('tel'),
					'password'     => Auth::hash_password(Input::post('password')),
					'hiragana_name_last' => Input::post('hiragana_name_last'),
					'hiragana_name_first' => Input::post('hiragana_name_first'),
					'birth_year' => Input::post('birth_year'),
					'birth_month' => Input::post('birth_month'),
					'birth_day' => Input::post('birth_day', '01'),
					'sex' => Input::post('sex'),
					'nationality' => Input::post('nationality'),
					'zip' => Input::post('zip'),
					'pref' => Input::post('pref'),
					'city' => Input::post('city'),
					//'address' => Input::post('address'),
					//'building' => Input::post('building'),
					'organization' => Input::post('organization'),
					'position' => Input::post('position'),
					'job' => Input::post('job'),
					'interest' => Input::post('interest'),
					'preparation' => Input::post('preparation'),
					//'mailmagazine' => Input::post('mailmagazine'),
					'mailmagazine_info' => Input::post('mailmagazine_info'),
					//'role01' => Input::post('role01'),
					//'role02' => Input::post('role02'),
					//'role03' => Input::post('role03'),
					//'role04' => Input::post('role04'),
					//'role05' => Input::post('role05'),
					//'role06' => Input::post('role06'),
					//'role07' => Input::post('role07'),
					//'role08' => Input::post('role08'),
					//'role09' => Input::post('role09'),
					//'role10' => Input::post('role10'),
					//'role11' => Input::post('role11'),
					//'role12' => Input::post('role12'),
					//'event' => Input::post('event'),
					//'matching' => Input::post('matching'),
					//'entrepreneur_year' => Input::post('entrepreneur_year'),
					//'entrepreneur_month' => Input::post('entrepreneur_month'),
					//'business_type' => Input::post('business_type'),
					//'industry' => Input::post('industry'),
				);
				Session::set('User.onetimes', $onetimes);
				Response::redirect("users/registration_confirm");
			}
		}

		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'user-registration.js';
		$this->template->extra_css = 'user-registration.css';

		$this->template->page_id = 'user-registration-body'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = '';
		$this->template->page_title_inner_en = 'MEMBER REGISTRATION';
		$this->template->page_title_inner_jp = 'メンバー登録';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$jobs = Config::get('master.JOBS');
		$preparations = Config::get('master.PREPARATIONS');
		$business_types = Config::get('master.BUSINESS_TYPES');
		$this->template->content = View::forge('users/registration', compact('onetimes', 'jobs', 'preparations', 'business_types'));
	}

	public function action_registration_confirm()
	{
		$onetimes = Session::get('User.onetimes');

		if( Input::method() == 'POST' ){
			if (!Security::check_token()) {
				Session::set_flash('error', 'csrf攻撃');
			} else {
				$onetime = Model_Onetime::forge(array(
					'name_last'    => $onetimes['name_last'],
					'name_first'   => $onetimes['name_first'],
					'email'        => $onetimes['email'],
					'tel'          => $onetimes['tel'],
					'password'     => $onetimes['password'],
					'hash'         => hash("md5", rand()),
					'data'         => json_encode($onetimes)
				));
				if( $onetime->save() ){
					\SendMail::onetimeUrl($onetime);
					Response::redirect("users/registration_complete");
				} else{
					Session::set_flash('error', "登録用のURLを発行できませんでした");
				}
			}
		}

		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'user-registration.js';
		$this->template->extra_css = 'user-registration.css';

		$this->template->page_id = 'user-registration-body'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = '';
		$this->template->page_title_inner_en = 'MEMBER REGISTRATION';
		$this->template->page_title_inner_jp = 'メンバー登録';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$jobs = Config::get('master.JOBS');
		$preparations = Config::get('master.PREPARATIONS');
		$business_types = Config::get('master.BUSINESS_TYPES');
		$this->template->content = View::forge('users/registration_confirm', compact('onetimes', 'jobs', 'preparations', 'business_types'));
	}

	public function action_registration_complete()
	{
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'user-registration.js';
		$this->template->extra_css = 'user-registration.css';

		$this->template->page_id = 'user-registration-body'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = '';
		$this->template->page_title_inner_en = 'MEMBER REGISTRATION';
		$this->template->page_title_inner_jp = 'メンバー登録';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$this->template->content = View::forge('users/registration_complete');
	}

	public function action_send_email_verification()
	{
		$data['page_id'] = '';
		$data['back_link'] = '';
		$data['parent_title'] = 'アカウント登録';
		$data['parent_link'] = 'registration';
		$data['page_title'] = '仮登録完了';

		Asset::css(array("account.css"), array(), 'extra_css', false);

		$this->template->page_path = Uri::base(false);
		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->content = View::forge('users/send_email_verification'); // コンテンツ
	}

	public function action_confirm_email_verification()
	{
		$onetime = Model_Onetime::query()->where("hash", Input::get('hash'))->get_one();
		if (!$onetime) {
			Response::redirect("/");
		} elseif (!$onetime->checkLifetime()) {
			Session::set_flash("error", "登録用URLの期限切れです");
			Response::redirect("users/registration");
		} elseif ($onetime->checkExistingUser()) {
			Session::set_flash("error", "すでにアカウントは登録済みです");
			Response::redirect('users/login');
		}
		$data = json_decode($onetime->data, true);
		$birthday = (string) $data['birth_year']
				  . '-'
				  . str_pad($data['birth_month'], 2, 0, STR_PAD_LEFT)
				  . '-'
				  . str_pad($data['birth_day'], 2, 0, STR_PAD_LEFT);
		//if($data['entrepreneur_year'] and $data['entrepreneur_month']){
		//	$entrepreneur_date = $data['entrepreneur_year']
		//				   . '-'
		//				   . $data['entrepreneur_month']
		//				   . '-01';
		//}
		try{
			DB::start_transaction();
			$user = Model_User::forge(array(
				'name_last'     => $onetime->name_last,
				'name_first'    => $onetime->name_first,
				'email'    => $onetime->email,
				'username' => $onetime->email,
				'tel'      => $onetime->tel,
				'password' => $onetime->password,
				'group' => 1,
				'type' => 1,

				'hiragana_name_last' => $data['hiragana_name_last'],
				'hiragana_name_first' => $data['hiragana_name_first'],
				'birthday' => $birthday,
				'sex' => $data['sex'],
				'nationality' => $data['nationality'],
				'zip' => $data['zip'],
				'pref' => $data['pref'],
				'city' => $data['city'],
				//'address' => $data['address'],
				//'building' => $data['building'],
				'organization' => $data['organization'],
				'position' => $data['position'],
				'job' => $data['job'],
				'interest' => $data['interest'],
				'preparation' => $data['preparation'],
				//'mailmagazine' => $data['mailmagazine'],
				'mailmagazine_info' => $data['mailmagazine_info'],
				//'role01' => $data['role01'],
				//'role02' => $data['role02'],
				//'role03' => $data['role03'],
				//'role04' => $data['role04'],
				//'role05' => $data['role05'],
				//'role06' => $data['role06'],
				//'role07' => $data['role07'],
				//'role08' => $data['role08'],
				//'role09' => $data['role09'],
				//'role10' => $data['role10'],
				//'role11' => $data['role11'],
				//'role12' => $data['role12'],
				//'event' => $data['event'],
				//'matching' => $data['matching'],
				//'entrepreneur_date' => $entrepreneur_date?:null,
				//'business_type' => $data['business_type'],
				//'industry' => $data['industry'],
			));
			if ($user->save()) {
				$onetime->delete();
				//Auth::force_login($user->id);
				\SendMail::addAccount($user);
				DB::commit_transaction();
				Response::redirect("users/add_complete");
			} else {
				Session::set_flash("error", "アカウントの保存ができませんでした");
			}
		}catch(Exception $e){
			DB::rollback_transaction();
			Log::error($e->getMessage());
		}

	}

	public function action_add_complete()
	{
		$this->template->page_path = Uri::base(false);
		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'アカウント登録完了';
		$this->template->page_title_inner_en = 'MEMBER REGISTRATION';
		$this->template->page_title_inner_jp = 'メンバー登録';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$this->template->content = View::forge('users/add_complete'); // コンテンツ
	}

	/**
	 * edit
	 */
	public function action_edit($id, $page = null)
	{
		$user = Model_User::find($id);
		if (empty($user)) {
			Response::redirect('users/');
		}
		if (Input::method() == 'POST')
		{
			if (empty($page) or $page =='base') {
				$val = Model_User::validate('edit', $id); // 基本情報
			} elseif ($page =='dm') {
				$val = Model_User::validate('edit_dm', $id); // DM案内
			}
			if ($val->run())
			{
				if (empty($page) or $page =='base') {
					// 基本情報
					$user->name_last = Input::post('name_last');
					$user->name_first = Input::post('name_first');
					$user->email = Input::post('email');
					$user->username = Input::post('email');
					$user->tel = Input::post('tel');
	
					$user->hiragana_name_last = Input::post('hiragana_name_last');
					$user->hiragana_name_first = Input::post('hiragana_name_first');
					$user->birthday = (string) Input::post('birth_year')
						.'-'. str_pad(Input::post('birth_month'), 2, 0, STR_PAD_LEFT)
						.'-'. str_pad(Input::post('birth_day', '01'), 2, 0, STR_PAD_LEFT);
					$user->sex = Input::post('sex');
					$user->nationality = Input::post('nationality');
					$user->zip = Input::post('zip');
					$user->pref = Input::post('pref');
					$user->city = Input::post('city');
	
					$user->organization = Input::post('organization');
					$user->position = Input::post('position');
					$user->job = Input::post('job');
	
					$user->interest = Input::post('interest');
					$user->preparation = Input::post('preparation');
	
					if (Auth::has_access('adminPage.browse')) {
						// 管理者のみ
						$user->group = Input::post('group');
						$user->type = Input::post('type');
					}
				}
				if (empty($page) or $page =='dm') {
					// DM案内
					$user->mailmagazine_info = Input::post('mailmagazine_info');
				}
				Session::set('Users.input', $user->to_array());
				if (empty($page) or $page =='base') {
					Response::redirect('users/edit_confirm/'. $id .'/base'); // 基本情報
				} elseif ($page =='dm') {
					Response::redirect('users/edit_confirm/'. $id .'/dm'); // DM案内
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'user-registration.js';
		$this->template->extra_css = 'user-registration.css';

		if (!empty($page)) {
			$data['page'] = $page;
		}
		$this->template->page_id = 'mypage'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'メンバー登録情報編集'; //ページ名
		$this->template->page_title_inner_en = 'MEMBER EDIT';
		$this->template->page_title_inner_jp = 'メンバー編集';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$data['user'] = $user;
		$data['jobs'] = Config::get('master.JOBS');
		$this->template->content = View::forge('users/edit', $data); // コンテンツ
	}
	/**
	 * edit confirm
	 */
	public function action_edit_confirm($id, $page = null)
	{
		$user = Model_User::find($id);
		if (empty($user)) {
			Response::redirect('users/');
		}
		$user->set(Session::get('Users.input'));
		if (Input::method() == 'POST')
		{
			if ($user->save())
			{
				Session::set_flash('success', 'メンバー情報を更新しました');
				if (Auth::has_access('adminPage.browse')) {
					Response::redirect('users/');
				} else {
					Response::redirect('mypage/profile');
				}
			}
			else
			{
				Session::set_flash('error', 'メンバー情報を更新できませんでした');
			}
		}
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'user-registration.js';
		$this->template->extra_css = 'user-registration.css';

		$this->template->page_id = 'mypage'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'メンバー登録情報編集確認'; //ページ名
		$this->template->page_title_inner_en = 'MEMBER EDIT CONFIRMATION';
		$this->template->page_title_inner_jp = 'メンバー編集確認';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$data['user'] = $user;
		$data['jobs'] = Config::get('master.JOBS');
		if (empty($page) or $page =='base') {
			$this->template->content = View::forge('users/edit_confirm', $data); // 基本情報
		} elseif ($page =='dm') {
			$this->template->content = View::forge('users/edit_dm_confirm', $data); // DM案内
		}
	}

	/**
	 * edit password
	 */
	public function action_edit_pw($id = null)
	{
		$user = Model_User::find($id);
		if (empty($user)) {
			Response::redirect('users/');
		}
		if (Input::method() == 'POST')
		{
			$val = Model_User::validate('change_pw');
			if ($val->run())
			{
				$user->password = Auth::hash_password(Input::post('password'));
				Session::set('Users.pw', $user->to_array());
				Response::redirect('users/edit_pw_confirm/'.$user->id);
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'user-registration.js';
		$this->template->extra_css = 'user-registration.css';

		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'メンバー登録情報編集'; //ページ名
		$this->template->page_title_inner_en = 'MEMBER PASSWORD';
		$this->template->page_title_inner_jp = 'パスワード変更';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$data['user'] = $user;
		$data['jobs'] = Config::get('master.JOBS');
		$this->template->content = View::forge('users/edit_pw', $data); // コンテンツ
	}
	/**
	 * edit password confirm
	 */
	public function action_edit_pw_confirm($id)
	{
		$user = Model_User::find($id);
		$user->set(Session::get('Users.pw'));
		if (Input::method() == 'POST')
		{
			{
				if ($user->save())
				{
					Session::set_flash('success', 'パスワードを更新しました');
					//Auth::logout();
					Response::redirect('mypage/profile');
				}
				else
				{
					Session::set_flash('error', 'パスワードを更新できませんでした');
				}
			}
		}
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'user-registration.js';
		$this->template->extra_css = 'user-registration.css';

		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'メンバー登録情報編集'; //ページ名
		$this->template->page_title_inner_en = 'MEMBER PASSWORD CONFIRMATION';
		$this->template->page_title_inner_jp = 'パスワード変更確認';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$data['user'] = $user;
		$this->template->content = View::forge('users/edit_pw_confirm', $data); // コンテンツ
	}

	/**
	 * add
	 */
	public function action_add()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_User::validate('add', $id);
			if ($val->run())
			{
				$user = Model_User::forge(array(
					'name_last' => Input::post('name_last'),
					'name_first' => Input::post('name_first'),
					'email' => Input::post('email'),
					'username' => Input::post('email'),
					'tel' => Input::post('tel'),

					'password' => Auth::hash_password(Input::post('password')),

					'hiragana_name_last' => Input::post('hiragana_name_last'),
					'hiragana_name_first' => Input::post('hiragana_name_first'),
					'birthday' => (string) Input::post('birth_year')
						.'-'. str_pad(Input::post('birth_month'), 2, 0, STR_PAD_LEFT)
						.'-'. str_pad(Input::post('birth_day'), 2, 0, STR_PAD_LEFT),
					'sex' => Input::post('sex'),
					'nationality' => Input::post('nationality'),
					'pref' => Input::post('pref'),
					'city' => Input::post('city'),

					'organization' => Input::post('organization'),
					'position' => Input::post('position'),
					'job' => Input::post('job'),

					'mailmagazine_info' => Input::post('mailmagazine_info'),

					'group' => 1,
				));
				if ($user->save())
				{
					Session::set_flash('success', 'メンバーを追加しました');
					Response::redirect('users/');
				}
				else
				{
					Session::set_flash('error', 'メンバーを追加できませんでした');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'user-registration.js';
		$this->template->extra_css = 'user-registration.css';

		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'メンバー登録'; //ページ名
		$this->template->page_title_inner_en = 'MEMBER ADD';
		$this->template->page_title_inner_jp = 'メンバー登録';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$data['user'] = $user;
		$data['jobs'] = Config::get('master.JOBS');
		$this->template->content = View::forge('users/add', $data); // コンテンツ
	}
}
