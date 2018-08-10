<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends Controller_Template
{
	public function before()
	{
		$this->template = View::forge('template_nologin'); // ログイン前のテンプレート
	}
	
	/**
	 * The basic welcome message
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
		return Response::forge(View::forge('welcome/index'));
	}

	/**
	 * A typical "Hello, Bob!" type example.  This uses a Presenter to
	 * show how to use them.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_hello()
	{
		return Response::forge(Presenter::forge('welcome/hello'));
	}

	/**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		$this->response_status = 404;
		
		$this->template->page_path = Uri::base(false);
		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = '404';
		$this->template->page_title_inner_en = '404 Not Found';
		$this->template->page_title_inner_jp = '';
		$this->template->page_description = '';
		$this->template->page_keyword = '';
		
		$this->template->content = View::forge('welcome/404'); // コンテンツ
		
	}
}
