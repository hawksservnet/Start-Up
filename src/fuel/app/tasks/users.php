<?php
namespace Fuel\Tasks;

class Users
{

	public static function run()
	{

	}

	/**
	 * 月次請求額通知を各ユーザーに送信する
	 * @return none
	 */
	public static function send_monthly_demand()
	{
		$users = \Model_User::find('all');
		foreach( $users as $user ){
			$orders = \Model_Order::query()
					->where('user_id', $user->id)
					->where('status', \Model_Order::status_return)
					->where('return_time', '>', strtotime(date('Y/m/d 00:00')." -1 month"))
					->where('return_time', '<', strtotime(date('Y/m/d 00:00')))
					->get();
			if( $orders ){
				$total_price = 0;
				foreach( $orders as $order ){
					$total_price += $order->getTotalPrice();
				}
				\SendMail::monthlyDemand($user, $total_price);
			}
		}
	}

}
