<?php

class Controller_Privacypolicy extends Controller_Template
{
	public function action_index()
	{
		$data['page_id'] = 'privacypolicy';
		$data['back_link'] = 'back';
		$data['parent_title'] = '';
		$data['page_title'] = 'プライバシーポリシー';

		Asset::css(array("company.css"), array(), 'extra_css', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('privacypolicy/index'); // コンテンツ
	}

}
