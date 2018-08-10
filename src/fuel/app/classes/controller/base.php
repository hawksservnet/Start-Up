<?php
class Controller_Base extends Controller_Template
{
	public function before()
	{
		parent::before();

		// ログイン確認
		if(!in_array(Request::active()->action, array('login', 'logout'))) {
			if(!Auth::check()){
				// リクエストURL保存
				$uri = Input::uri();
				$param = Input::param();
				$requested_url = $uri .'?'. http_build_query($param);
				Session::set('requested_url', $requested_url);
				
				if (strpos($uri, 'event/requests/add') !== false) {
					Session::set_flash('error', 'イベントのお申込みには、メンバー登録とログインが必要です。');
				} else {
					Session::set_flash('error', 'ログインしてください');
				}
                //delete session cakephp
                session_name('CAKEPHP');
                session_set_cookie_params(Config::get('cake_cookie.expiration'),Config::get('cake_cookie.path'),Config::get('cake_cookie.domain'));
                session_start();
                unset($_SESSION['MYPAGE']);
                session_write_close();
                //end
                return Response::redirect("login");
			} else {
			    $isCakeLogin = true;
                //check session cakephp
                session_name('CAKEPHP');
                session_set_cookie_params(Config::get('cake_cookie.expiration'),Config::get('cake_cookie.path'),Config::get('cake_cookie.domain'));
                session_start();
                if(empty($_SESSION['MYPAGE']) || empty($_SESSION['MYPAGE']['ID'])){
                    $isCakeLogin = false;
                }
                session_write_close();
                //end
                if(!$isCakeLogin){
                    Auth::logout();
                    Session::set_flash('error', 'ログインしてください');
                    return Response::redirect("users/login");
                }
            }
		}

		Config::load('master', true); // 定数ファイル

		// 変数設定
		$this->current_user = null;
		foreach (\Auth::verified() as $driver)
		{
			if (($id = $driver->get_user_id()) !== false)
			{
				$this->current_user = Model_User::find($id[1]);
			}
			break;
		}
		// Set a global variable so views can use it
		View::set_global('current_user', $this->current_user);
	}
}
