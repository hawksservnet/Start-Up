<?php
class Controller_Basenologin extends Controller_Template
{
	public function before()
	{
		parent::before();
		
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