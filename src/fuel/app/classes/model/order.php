<?php

class Model_Order extends \Orm\Model_Soft
{
	protected static $_properties = array(
		'id',
		'category_id',
		'user_id',
		'start_port_id',
		'return_port_id',
		'status',
		'bike_id',
		'start_time',
		'return_time',
		'payment_method',
		'total_price',
		'rental_price',
		'rental_charge',
		'rental_payment',
		'port_price',
		'port_charge',
		'port_payment',
		'system_price',
		'discount',
		'coupon_code',
		'usage_fee',
		'pin_code',
		'deleted_at',
		'created_at',
		'updated_at',
		'plan_flag',
		'hour_price',
		'day_price',
		'coupon_id',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_soft_delete = array(
		'mysql_timestamp' => false,
	);

	protected static $_table_name = 'orders';

	protected static $_belongs_to = array(
			'user' => array(
				'key_from'       => 'user_id',
				'model_to'       => 'Model_User',
				'key_to'         => 'id',
				'cascade_save'   => true,
				'cascade_delete' => false,
			),
			'bike' => array(
				'key_from'       => 'bike_id',
				'model_to'       => 'Model_Bike',
				'key_to'         => 'id',
				'cascade_save'   => true,
				'cascade_delete' => false,
			),
			'start_port' => array(
				'key_from'       => 'start_port_id',
				'model_to'       => 'Model_Port',
				'key_to'         => 'id',
				'cascade_save'   => true,
				'cascade_delete' => false,
			),
			'return_port' => array(
				'key_from'       => 'return_port_id',
				'model_to'       => 'Model_Port',
				'key_to'         => 'id',
				'cascade_save'   => true,
				'cascade_delete' => false,
			),
	);
	protected static $_has_one = array(
			'transaction' => array(
				'key_from'       => 'id',
				'model_to'       => 'Model_Payment_Transaction',
				'key_to'         => 'order_id',
				'cascade_save'   => true,
				'cascade_delete' => true,
			),
	);
	const status_reserve = 1;
	const status_cancel = 2;
	const status_now_rental = 3;
	const status_return = 4;


	public static function BuildSearchQuery(){
		$query = self::query();
		if( Input::get("date") ){
		  $query->where("created_at", ">=", strtotime(Input::get("date")));
			$query->where("created_at", "<", strtotime(Input::get("date"))+ 24*60*60);
		}
		if( Input::get("date_start") )  $query->where("created_at", ">=", strtotime(Input::get("date_start")));
		if( Input::get("date_end") )    $query->where("created_at", "<", strtotime(Input::get("date_end"))+ 24*60*60);

		if( Input::get("sales_start") )  $query->where("return_time", ">=", strtotime(Input::get("sales_start")));
		if( Input::get("sales_end") )    $query->where("return_time", "<", strtotime(Input::get("sales_end"))+ 24*60*60);

		if( Input::get("start_port_id") )   $query->where("start_port_id", Input::get('start_port_id'));
		if( Input::get("return_port_id") )  $query->where("return_port_id", Input::get('return_port_id'));
		if( Input::get("category_id") )     $query->where("category_id", Input::get('category_id'));
		if( Input::get("payment_method") )  $query->where("payment_method", Input::get('payment_method'));
		if( Input::get("status") )          $query->where("status", Input::get('status'));

		if( Input::get("order_by") == "price" ) $query->order_by("total_price",'desc');
		if (Input::get("company_id")) {
			$company_id = Input::get("company_id");
			$query->related('bike');
			$query->related('return_port');
			$query->where_open()
				->where("bike.company_id", $company_id)
				->or_where("return_port.company_id", $company_id)
				->where_close();
		}

		if( Input::get("order_by") == "id" ) $query->order_by('id', 'asc');
		if( Input::get("order_by") == "user_name" ) $query->related("user")->order_by('user.name', 'asc');
		if( Input::get("order_by") == "category_id" ) $query->order_by('category_id', 'asc');
		if( Input::get("order_by") == "discount" ) $query->order_by('discount', 'asc');
		if( Input::get("order_by") == "total_price" ) $query->order_by('total_price', 'asc');
		
		if( Input::get("status") )  $query->where("status", Input::get('status'));

		if( Input::get('keyword') ){
			$keyword = '%'. Input::get("keyword") .'%';
			$query->related('bike');
			$query->related('user');
			$query->where_open()
				->where("id", Input::get("keyword"))
				->or_where("bike.code", "LIKE", $keyword)
				->or_where("user.name", "LIKE", $keyword)
				->where_close();
		}
		if( Input::get('code') ){
			$code = '%'. Input::get("code") .'%';
			$query->related('bike');
			$query->where("bike.code", "LIKE", $code);
		}
 		return $query;
	}


	public function getCategory(){
		if (empty($this->category_id)) {return '';}
		$categories = Config::get('master.ORDER_CATEGORY');
		return $categories[$this->category_id];
	}

	public function getPaymentMethod(){
		if (empty($this->payment_method)) {return '';}
		$payment_methods = Config::get('master.ORDER_PAYMENT_METHOD');
		return $payment_methods[$this->payment_method];
	}

	public function getStatus(){
		if (empty($this->status)) {return '';}
		$statuses = Config::get('master.ORDER_STATUS');
		return $statuses[$this->status];
	}

	public static function getStatusRentalOrReserved(){
		return array(1,2);
	}

	/**
	 * 料金計算ロジック
	 *
	 * 料金は1時間毎に加算されます。24時間以内であれば上限金額を最大として、それ以上の加算はありません。
	 * 24時間以上ご利用の場合は、24時間最大料金+時間使用料金(24時間最大料金の適用有り)となります。
	 *
	 * $detailを指定すると時間の詳細情報を返す
	 *   total_hour => 総時間
	 *   day => 日
	 *   hour => 時間
	 *   price => 料金
	 */
	public function getPrice($detail = null){
		// 利用時間
		$start_to_return_time = $this->return_time - $this->start_time;
		if ($start_to_return_time < 0) {
			$start_to_return_time = time() - $this->start_time;
			// 自転車が戻ってきてない
			// return null;
		}
		// 時間あたりの計算
		$total_hour = ceil($start_to_return_time / 3600.0);
		if (empty($this->day_price)) {
			// 日単価が設定されてなければ
			$price = $total_hour * $this->hour_price;
			$hour = $total_hour;
			$day = 0;
		} else {
			// 日あたりの料金算出
			$day = floor($total_hour / 24);
			$day_price = $day * $this->day_price;
			// （日あたりを除き）時間あたりの料金算出
			$hour = $total_hour % 24;
			$hour_price = $hour * $this->hour_price;
			if ($hour_price > $this->day_price) {
				// 24時間最大料金を超えさせない
				$hour_price = $this->day_price;
				$hour = 0; // 時間計算ではなく、
				$day += 1; // 日計算とする
			}
			$price = $day_price + $hour_price;
		}
		if ($detail) {
			return compact('total_hour', 'day', 'hour', 'price');
		} else {
			return $price;
		}
	}

	// 時間と料金の表示用
	public function getTimePrice($detail = null) {
		$start_to_return_time = $this->return_time - $this->start_time;
		if ($start_to_return_time < 0) {
			// 自転車が戻ってきてない
			return '';
		}
		$total_hour = ceil($start_to_return_time / 3600.0);
		$day = floor($total_hour / 24);
		$hour = $total_hour % 24;
		// 料金はモデルに設定してあるのを使う
		$total_price = $this->total_price;
		if ($detail) {
			return compact('total_hour', 'day', 'hour', 'total_price');
		} else {
			if (empty($day)) {
				$time = $hour .'h';
			} else {
				$time = number_format($day) .'d'. $hour .'h';
			}
			return $time .' / ¥'. number_format($total_price);
		}
	}

	/**
	 * 売上の分配
	 */
	public function distributeIncome($income = null) {
		// 入金
		if (!is_null($income)) {
			// 分配だけ計算
			$total = null;
			$commission = null;
			$system_fee = null;
			$transaction_fee = null;
		} elseif (empty($total = $this->getTotalPrice())) {
			// 合計がゼロの場合、決済しない
			$commission = 0;
			$system_fee = 0;
			$transaction_fee = 0;
		} else {
			// 決済手数料
			if ($this->payment_method == 1) {
				// クレジットカード
				$commission_rate = Config::get('master.CARD_COMMISSION_RATE');
			} elseif ($this->payment_method == 2) {
				// ソフトバンクまとめて支払い
				$commission_rate = Config::get('master.SB_COMMISSION_RATE');
			} else {
				// クレジットカードの手数料率をデフォルトとしとく
				$commission_rate = Config::get('master.CARD_COMMISSION_RATE');
			}
			$commission = ceil($total * $commission_rate); // 決済手数料率
			$transaction_fee = Config::get('master.TRANSACTION_FEE'); // トランザクションフィー
			$system_fee = $commission + $transaction_fee; // 決済手数料
			$income = $total - $system_fee; // 入金
			if ($income < 0) {
				$income = 0;
			}
		}
		// 自転車分
		$bike_fee = ceil($income * Config::get('master.BIKE_COST_RATE'));
		$bike_breakdown = $this->bike_breakdown($bike_fee);
		// 駐輪場分
		$port_fee = $income - $bike_fee;
		$port_breakdown = $this->port_breakdown($port_fee);
		// 
		return compact('total', 'commission', 'system_fee', 'income')
			+ compact('bike_fee')+ $bike_breakdown
			+ compact('port_fee')+ $port_breakdown;
	}
	// 自転車売上内訳
	public function bike_breakdown($fee) {
		$bike_charge  = ceil($fee * $this->bike->company->system_charge_rate?:0);
		$bike_payment = $fee - $bike_charge;
		return compact('bike_charge', 'bike_payment');
	}
	// 駐輪場売上内訳
	public function port_breakdown($fee) {
		$port_charge  = ceil($fee * $this->return_port->company->system_charge_rate?:0);
		$port_payment = $fee - $port_charge;
		return compact('port_charge', 'port_payment');
	}

	// 売上の分配を再計算して保存
	public function resetPriceDistribute() {
		// $this->total_price  = $this->getTotalPrice();//金額の再計算はしない（時間と金額がマッチしないdataがあるため
		$distributed = $this->distributeIncome();
		$this->rental_price   = $distributed['bike_fee'];     // 自転車、売上
		$this->rental_charge  = $distributed['bike_charge'];  // 自転車、システム利用料
		$this->rental_payment = $distributed['bike_payment']; // 自転車、支払
		$this->port_price   = $distributed['port_fee'];     // 駐輪場、売上
		$this->port_charge  = $distributed['port_charge'];  // 駐輪場、システム利用料
		$this->port_payment = $distributed['port_payment']; // 駐輪場、支払
		$this->system_price  = $distributed['system_fee']; // 決済手数料
		$this->save();
	}

	/**
	 * 計算に適用された料金プランを表示
	 * 時間あたり料金と日当たり料金を計算し、安い方を返す
	 * @return [type] [description]
	 */
	public function getPlan(){
		$hour_price = ceil(($this->return_time-$this->start_time)/3600.0)*$this->hour_price;
		$day_price = ceil(($this->return_time-$this->start_time)/(3600*24))*$this->day_price;
		//基本両方表示
		return '<span>¥'.number_format($this->hour_price).'/1時間あたり'.'<span>¥'.number_format($this->day_price).'/1日あたり</span>';
		// if($hour_price > $day_price)
		// 	return '¥'.number_format($this->day_price).'/1日あたり';
		// return '¥'.number_format($this->hour_price).'/1時間あたり';
	}

	/* 合計 */
	public function getTotalPrice() {
		if($this->total_price!==null)//一回でも登録された場合（それが０円であっても
			return $this->total_price;
		$price = $this->getPrice();
		if (is_null($price)) {
			// 自転車が戻ってきてない
			return null;
		}
		if($price - $this->discount >0)
			return $price - $this->discount;
		return 0;
	}
	/**
	 * 使用可能なクーポンを返す
	 */
	public function pickUserCoupon() {
		//クーポン確認
		$user_coupons = Model_User_Coupon::query()
			->related('coupon')
			->where('user_id',$this->user_id)
			->where('quantity','>',0)
			->where('coupon.start_time','<=',time())
			->where('coupon.end_time','>=',time())
			->get();
		if (empty($user_coupons)) {
			return false;
		} else {
			foreach ($user_coupons as $user_coupon) {
				return $user_coupon; // １件だけユーザークーポンを返す
			}
		}
	}
	/**
	 * ユーザークーポンを切って割引を計算
	 */
	public function useCoupon($user_coupon) {
		if (empty($user_coupon)) {
			return false;
		} else {
			$user_coupon->quantity --; // ユーザークーポンを切る
			$user_coupon->save();
		}
		$price_detail = $this->getPrice(true);
		extract($price_detail); // 利用時間など取得
		// クーポンから割引額を計算する
		$discount = 0;
		if (!empty($user_coupon->coupon->discount)) {
			$discount += $user_coupon->coupon->discount; // 固定割引
		}
		if (empty($day)) {
			// 一日以内なら
			if (!empty($user_coupon->coupon->discount_hour_price)) {
				$discount += $user_coupon->coupon->discount_hour_price * $hour; // 時間毎の割引
			}
		} else {
			// 一日以上なら
			if (!empty($user_coupon->coupon->discount_day_price)) {
				$discount += $user_coupon->coupon->discount_day_price * $day; // 日毎の割引
			}
		}
		if ($discount > $price) {
			// 割引の上限は料金値とする
			$discount = $price;
		}
		return $discount;
	}

	
	public function cancelOrder(){
		
		$db = Database_Connection::instance();
		$db->start_transaction();

		try {
			//与信開放
			$payment = new Payment_Sb();
			$transaction = $this->transaction;
			if(!$transaction){
				Log::error('no transaction found');
				return false;
			}
			// 決済金額を保存
			$transaction->method = 'cancel';
			$transaction->save();
			$result  = $payment->cancel_credit_transaction($transaction);
			if(!$result){
				Log::error($payment->last_error);
				return false;
			}
			//保存
			$this->status = 2;
			$this->save();
			if( $this->bike ){
				$this->bike->status = 1;
				$this->bike->save();
			}
			$db->commit_transaction();
			SendMail::rentalCancel($this);
		} catch (Exception $e) {
			$db->rollback_transaction();
			Log::error($e->getMessage());
			return false;
		}

		return true;
	}
	/**
	 * 与信枠を確保する（5000円固定）
	 * @return [type] [description]
	 */
	public function check_creadit(){
		$payment = new Payment_Sb();
		$transaction_id = $payment->do_credit_authorization($this->user->credit_card,'レンタル料金', 1,5000, 1,$this->id);
	}
	/**
	 * bikeを返却する
	 * @param port 停めようとしてるステーション
	 * @return boolean 成功可否
	 */
	public function bike_return($port){
		#TODO 決裁を投げてstatusを変えるように
		$this->return_time = time();
		$user_coupon = $this->pickUserCoupon(); // ユーザークーポンを取得
		if (empty($user_coupon)) {
			$this->discount = 0;
		} else {
			$this->discount = $this->useCoupon($user_coupon); // ユーザークーポンを減算して割引額を返す
			$this->coupon_id = $user_coupon->coupon_id; // 使用したクーポンを記録
		}
		$price = $this->getTotalPrice();
		Log::error('bike_return order_id:'.$this->id.'price:'.$price);
		
		$payment = new Payment_Sb();
		$transaction = $this->transaction;
		if(!$transaction){
			Log::error('no transaction found');
			return false;
		}
		
		// 決済金額を保存
		$transaction->price = $price;
		$transaction->save();
		if(!$price){
			//0円のときはキャンセルする
			$transaction->method = '0yen order';
			$transaction->save();
			$result  = $payment->cancel_credit_transaction($transaction);
		}else{
			$result  = $payment->capture_authorized_transaction($transaction, $price);
		}
		
		if(!$result){
			Log::error($payment->last_error);
			return false;
		}
		$db = Database_Connection::instance();
		$db->start_transaction();

		try {
			$this->return_time = time();
			$this->return_port_id = $port->id;
			$this->status = self::status_return;
			// 料金と分配金額
			$distributed = $this->distributeIncome();
			$this->total_price  = $price;
			$this->rental_price = $distributed['bike_fee'];
			$this->port_price   = $distributed['port_fee'];
			$this->system_price = $distributed['system_fee'];
			$this->rental_charge  = $distributed['bike_charge'];  // 自転車、システム利用料
			$this->rental_payment = $distributed['bike_payment']; // 自転車、支払
			$this->port_charge  = $distributed['port_charge'];  // 駐輪場、システム利用料
			$this->port_payment = $distributed['port_payment']; // 駐輪場、支払
			//
			$this->save();
			$this->bike->status = 1;
			$this->bike->now_port_id = $port->id;
			$this->bike->save();
			\SendMail::rentalComplete($this);
			$db->commit_transaction();
		} catch (Exception $e) {
			$db->rollback_transaction();
			Log::error($e->getMessage());
			return false;
		}

		return true;
	}
	/**
	 * 解錠され、レンタルを開始する
	 * @return boolean flag
	 */
	public function rentalStart(){
		if($this->status != self::status_reserve )
			return false;
		$this->bike->status = 3;
		$this->bike->now_port_id = null;
		$this->status = self::status_now_rental;
		$this->start_time = time();
		if( $this->save() ){
			\SendMail::rentalStart($this);
			return true;
		}
	}

	public function readable() {
		if (empty($this)) {
			return;
		}
		if (empty($this->start_time)) { $this->start_time_ = ''; } else {
			$this->start_time_ = Date::forge($this->start_time)->format("%Y/%m/%d %H:%M", true);
		}
		if (empty($this->return_time)) { $this->return_time_ = ''; } else {
			$this->return_time_ = Date::forge($this->return_time)->format("%Y/%m/%d %H:%M", true);
		}
		$this->status_ = $this->getStatus();
		$this->start_return_hour_ = Util::diff_hour($this->return_time, $this->start_time);
		$this->price_ = number_format($this->total_price);
		$this->payment_method_ = $this->getPaymentMethod();
		$this->start_port_ = $this->start_port?$this->start_port->name:'';
		$this->return_port_ = $this->return_port?$this->return_port->name:'';
		$this->start_port_address_ = $this->start_port?$this->start_port->getAddress():'';
		$this->return_port_address_ = $this->return_port?$this->return_port->getAddress():'';
	}
	/**
	 * 注文を会社限定する
	 * @param [type] $query      [description]
	 * @param [type] $company_id [description]
	 */
	public static function LimitCompanyOrder($query,$company_id){
		if(!$company_id)
			return $query;
		$query->related('bike');
		$query->related('return_port');
		$query->where_open();
			$query->where('bike.company_id',$company_id);
			$query->or_where('return_port.company_id',$company_id);
		$query->where_close();
		return $query;
	}

	public  function isEditable($company_id){
		if(!$company_id or Auth::member(100))
			return true;
		if(!$this->bike->company_id)
			return false;
		return $this->bike->company_id == $company_id;
	}
	// 自転車の企業と同じ企業かどうか
	public  function isBikeCompany($company_id){
		if(!$company_id or Auth::member(100)) // 管理権限ならばどの企業もオーケー
			return true;
		if(!$this->bike->company_id)
			return false;
		return $this->bike->company_id == $company_id; // 同じ企業か
	}
	// 返却駐輪場の企業と同じ企業かどうか
	public  function isReturnPortCompany($company_id){
		if(!$company_id or Auth::member(100)) // 管理権限ならばどの企業もオーケー
			return true;
		if(!$this->return_port->company_id)
			return false;
		return $this->return_port->company_id == $company_id; // 同じ企業か
	}
	public static function create_order_by_idm($code,$bike){
		$orders = array();
		try{
			DB::start_transaction();
			$ic_card  = Model_Ic_Card::query()->where('code',$code)->get_one();
			if($bike->status != Model_Bike::status_rentalable){
				Log::error('duplicate order of bike:'.$bike->id.':'.json_encode($data['bikes']));
				return false;
			}
			if( $order_session['payment'] == "credit" )  $payment_method = 1;
			else if( $order_session['payment'] == "sb" ) $payment_method = 2;
			$order = Model_Order::forge(array(
				"category_id"    => 1,
				"user_id"        => $ic_card->user_id,
				"start_port_id"  => $bike->now_port_id,
				"bike_id"        => $bike->id,
				"payment_method" => 1,
				"pin_code"       => $bike->createPinCode(),
				"plan_flag"      => 1,
				"status"         => Model_Order::status_reserve,
				"hour_price"     => $bike->hour_price,
				"day_price"      => $bike->day_price,
			));
			$bike->pin_code = $order->pin_code;
			$bike->status = 2;
			if( $order->save() and $bike->save() ) {
				$order->checkOrderDuplicate($bike->id);
				$order->check_creadit();
				$orders[$order->id] = $order;
			}
			\SendMail::rentalReserve($orders);
			DB::commit_transaction();
			return $order;
		}catch(Exception $e){
			DB::rollback_transaction();
			Log::error($e->getMessage());
			Session::set_flash('error',$e->getMessage());
			return false;
		}
	}

	/**
	 * 集計
	 */
	public static function aggregation($query_in) {
		$query = clone $query_in;
		$query->order_by('return_time', 'asc'); // 日付順
		$orders = $query->get();
		// 日毎の集計
		$daily_labels = array();
		$daily_data = array();
		foreach ($orders as $order) {
			$key = Date::forge($order->return_time)->format("%Y%m%d", true);
			if (empty($daily_labels[$key])) {
				$daily_labels[$key] = Date::forge($order->return_time)->format("%m/%d", true);
				$daily_data[$key] = (int) $order->total_price;
			} else {
				// 同じ日の金額は足し込む
				$daily_data[$key] = $daily_data[$key] + $order->total_price;
			}
		}
		$daily_labels = array_values($daily_labels);
		$daily_data = array_values($daily_data);
		//$daily_labels =  array('1/20','1/21','1/22','1/23','1/24','1/25','1/26','1/27','1/28','1/29','1/30','1/31','2/1','2/2','2/3','2/4','2/5','2/6','2/7','2/8','2/9','2/10','2/11','2/12','2/13','2/14','2/15','2/16','2/17','2/18','2/19');
		//$daily_data  = array(650000, 590000, 800000, 810000, 560000, 550000, 400000,650000, 590000, 800000, 810000, 560000, 550000, 400000,650000, 590000, 800000, 810000, 560000, 550000, 400000,650000, 590000, 800000, 810000, 560000, 550000, 400000, 230000, 300000, 910000);
		$daily_max = max($daily_data);
		// 月毎の集計
		$monthly_labels = array();
		$monthly_data = array();
		foreach ($orders as $order) {
			$key = Date::forge($order->return_time)->format("%Y%m", true);
			if (empty($monthly_labels[$key])) {
				$monthly_labels[$key] = Date::forge($order->return_time)->format("%Y-%m", true);
				$monthly_data[$key] = (int) $order->total_price;
			} else {
				// 同じ月の金額は足し込む
				$monthly_data[$key] = $monthly_data[$key] + $order->total_price;
			}
		}
		$monthly_labels = array_values($monthly_labels);
		$monthly_data = array_values($monthly_data);
		//$monthly_labels =  array('2016-1','2016-2', '2016-3');
		//$monthly_data = array(6500000, 5900000, 3500000);
		$monthly_max = max($monthly_data);
		// 総計
		$grand_total = 0;
		$rental_total = array(
			'price' => 0,
			'charge' => 0,
			'payment' => 0
		);
		$port_total = array(
			'price' => 0,
			'charge' => 0,
			'payment' => 0
		);
		$commission_total = 0;
		$discount_total = 0;
		foreach ($orders as $order) {
			$grand_total += $order->total_price;
			$rental_total['price'] += $order->rental_price;
			$rental_total['charge'] += $order->rental_charge;
			$rental_total['payment'] += $order->rental_payment;
			$port_total['price'] += $order->port_price;
			$port_total['charge'] += $order->port_charge;
			$port_total['payment'] += $order->port_payment;
			$commission_total += $order->system_price;
			$discount_total += $order->discount;
		}
		return compact('grand_total', 'rental_total', 'port_total', 'commission_total', 'discount_total',
			'daily_labels', 'daily_data', 'daily_max', 'monthly_labels', 'monthly_data', 'monthly_max');
	}
	
	//借りてる時間を返す（秒）
	public function getRentalTime(){
		if(!$this->start_time)
			return 0;
		if($this->return_time){
			return $this->return_time - $this->start_time;
		}
		return time() - $this->start_time;
	}
	//借りてる時間表示を返す
	public function getRentalTimeFormat(){
		$start_to_return_time = $this->getRentalTime();
		$total_minute = ceil($start_to_return_time / 60);
		$total_hour = floor($total_minute / 60);
		$day = floor($total_hour / 24);
		$hour = $total_hour % 24;
		$minute = $total_minute - 24*60*$day - 60*$hour;
		$h_and_m = str_pad($hour,2,'0',STR_PAD_LEFT) .':'. str_pad($minute,2,'0',STR_PAD_LEFT);
		if (empty($day)) {
			return $h_and_m;
		} else {
			return $day .'日 '. $h_and_m;
		}
	}
	
	public function changeValue($price){
		
		$db = Database_Connection::instance();
		$db->start_transaction();

		try {
			//与信金額変更
			$payment = new Payment_Sb();
			$transaction = $this->transaction;
			if(!$transaction){
				Log::error('no transaction found');
				return false;
			}
			// 決済金額を保存
			$transaction->method = '部分返金';
			$transaction->price -= $price;
			$transaction->save();
			$result  = $payment->return_credit_transaction($transaction,$price);
			if(!$result){
				Log::error($payment->last_error);
				return false;
			}
			$this->total_price -= $price;
			$this->resetPriceDistribute();
			$db->commit_transaction();
		} catch (Exception $e) {
			$db->rollback_transaction();
			Log::error($e->getMessage());
			return false;
		}
		return true;
	}

	public function checkOrderDuplicate($bike_id){
		$count = Model_Order::query()
			->where('bike_id',$bike_id)
			->where('status','in',array(Model_Order::status_reserve,Model_Order::status_now_rental))
			->count();
		if($count >1){
			Log::error('duplicate order of bike:'.$bike_id);
			throw new Exception("この自転車はすでに予約されています");
		}
		return true;
	}
}
