<?php

class Model_Bike extends \Orm\Model_Soft
{
	const status_unknown = 0;
	const status_rentalable = 1;
	const status_reserve = 2;
	const status_now_rental = 3;
	const status_unavailable = 9;
	const status_theft = 99;
	const status_theft_release = 100;
	protected static $_properties = array(
		'id',
		'code',
		'company_id',
		'port_id',
		'now_port_id',
		'category_id',
		'hour_price',
		'day_price',
		'discount_hour_price',
		'discount_day_price',
		'status',
		'pin_code',
		'last_battery_change',
		'battery_remaining',
		'key_number',
		'insurance_number',
		'rent_percentage',
		'return_percentage',
		'photo_path',
		'lat',
		'lon',
		'deleted_at',
		'created_at',
		'updated_at',
		'token',
		'master_token',
		'inspection',
	);

	protected static $_has_many = array(
		'orders' => array(),
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

	protected static $_table_name = 'bikes';

	protected static $_belongs_to = array(
			'company' => array(
				'key_from'       => 'company_id',
				'model_to'       => 'Model_Company',
				'key_to'         => 'id',
				'cascade_save'   => true,
				'cascade_delete' => false,
			),
			'port' => array(
				'key_from'       => 'port_id',
				'model_to'       => 'Model_Port',
				'key_to'         => 'id',
				'cascade_save'   => true,
				'cascade_delete' => false,
			),
			'now_port' => array(
				'key_from'       => 'now_port_id',
				'model_to'       => 'Model_Port',
				'key_to'         => 'id',
				'cascade_save'   => true,
				'cascade_delete' => false,
			),
			'category' => array(
				'key_from'       => 'category_id',
				'model_to'       => 'Model_Bike_Category',
				'key_to'         => 'id',
				'cascade_save'   => true,
				'cascade_delete' => false,
			),
	);

	public static function validate($factory, $id = null)
	{
		$val = Validation::forge($factory . $id);
		$val->add_callable('MyRules');
		if ($factory == 'create') {
			$val->add_field('code', '車両ナンバー', 'required')->add_rule('unique', 'bikes.code');
		} else {
			$val->add_field('code', '車両ナンバー', 'required')->add_rule('unique', 'bikes.code', $id);
		}
		$val->add_field('company_id', '企業', 'required');
		$val->add_field('port_id', 'ステーション', 'required');
		$val->add_field('category_id', '自転車カテゴリ', 'required');
		// 料金
		$val->add('hour_price', '１時間あたり料金')->add_rule('price_unit', 10)
			->add_rule('numeric_min', 50);
		$val->add('day_price', '１日あたり料金')->add_rule('price_unit', 10)
			->add_rule('numeric_min', 100)
			->add_rule('ge_field', 'hour_price', '１時間あたり料金');
		// メッセージ調整
		$val->set_message('numeric_min', ':label には、:param:1 円以上の金額を入力して下さい。');
		return $val;
	}

	// 検索クエリ
	// 参考：pars03/fuel/app/classes/model/report.php
	public static function BuildSearchQuery(){
		$query = Model_Bike::query();
		// 検索条件
		if (Input::get("find")) {
		 	$selectflag = 1;
			$word = '%'. Input::get("find") .'%';
			$query->where_open()
				->where("code", "LIKE", $word)
				->where_close();
		}
		if (Input::get("code")) {
			$query->where("code", Input::get("code"));
		}
		if (Input::get("company_id")) {
		 	$selectflag = 1;
			$query->where("company_id", Input::get("company_id"));
		}
		if (is_numeric(Input::get("status"))) {
			$selectflag = 1;
			if (Input::get("status") == 0) {
				$query->where_open()
					->where("status", 0)
					->or_where("status", null)
					->where_close();
			} else {
				$query->where("status", Input::get("status"));
			}
		}
		if (Input::get("is_bike_ok")) {
		// 点検フラグinspection が empty ならばOK
		 	$selectflag = 1;
			if (Input::get("is_bike_ok") == 'ok') {
				$query->where_open()
					->where("inspection", NULL)
					->or_where("inspection", 0)
					->where_close();
			} else {
				$query->where("inspection", ">", 0);
			}
		}

		if( Input::get("order_by") == "status" ) $query->order_by('status', 'asc');
		if( Input::get("order_by") == "code" ) $query->order_by('code', 'asc');
		if( Input::get("order_by") == "battery_remaining" ) $query->order_by('battery_remaining', 'asc');
		
 		return $query;
	}

	// 最終貸出日
	// ordersのreturn_timeが一番大きいもの
	public function last_order_date() {
		$order = Model_Order::find('last', array(
			'where' => array(
				array('bike_id' => $this->id)
			),
			'order_by' => array('return_time' => 'asc')
		));
		if (empty($order->return_time)) {
			return '';
		} else {
			return Date::forge($order->return_time)->format("%Y/%m/%d %H:%M", true);
		}
	}

	// 現在のオーダー状況
	public function getCurrentOrder() {
		// 移動中のorderを探す
		$order = Model_Order::find('last', array(
			'where' => array(
				array('status', 'in', array(Model_Order::status_reserve,Model_Order::status_now_rental)),
				array('return_time', null),
				array('bike_id', $this->id)
			),
			'order_by' => array(
				// 'start_time' => 'asc',
				'created_at' => 'desc',
			)
		));

		return $order;
	}

	// ステータス表示
	public function getStatus() {
		$BS = Config::get('master.BIKE_STATUS');
		if (empty($this->status)) {
			$bike_status = $BS[0];
		} else {
			$bike_status = Arr::get($BS, $this->status);
		}
		return $bike_status;
	}

	// オーダー取得（期間のフィルター付き）
	// キャンセルされた件は除く
	public function getOrders($get_params) {
		$query = Model_Order::query();
		$query->where('bike_id',$this->id);
		$query->where('status','!=',Model_Order::status_cancel);
		if (!empty($get_params['date_start'])) {
			$query->where('created_at','<',strtotime($get_params['date_start']));
		}
		if (!empty($get_params['date_end'])) {
			$query->where('created_at','>=',strtotime($get_params['date_end'])+ 24*60*60);
		}
		if(Auth::member(20)){
			Model_Order::LimitCompanyOrder($query,Model_User::getLoginUser()->company_id);
		}
		
		return $query->order_by('status','asc')->order_by('return_time','desc')->get();
	}

	public function readable() {
		$this->battery_remaining_ = intval($this->battery_remaining);
		$this->hour_price_        = number_format($this->hour_price);
		$this->day_price_         = number_format($this->day_price);
	}
	

	public static function getIdFromCategory($name) {
		$model= Model_Bike_Category::query()->where("name", $name)->get_one();
		if ($model) {
			return $model->id;
		} else {
			return is_int($name)?$name:null;
		}
	}
	public static function getCodeFromStatus($status) {
		$BS = Config::get('master.BIKE_STATUS');
		if ($code = array_search($status, $BS)) {
			return $code;
		} else {
			return '';
		}
	}
	/**
	 * api用のトークンを生成する
	 * @return string token
	 */
	public function createToken(){
		$TOKEN_LENGTH = 16;//16*2=32バイト
		$bytes = openssl_random_pseudo_bytes($TOKEN_LENGTH);
		$this->token = bin2hex($bytes);
		return bin2hex($bytes);
	}
	/**
	 * Model_Gpsから最新のGPSにアップデートする（Model_Gpsは一気に更新される可能性があるため)
	 */
	public function updateGps(){
		$gps = Model_Gps::query()->where('bike_id',$this->id)->order_by('created_at','desc')->get_one();
		if($gps){
			$this->lat = $gps->lat;
			$this->lon = $gps->lon;
			$this->save();
		}
	}
	public function getNowLocation(){
		return  Model_Gps::query()->where('bike_id',$this->id)->order_by('created_at','desc')->get_one();
	}
	/**
	 * 車両ステータスの移り変わりを記録する
	 * @param  [type] $from_status [description]
	 * @param  [type] $to_status   [description]
	 * @param  [type] $comment     [description]
	 * @return [type]              [description]
	 */
	public function writeStatusChange($from_status,$to_status,$comment){
		$status_change = new Model_Bike_Status_Change();
		$status_change->bike_id = $this->id;
		$status_change->port_id = $this->now_port_id?:0;
		$status_change->from_status = $from_status;
		$status_change->to_status = $to_status;
		$status_change->comment = $comment;
		return $status_change->save();
	}

	/*
	 * 解錠コードの生成
	 * ランダムに1から6までの数字を４つ並べて返す
	 */
	public function createPinCode($exclude = array(0,1111,2222,3333,4444,5555,6666,7777,8888,9999)) {
		for ($i = 0; $i < 1000; $i++) {
			// 除外コード以外のpinコードがランダム生成できるまで繰り返す
			$pin_code = (string)rand(1,6);
			$pin_code .= (string)rand(1,6);
			$pin_code .= (string)rand(1,6);
			$pin_code .= (string)rand(1,6);
			if (!in_array($pin_code, $exclude)) {
				return $pin_code;  // 除外コード以外のコード
			}
		}
		// 生成できなかった
		return null;
	}
	public  function isEditable($company_id){
		if(!$company_id or Auth::member(100))
			return true;
		if(!$this->company_id)
			return false;
		return $this->company_id == $company_id;
	}

	// バッテリー
	public function getBatteryImg() {
		if (empty($this->battery_remaining))
			$path = 'common/_icon/icon_battery_10.svg';
		elseif ($this->battery_remaining <= 25 )
			$path = 'common/_icon/icon_battery_10.svg';
		elseif ($this->battery_remaining <= 50 )
			$path = 'common/_icon/icon_battery_50.svg';
		elseif ($this->battery_remaining <= 75 )
			$path = 'common/_icon/icon_battery.svg';
		else
			$path = 'common/_icon/icon_battery_100.svg';
		$img = '<img src="'. Asset::get_file($path, 'img') .'">';
		return $img;
	}
}
