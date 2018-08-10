<?php

class Controller_Withdrawal extends Controller_Base
{

	public function action_index()
	{
		if(!Auth::check()){
			Response::redirect("login");
		}
		$user = Model_User::getLoginUser();
		if(Input::post('password') and Auth::hash_password(Input::post('password'))== $user->password){
			Session::set('withdrawal',true);
			Response::redirect('withdrawal/check');
		}elseif(Input::post('password')){
			Session::set_flash('error','パスワードが異なります');
		}
		$data['order'] = Model_Order::query()
			->where('user_id',$user->id)
			->where('status','in',array(Model_Order::status_reserve,Model_Order::status_now_rental))
			->get();
		$data['page_id'] = '';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = '退会確認';

		Asset::css(array("account.css"), array(), 'extra_css', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('withdrawal/index', $data);
	}

	public function action_check()
	{
		if(!Auth::check()){
			Response::redirect("login");
		}
		if(!Session::get('withdrawal')){
			Response::redirect_back();
		}
		if(Input::post('withdrawal_complete')){
			$user = Model_User::getLoginUser();
			$user->toDisable();
			Auth::logout();
			Session::set('withdrawal',false);
			Response::redirect('withdrawal/complete');
		}
		$data['page_id'] = '';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = '退会確認';

		Asset::css(array("account.css"), array(), 'extra_css', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('withdrawal/check', $data);
	}

	public function action_complete()
	{
		$data['page_id'] = '';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = '退会確認';

		Asset::css(array("account.css"), array(), 'extra_css', false);
		
		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('withdrawal/complete', $data);
	}

}
