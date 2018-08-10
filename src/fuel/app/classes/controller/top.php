<?php

class Controller_Top extends Controller_Basenologin
{
	public function before()
	{
		parent::before();
		Response::redirect('mypage/');
	}
	
	public function action_index()
	{
		$this->template->page_id = 'top'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = ''; //ページ名
		$this->template->page_description = '';
		$this->template->page_keyword = '';
		$this->template->page_path = Uri::base(false); //階層
		
		$this->template->content = View::forge('top/index'); // コンテンツ
	}
}
