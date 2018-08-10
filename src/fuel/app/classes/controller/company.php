<?php

class Controller_Company extends Controller_Base
{

	public function action_detail($id=null)
	{
		$data['company'] = Model_Company::find($id);
		if( !$data['company'] ){
			echo "company is not found";
			die;
		}

		$data['id'] = $id;
		$data['page_id'] = 'company';
		$data['back_link'] = 'back';
		$data['parent_title'] = '';
		$data['page_title'] = 'お問合わせ';

		$data['menu_port']  = View::forge('element/_menu_port', $data);
		$data['modal_port'] = View::forge('element/_modal_port', $data);
		Asset::css(array("company.css"), array(), 'extra_css', false);
		Asset::js(array("company.js"), array(), 'extra_js', false);


		$this->template->page_id     = 'company'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->child_title = ''; //子ページ名
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('company/detail', $data);
	}

	public function action_info($id=null)
	{
		$data['company'] = Model_Company::find($id);
		if( !$data['company'] ){
			echo "company is not found";
			die;
		}

		$data['id'] = $id;
		$data['page_id'] = 'company';
		$data['back_link'] = Uri::create("company/detail/".$id);
		$data['parent_title'] = '会社情報';
		$data['parent_link'] = Uri::create("company/detail/".$id);
		$data['page_title'] = $data['company']->name;
		$data['child_title'] = "";

		$data['menu_port']  = View::forge('element/_menu_port', $data);
		$data['modal_port'] = View::forge('element/_modal_port', $data);
		Asset::css(array("company.css"), array(), 'extra_css', false);
		Asset::js(array("company.js"), array(), 'extra_js', false);


		$this->template->page_id     = 'company'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->parent_title = $data['parent_title'];  //親ページ名
		$this->template->parent_link = $data['parent_link'];  //親ページリンク
		$this->template->child_title = ''; //子ページ名
		$this->template->child_link = '';  //子ページリンク
		$this->template->header  = View::forge('element/_header', $data);
		$this->template->footer  = View::forge('element/_footer', $data);
		$this->template->content = View::forge('company/info', $data);
	}

}
