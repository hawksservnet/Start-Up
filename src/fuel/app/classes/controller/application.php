<?php

class Controller_Application extends Controller_Template
{
	public function action_index()
	{
		$data['page_id'] = 'application';
		$data['back_link'] = 'back';
		$data['parent_title'] = '';
		$data['page_title'] = 'イベント申し込みフォーム';

		// Asset::css(array("company.css"), array(), 'extra_css', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->child_title = ''; //子ページ名
		// $this->template->header  = View::forge('element/_header', $data);
		// $this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('application/index'); // コンテンツ
	}

	public function action_confirm()
	{
		$data['page_id'] = 'application';
		$data['back_link'] = 'back';
		$data['parent_title'] = '';
		$data['page_title'] = 'イベント申し込みフォーム - 確認画面';

		// Asset::css(array("company.css"), array(), 'extra_css', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->child_title = ''; //子ページ名
		// $this->template->header  = View::forge('element/_header', $data);
		// $this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('application/confirm'); // コンテンツ
	}

	public function action_complete()
	{
		$data['page_id'] = 'application';
		$data['back_link'] = 'back';
		$data['parent_title'] = '';
		$data['page_title'] = 'イベント申し込みフォーム - 完了画面';

		// Asset::css(array("company.css"), array(), 'extra_css', false);

		$this->template->page_id     = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->child_title = ''; //子ページ名
		// $this->template->header  = View::forge('element/_header', $data);
		// $this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('application/complete'); // コンテンツ
	}

}
