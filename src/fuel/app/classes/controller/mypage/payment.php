<?php

class Controller_Mypage_Payment extends Controller_Base
{
	public function action_index()
	{
		$data['page_id'] = 'mypage';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['parent_link'] = 'mypage';
		$data['page_title'] = 'クレジットカード変更';

		$user = Model_User::getLoginUser();

		if( Input::method() == 'POST' ){
			$payment = new Payment_Sb();
			$val = Model_User::validate('credit_card');
			$input = Input::post();
			$input['card_num'] = Input::post('card_num.1').Input::post('card_num.2').Input::post('card_num.3').Input::post('card_num.4');
			if( $val->run($input) ){
				if(Security::check_token()){
					$card_limit = Input::post('card_limit_year').sprintf('%02d',Input::post('card_limit_month'));
					if($payment->update_credit_card($user->credit_card,$input['card_num'], Input::post('card_security'), $card_limit)){
						// $user = Model_User::getLoginUser();
						Session::set_flash('success','クレジットカードを更新しました');
						Response::redirect('mypage/payment/complete');

					}else{
						Session::set_flash('error',$payment->last_error);
					}
				}else{
					Session::set_flash('error', 'csrf攻撃');
				}
			} else {
				Session::set_flash('error', $val->error());
			}
		}
		$data['years'] = array_combine(range(date('Y'),date('Y')+20),range(date('Y'),date('Y')+20));
		$data['months'] = array_combine(range(1,12),range(1,12));

		Asset::css(array("mypage.css", "account.css"), array(), 'extra_css', false);
		Asset::js(array("card_security.js" ), array(), 'extra_js', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('mypage/payment/index', $data); // コンテンツ
	}

	// public function action_confirm()
	// {
	// 	$data['page_id'] = 'mypage';
	// 	$data['back_link'] = 'back';
	// 	$data['parent_title'] = 'マイページ';
	// 	$data['page_title'] = 'クレジットカード変更';
	//
	// 	// $session = Session::get('front_payment_edit');
	// 	// if( !$session ){
	// 	// 	Session::set_flash('error', 'セッションエラー：編集情報を入力して下さい');
	// 	// 	Response::redirect('mypage/payment');
	// 	// }
	// 	// $data['session'] = $session;
	//
	// 	if( Input::method() == 'POST' ){
	// 		Response::redirect('mypage/payment/complete');
	// 	}
	//
	// 	Asset::css(array("account.css", "mypage.css"), array(), 'extra_css', false);
	//
	// 	$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
	// 	$this->template->page_title  = $data['page_title']; //ページ名
	// 	$this->template->child_title = ''; //子ページ名
	// 	$this->template->header  = View::forge('element/_header', $data);
	// 	$this->template->footer  = View::forge('element/_footer', $data);
	// 	$this->template->content = View::forge('mypage/payment/confirm', $data); // コンテンツ
	// }

	public function action_complete()
	{
		$data['page_id'] = 'mypage';
		$data['back_link'] = 'back';
		$data['parent_title'] = 'マイページ';
		$data['page_title'] = 'クレジットカード変更';

		// $session = Session::get('front_payment_edit');
		// if( !$session or !$session['edit_complete'] ){
		// 	Session::set_flash('error', 'セッションエラー：編集情報を入力して下さい');
		// 	Response::redirect('mypage/account');
		// }
		// Session::delete('front_payment_edit');

		Asset::css(array("account.css", "mypage.css"), array(), 'extra_css', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('mypage/payment/complete', $data); // コンテンツ
	}



}
