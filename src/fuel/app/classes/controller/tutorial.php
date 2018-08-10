<?php

class Controller_Tutorial extends Controller_Template
{
	public function action_index()
	{
		$data['page_id'] = 'tutorial';
		$data['parent_title'] = '';
		$data['page_title'] = 'ご利用について';
		$data['back_link'] = 'back';

		Asset::css(array("tutorial.css"), array(), 'extra_css', false);
		Asset::js(array("tutorial.js"), array(), 'extra_js', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('tutorial/index'); // コンテンツ
	}

}
