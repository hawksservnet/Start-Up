<?php // app/classes/controller/login.php

class Controller_Login extends Controller_Basenologin
{

	public function action_index()
	{
		Response::redirect('404');
		
		if(Auth::check()){
			if($this->is_pc){
				Session::set_flash('error','既にアカウント登録されています。ご利用はスマートフォンからお願い致します');
			//	Response::redirect('login');
			}else{
				Response::redirect('top');
			}
		}
		$val = Validation::forge();
		if (Input::method() == 'POST')
		{
			$val->add('email', 'Email or Username')
				->add_rule('required');
			$val->add('password', 'Password')
				->add_rule('required');
			
			if ($val->run() and Security::check_token())
			{
				if ( ! Auth::check())
				{
					if (Auth::login(Input::post('email'), Input::post('password')))
					{
						if (in_array('banned', Auth::group()->get_roles())) {
							Auth::logout();
							Session::set_flash('error', 'このアカウントは停止されています');
						} else {
							if( $session = Session::get("order") and isset($session["return_to_order"]) and $session["return_to_order"] ){
								Response::redirect('orders');
							} else {
								Response::redirect('top');
							}
						}
					}
					else
					{
						Session::set_flash('error', "ログイン失敗\n入力内容にお間違えがないか再度ご確認をお願いいたします。");
					}
				}
				else
				{
					Session::set_flash('error', '既にログインしています');
				}
			}else{
				if(!$val->run())
					Session::set_flash('error', $val->error());
				if(!Security::check_token())
					Session::set_flash('error', 'csrf攻撃');
			}
			Response::redirect('login');
		}
		$data['page_id'] = 'login';
		$data['back_link'] = '';
		$data['parent_title'] = '';
		$data['page_title'] = 'ログイン';

		Asset::css(array("account.css"), array(), 'extra_css', false);

		$this->template->page_id	 = $data['page_id']; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title	 = $data['page_title']; //ページ名
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('login/index',$data); // コンテンツ
	}

	public function action_remind_password()
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
						$email->to($user->email, $user->name);
						$email->subject('【'. Config::get('master.SERVICE_NAME') .'】ログインパスワード再発行のお知らせ');
						$data = [
							'name' => $user->name,
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
						Response::redirect('login/remind_password_complete');
					} else {
						Session::set_flash('error', "新しいパスワードの発行に失敗しました");
					}
				} else {
					Session::set_flash('error', "メールアドレスに一致するアカウントが見つかりませんでした");
				}
			}

    }
    $data['page_id'] = '';
		$data['back_link'] = '';
		$data['parent_title'] = '';
		$data['page_title'] = 'パスワードをお忘れの方';

		Asset::css(array("account.css"), array(), 'extra_css', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('login/remind_password'); // コンテンツ
	}

	public function action_remind_password_complete()
	{
		$data['page_id'] = '';
		$data['back_link'] = '';
		$data['parent_title'] = '';
		$data['page_title'] = 'パスワードをお忘れの方';

		Asset::css(array("account.css"), array(), 'extra_css', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('login/remind_password_complete'); // コンテンツ
	}

  public function action_logout(){
    Auth::logout();
    Session::set_flash('message', 'ログアウトしました。');
    Response::redirect('login/index');
  }

}
