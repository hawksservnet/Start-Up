<?php

class Model_Port extends \Orm\Model_Soft
{
	protected static $_properties = array(
		'id',
		'name',
		'code',
		'zip_1',
		'zip_2',
		'address',
		'pref_id',
		'lat',
		'lon',
		'company_id',
		'parking_num_limit',
		'status',
		'battery_flag',
		'hide_flag',
		'photo_path',
		'deleted_at',
		'created_at',
		'updated_at',
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

	protected static $_table_name = 'ports';

	protected static $_has_many = array(
			'orders_start' => array(
				'key_from'       => 'id',
				'model_to'       => 'Model_Order',
				'key_to'         => 'start_port_id',
				'cascade_save'   => true,
				'cascade_delete' => false,
			),
			'bikes' => array(
				'model_to' => 'Model_Bike',
				'key_from' => 'id',
				'key_to' => 'port_id',
				'cascade_save' => true,
				'cascade_delete' => true,
				'conditions' => array(
					'order_by' => array('code' => 'asc'),
				),
			),
			'now_bikes' => array(
				'model_to' => 'Model_Bike',
				'key_from' => 'id',
				'key_to' => 'now_port_id',
				'cascade_save' => true,
				'cascade_delete' => true,
				'conditions' => array(
					'order_by' => array('code' => 'asc'),
				),
			),
			'bikes_rentalable' => array(
				'model_to' => 'Model_Bike',
				'key_from' => 'id',
				'key_to' => 'now_port_id',
				'cascade_save' => true,
				'cascade_delete' => true,
				"conditions" => array(
					"where" => array("status"=> 1),
				)
			),

	);

	protected static $_belongs_to = array(
		'company' => array(
			'model_to' => 'Model_Company',
			'key_from' => 'company_id',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		),
	);



	public function getRenralOrdersByUserid($user_id=null,$status=null){
		$query = Model_Order::query()
		->where('start_port_id', $this->id)
		->where('user_id', $user_id)
		->where('status', $user_id)
		->related('bike');

		if($status){
			$query->where('status',$status);
		}
		return $query->get();
	}

	public function getReserveOrdersByUserid($user_id=null){
		return Model_Order::query()->where('start_port_id', $this->id)->where('user_id', $user_id)->related('bike')->get();
	}

	public static function validate($factory, $id = null)
	{
		$val = Validation::forge($factory . $id);
		$val->add_callable('MyRules');
		$val->add_field('name', 'ステーション名', 'required');
		$val->add('zip_1', '郵便番号（上位）')->add_rule('valid_string', 'numeric')->add_rule('exact_length', 3);
		$val->add('zip_2', '郵便番号（下位）')->add_rule('valid_string', 'numeric')->add_rule('exact_length', 4);
		$val->add_field('company_id', '企業名', 'required');
		$val->add('parking_num_limit', '最大駐車可能台数')->add_rule('valid_string', 'numeric');
		$val->add('lat', '緯度')->add_rule('numeric_min', -90)->add_rule('numeric_max', 90);
		$val->add('lon', '経度')->add_rule('numeric_min', -180)->add_rule('numeric_max', 180);
		return $val;
	}

	// 検索クエリ
	// 参考：pars03/fuel/app/classes/model/report.php
	public static function BuildSearchQuery(){
		$query = Model_Port::query();
		// 検索条件
		if (Input::get("map_keyword")) {
		 	$selectflag = 1;
			$keyword = str_replace('　', ' ', Input::get("map_keyword"));
			// 都道府県名の検索
			foreach (Config::get('master.PREFECTURE_CODES') as $pref_id => $pref_name) {
				$keyword = str_replace($pref_name, '', $keyword, $count);
				if ($count) {
					$query->where('pref_id', $pref_id);
					break;
				}
			}
			if ($keywords = preg_split("/[\s,]+/", $keyword)) {
				// スペースで区切られたワード
				foreach ($keywords as $keyword) {
					$word = '%'. $keyword .'%';
					$query->where_open()
						->where("name", "LIKE", $word)
						->or_where("address", "LIKE", $word)
						->where_close();
				}
			} else {
				$word = '%'. Input::get("map_keyword") .'%';
				$query->where_open()
					->where("name", "LIKE", $word)
					->or_where("address", "LIKE", $word)
					->where_close();
			}
		}
		if (Input::get("find")) {
		 	$selectflag = 1;
			$word = '%'. Input::get("find") .'%';
			$query->where_open()
				->where("name", "LIKE", $word)
				->or_where("code", "LIKE", $word)
				->where_close();
		}
		if (Input::get("name")) {
			$selectflag = 1;
			$word = '%'. Input::get("name") .'%';
			$query->where("name", "LIKE", $word);
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
		// 順番
		if( Input::get("order_by") == "status" ) $query->order_by('status', 'asc');
		if( Input::get("order_by") == "name" ) $query->order_by('name', 'asc');
		if( Input::get("order_by") == "code" ) $query->order_by('code', 'asc');
		if( Input::get("order_by") == "company_name" ) $query->related("company")->order_by('company.name', 'asc');
		if( Input::get("order_by") == "address" ) $query->order_by('address', 'asc');
		if( Input::get("order_by") == "created_at" ) $query->order_by('created_at', 'asc');

 		return $query;
	}

	public static function get_field($field, $id)
	{
		if (empty($id)) {
			$rtn = '';
		} else {
			$sql = 'SELECT '. $field .' FROM ports WHERE id='. $id;
			$query = DB::query($sql);
			$res = $query->execute();
			if (empty($res[0])) {
				$rtn = '';
			} else {
				$rtn = Arr::get($res[0], $field);
			}
		}
		return $rtn;
	}

	public static function getIdFromName($name) {
		$model= self::query()->where("name", $name)->get_one();
		if ($model) {
			return $model->id;
		} else {
			return 0;
		}
	}
	public static function getIdFromNowPort($name) {
		$model= self::query()->where("name", $name)->get_one();
		if ($model) {
			return $model->id;
		} else {
			return 0;
		}
	}
	public static function getIdFromCode($code) {
		$model= self::query()->where("code", $code)->get_one();
		if ($model) {
			return $model->id;
		} else {
			return 0;
		}
	}
	public static function getCodeFromStatus($status) {
		$PS = Config::get('master.PORT_STATUS');
		if ($code = array_search($status, $PS)) {
			return $code;
		} else {
			return '';
		}
	}

	/** 現在止まってる台数を返す
	 *
	 */
	public function get_bike_num(){
		return count($this->now_bikes);
	}

	public function getNumBikesParkable(){
		return $this->parking_num_limit - count($this->now_bikes);
	}

	public function getNumBikesRentable(){
		return count($this->bikes_rentalable);
	}

	// ステーションの自転車情報
	public function get_bike_info() {
		$port_id = $this->id;
		$compay_id = $this->company_id;

		$query = Model_Bike::query()->where('now_port_id', $port_id);
		// 入庫している自転車数
		$all_bike_num = $query->count();
		// 同社の自転車数
		$same_company_bike_num = $query->where("company_id", $compay_id)->count();
		// 他社の自転車数
		$other_company_bike_num = $all_bike_num - $same_company_bike_num;

		return compact('all_bike_num', 'same_company_bike_num', 'other_company_bike_num');
	}

	/**
	 * 近くのステーション
	 * $range: 範囲[km]
	 */
	public function getNeighborPorts($range = 0.5) {
		$rtn = array();
		if (empty($lat = $this->lat)) { return $rtn; }
		if (empty($lon = $this->lon)) { return $rtn; }

		$select = "*,( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( lat ) ) * cos( radians( lon ) - radians(".$lon.") ) + sin( radians(".$lat.") ) * sin( radians( lat ) ) ) ) as distance";
		$query = \DB::select(\DB::expr($select))
			   ->from("ports")
			   ->where('deleted_at', NULL)
			   ->having(\DB::expr('distance'),'<', $range);
		$query->order_by('distance','asc');
		$ports = $query->as_object('Model_Port')->execute()->as_array();
		foreach ($ports as $port) {
			if ($port->id == $this->id) { continue; } // 同じステーションは除外
			$rtn[] = $port;
		}
		return $rtn;
	}
	/**
	 * マップに表示するステーションのアイコンを返す
	 * @return [type] [description]
	 */
	public function getIcon(){
		if($this->battery_flag and $this->parking_num_limit)
			return 'icon_port_battery.png';
		if($this->battery_flag)
			return 'icon_battery.png';
		return 'icon_port.png';
	}
	public function getStatusMark(){
		$this->updateStatus();//表示する前に更新
		$port_status_mark = Config::get('master.PORT_STATUS_MARK');
		if (empty($this->status))
			return $port_status_mark[0];
		return $port_status_mark[$this->status];
	}
	public function getStatusName(){
		$this->updateStatus();//表示する前に更新
		$port_status_name = Config::get('master.PORT_STATUS');
		if (empty($this->status))
			return $port_status_name[0];
		return $port_status_name[$this->status];
	}
	public function getStatusColor(){
		$this->updateStatus();//表示する前に更新
		$port_status_color = Config::get('master.PORT_STATUS_COLOR');
		if (empty($this->status))
			return $port_status_color[0];
		return $port_status_color[$this->status];
	}
	public function updateStatus(){
		if($this->parking_num_limit <= $this->get_bike_num()){
			$this->status = 9;
		}elseif($this->parking_num_limit/2 < $this->get_bike_num()){
			$this->status = 5;
		}else{
			$this->status = 1;
		}
		$this->save();
		return $this;
	}
	public  function isEditable($company_id){
		if(!$company_id or Auth::member(100))
			return true;
		if(!$this->company_id)
			return false;
		return $this->company_id == $company_id;
	}
	public function getAddress() {
		$prefecture_codes = Config::get('master.PREFECTURE_CODES');
		if (empty($this->pref_id)) {
			$pref = '';
		} else {
			$pref = $prefecture_codes[$this->pref_id];
		}
		return $pref . $this->address;
	}
}
