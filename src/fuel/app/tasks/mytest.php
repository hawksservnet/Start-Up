<?php
namespace Fuel\Tasks;

class Mytest
{

	public static function run()
	{
		return 'mytest';
	}

	/**
	 * レンタル開始
	 */
	public static function start_rental_order($id) {
		$order = \Model_Order::find($id);
		echo $order->id .', status='. $order->status ."\n";
		$res = $order->rentalStart(); // レンタル開始
		return var_dump($res);
	}

	/**
	 * 自転車の返却
	 */
	public static function return_order($id) {
		$order = \Model_Order::find($id);
		echo 'id:'. $order->id
		 .' status:'. $order->status
		 .' start_port:'. $order->start_port_id
		 ."\n";
		$res = $order->bike_return($order->start_port_id); // 最初のポートに戻す
		return var_dump($res);
	}

	/**
	 * ロックのメール
	 */
	public static function mail_lock_order($id) {
		$order = \Model_Order::find($id);
		echo 'id:'. $order->id
		 .' status:'. $order->status
		 ."\n";
		$res = \SendMail::rentalConfirmLock($order);
		return var_dump($res);
	}

	/**
	 * キャンセルのメール
	 */
	public static function mail_cancel_order($id) {
		$order = \Model_Order::find($id);
		echo 'id:'. $order->id
		 .' status:'. $order->status
		 ."\n";
		$res = \SendMail::rentalCancel($order);
		return var_dump($res);
	}

	/**
	 * 返却完了のメール
	 */
	public static function mail_complete_order($id) {
		$order = \Model_Order::find($id);
		echo 'id:'. $order->id
		 .' status:'. $order->status
		 ."\n";
		$res = \SendMail::rentalComplete($order);
		return var_dump($res);
	}

	/**
	 * 返却アラートのメール
	 */
	public static function mail_alert_order($id) {
		$order = \Model_Order::find($id);
		echo 'id:'. $order->id
		 .' status:'. $order->status
		 ."\n";
		$res = \SendMail::rentalAlert($order);
		return var_dump($res);
	}

	/**
	 * 月次報告のメール
	 */
	public static function mail_monthly_user($id) {
		$user = \Model_User::find($id);
		echo 'id:'. $user->id
		 .' name:'. $user->name
		 ."\n";
		$res = \SendMail::monthlyDemand($user, 10000);
		return var_dump($res);
	}

	/**
	 * 予約中の自転車
	 */
	public static function get_reserve_orders() {
		$orders = \Model_Order::query()->where('status', \Model_Order::status_reserve)->get();
		foreach( $orders as $order ){
			echo 'id:'. $order->id
			 .' status:'. $order->status
			 .' bike_id:'. $order->bike_id
			 ."\n";
		}
	}

	public function test_bike_return($id) {
		$order = \Model_Order::find($id);
		//$order->return_time = time();
		// クーポンを切る
		$user_coupon = $order->pickUserCoupon(); // ユーザークーポンを取得
		if (empty($user_coupon)) {
			$order->discount = 0;
		} else {
			$order->discount = $order->useCoupon($user_coupon); // ユーザークーポンを減算して割引を返す
			if ($coupon = $user_coupon->coupon) {
				echo 'coupon_id: '. $coupon->id  ."\n"
				.'coupon_name: '. $coupon->name  ."\n"
				.'discount: '. $coupon->discount  ."\n"
				.'discount_hour_price: '. $coupon->discount_hour_price  ."\n"
				.'discount_day_price: '. $coupon->discount_day_price  ."\n"
				."\n";
			}
		}
		$total_price = $order->getTotalPrice();
		$discount = $order->discount;
		echo 'id: '. $order->id ."\n"
		.'price: '. $order->getPrice() ."\n"
		.'total_price: '. $total_price ."\n"
		.'discount: '. $discount ."\n"
		."\n";
	}

}
