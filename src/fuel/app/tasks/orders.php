<?php
namespace Fuel\Tasks;

class Orders
{

	public static function run()
	{

	}

	/**
	 * 利用開始から48時間以内に返却が確認されなかったorderのidを返却し，
	 * アラートメールをユーザーに送信する
	 * @return array()
	 */
	public static function get_alert_orders()
	{
		$orders = \Model_Order::query()->where('status', \Model_Order::status_now_rental)->where('start_time', '<', time()-3600*24)->get();
		$arr = [];
		foreach( $orders as $order ){
			$arr[] = $order->id;
			\SendMail::rentalAlert($order);
		}
		return $arr;
	}
	/**
	 * 予約から30分以内に開始されなかった注文を破棄する
	 * @return array()
	 */
	public static function burst()
	{
		$orders = \Model_Order::query()->where('status', \Model_Order::status_reserve)->where('created_at', '<', time()-1800)->get();
		$arr = [];
		foreach( $orders as $order ){
			$order->cancelOrder();
			\Log::error('burst:'.$order->id);
		}
		return $arr;
	}
}
