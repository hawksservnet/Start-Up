<?php
class Controller_Admin extends Controller_Template
{

	public function before()
	{
		parent::before();

		$driver = "Accountauth";  // ユーザーログイン認証用
		$auth = Auth::instance($driver); 

		if (Request::active()->controller !== 'Controller_Admin' or ! in_array(Request::active()->action, array('login', 'logout')))
		{
			if (!$auth->check())
			{
                //delete session cakephp
                session_name('CAKEPHP');
                session_set_cookie_params(Config::get('cake_cookie.expiration'),Config::get('cake_cookie.path'),Config::get('cake_cookie.domain'));
                session_start();
                unset($_SESSION['LOGIN']);
                session_write_close();
                //end
				Session::set_flash('error', 'ログインしてください');
                return Response::redirect('admin/login');
			}else{
                $isCakeLogin = true;
                //check session cakephp
                session_name('CAKEPHP');
                session_set_cookie_params(Config::get('cake_cookie.expiration'),Config::get('cake_cookie.path'),Config::get('cake_cookie.domain'));
                session_start();
                if(empty($_SESSION['LOGIN']) || !$_SESSION['LOGIN']['ID']){
                    unset($_SESSION['LOGIN']);
                    $isCakeLogin = false;
                }
                session_write_close();
                //end
                if(!$isCakeLogin){
                    $auth->logout();
                    Session::set_flash('error', 'ログインしてください');
                    return Response::redirect("admin/login");
                }
				// 変数設定
				$this->current_user = null;
				foreach (\Auth::verified() as $driver)
				{
					if (($id = $driver->get_user_id()) !== false)
					{

						$this->current_user = Model_Acount::find($id[1]);

					}
					break;
				}

/*
				// 権限確認
 				if (!in_array(Request::active()->action, array('login', 'logout'))) {
 					if (!$auth->has_access('modePage.browse')) {
 						Session::set_flash('error', '権限がありません');
 						Response::redirect('mypage/');
 					}
 				}

 				// イベント管理画面以外のページは権限が管理者のユーザしか見れないようにする
 				// オーガナイザはイベント管理ページのみ閲覧でき、イベントの登録も行える
				if(!in_array(Request::active()->controller, array('Controller_Admin_Events'))) {
					if(!$this->current_user->isAdmin()) {
						Session::set_flash('error', '権限がありません。');
						Response::redirect('admin/events');
					}
				}
*/
                if($this->current_user && isset($this->current_user['authority'])) {
                    if($this->current_user['authority'] == 3 || $this->current_user['authority'] == 4){
                        $url = "https://startuphub.tokyo/";
                        if (strpos($_SERVER["HTTP_HOST"],'dev-mp') !== false) {
                            $url ='https://dev.startuphub.tokyo/';
                        }
                        Response::redirect($url . 'management/schedule/week');
                    } else {
                        $permissionList = array(
                            'Controller_Admin_Events' => array(0, 1, 2, 5),
                            'Controller_Admin_Category' => array(0, 1),
                            'Controller_Admin_Tag' => array(0, 1),
                            'Controller_Admin_Users' => array(0, 1, 5),
                            'Controller_Admin_Preentre_Requests' => array(0, 1, 5),
                        );
                        if(isset($permissionList[Request::active()->controller]) && ! in_array($this->current_user['authority'], $permissionList[Request::active()->controller])){
                            if($this->current_user['authority'] == 2){
                                Response::redirect('admin/events');
                            } else {
                                Response::redirect('admin/users');
                            }
                        }
                    }
                }
				// Set a global variable so views can use it
				View::set_global('current_user', $this->current_user);
			}
		}

		$this->template = View::forge('admin/template'); // テンプレート
		Config::load('master', true); // 定数ファイル
	}
	public function action_index(){
		Response::redirect('admin/users');
	}

	public function action_login()
	{
		$driver = "Accountauth";  // ユーザーログイン認証用
		$auth = Auth::instance($driver); 

//		$driver = "Accountgrouop";
//		$group = Auth::instance($driver); 

		$auth->check() and Response::redirect('admin/users');
		$val = Validation::forge();
		if (Input::method() == 'POST')
		{
			//delete session cakephp
			session_name('CAKEPHP');
			session_set_cookie_params(Config::get('cake_cookie.expiration'),Config::get('cake_cookie.path'),Config::get('cake_cookie.domain'));
			session_start();
			if(isset($_SESSION['search006_01'])) 
				unset($_SESSION['search006_01']);						
			if(isset($_SESSION['search011'])) 
				unset($_SESSION['search011']);	
			if(isset($_SESSION['search015']))
				unset($_SESSION['search015']);		
			if(isset($_SESSION['search021']))
				unset($_SESSION['search021']);		
			session_write_close();
			//end			
			$val->add('email', 'ログインID')
				->add_rule('required');
			$val->add('password', 'Password')
				->add_rule('required');

			if ($val->run() and Security::check_token())
			{
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

                if ($auth->login(Input::post('email'), Input::post('password')))
                {

                    //save session cakephp
                    session_name('CAKEPHP');
                    session_set_cookie_params(Config::get('cake_cookie.expiration'),Config::get('cake_cookie.path'),Config::get('cake_cookie.domain'));
                    session_start();
                    $_SESSION['LOGIN'] = [
                        'ID'=>$auth->get('id'),
                        'AUTH' => $auth->get('authority')
                    ];
                    session_write_close();
                    //end
                }
                else
                {
                    Session::set_flash('error', "ログイン失敗\n入力内容にお間違えがないか再度ご確認をお願いいたします。");
                }
			}else{
				if(!$val->run())
					Session::set_flash('error', $val->error());
				if(!Security::check_token())
					Session::set_flash('error', 'csrf攻撃');
			}
			Response::redirect('admin/login');
		}
		Asset::css(array("signin.css"), array(), 'extra_css', false);
		$data = array();
		$this->template->page_title       = '';
		$this->template->page_path        = '/';
		$this->template->page_description = Config::get('master.page_description');
		$this->template->page_keywords    = Config::get('master.page_keywords');
		$this->template->page_ogp_img     = '';
		$this->template->page_id          = '';
		$this->template->content = View::forge('admin/login', $data); // コンテンツ
	}
	public function action_logout(){
		//delete session cakephp
		session_name('CAKEPHP');
		session_set_cookie_params(Config::get('cake_cookie.expiration'),Config::get('cake_cookie.path'),Config::get('cake_cookie.domain'));
		session_start();
		unset($_SESSION['LOGIN']);
		session_write_close();
		//end
		$driver = "Accountauth";  // ユーザーログイン認証用
		$auth = Auth::instance($driver); 
		$auth->logout();
		Session::set_flash('message', 'ログアウトしました。');
		Response::redirect('admin/login');
	}

}
