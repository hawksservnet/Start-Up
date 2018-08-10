<?php

class Model_Coupon extends \Orm\Model_Soft
{
	protected static $_properties = array(
		'id',
		'code',
		'name',
		'quantity',
		'discount',
		'discount_hour_price',
		'discount_day_price',
		'start_time',
		'end_time',
		'comment',

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

	protected static $_table_name = 'coupons';

	protected static $_has_many = array(
			'orders' => array(
				'key_from'       => 'id',
				'model_to'       => 'Model_Order',
				'key_to'         => 'coupon_id',
				'cascade_save'   => true,
				'cascade_delete' => false,
			),
	);

	// バリデーション
	public static function validate($factory, $id = null)
	{
		$val = Validation::forge($factory);
		$val->add_callable('MyRules');
		if( $factory == 'create' ){
			$val->add('code', 'クーポンコード')
			->add_rule('required')
			->add_rule(['unique_code' => function ($code) {
				$query = self::query();
				$query->where('code', $code);
				$count = $query->count();
				if($count > 0){
					Validation::active()->set_message('unique_code', 'すでに登録されてるクーポンコードです');
					return false;
				}
				return true;
			}]);
			$val->add('start_time', '開始日')
			->add_rule('valid_date', 'Y/m/d')
			->add_rule(['feature' => function ($start_time) {
				if (empty($start_time)) return true;
				if ((strtotime($start_time)+24*60*60) < time()) {
					Validation::active()->set_message('feature', '過去の日付では登録できません。');
					return false;
				}
				return true;
			}]);
			$val->add('end_time', '終了日')
			->add_rule('valid_date', 'Y/m/d')
			->add_rule(['feature' => function ($end_time) {
				if (empty($end_time)) return true;
				if ((strtotime($end_time)+24*60*60) < time()) {
					Validation::active()->set_message('feature', '過去の日付では登録できません。');
					return false;
				}
				return true;
			}])
			->add_rule(['start_to_end' => function ($end_time) {
				$start_time = Validation::active()->input('start_time');
				if (empty($start_time)) return true;
				if (empty($end_time)) return true;
				if (strtotime($start_time) > strtotime($end_time)) {
					Validation::active()->set_message('start_to_end', '終了日は開始日より後にしてください。');
					return false;
				}
				return true;
			}]);
		}
		if( $factory == 'update' ){
			$val->add('code', 'クーポンコード')
			->add_rule('required')
			->add_rule(['unique_code' => function ($code) use ($id) {
				$login_user = Model_User::getLoginUser();
				$query = self::query();
				$query->where('code', $code);
				$query->where('id', '!=', (int)$id);
				$count = $query->count();
				if($count > 0){
					Validation::active()->set_message('unique_code', 'すでに登録されてるクーポンコードです');
					return false;
				}
				return true;
			}]);
			$val->add('start_time', '開始日')->add_rule('valid_date', 'Y/m/d');
			$val->add('end_time', '終了日')
			->add_rule('valid_date', 'Y/m/d')
			->add_rule(['start_to_end' => function ($end_time) {
				$start_time = Validation::active()->input('start_time');
				if (empty($start_time)) return true;
				if (empty($end_time)) return true;
				if (strtotime($start_time) > strtotime($end_time)) {
					Validation::active()->set_message('start_to_end', '終了日は開始日より後にしてください。');
					return false;
				}
				return true;
			}]);
		}
		$val->add_field('quantity', '回数', 'required')->add_rule('valid_string', 'numeric');
		$val->add('discount', '割引額')->add_rule('valid_string', 'numeric')->add_rule('price_unit', 10);
		$val->add('discount_day_price', '割引額')->add_rule('valid_string', 'numeric')->add_rule('price_unit', 10);
		$val->add('discount_hour_price', '割引額')->add_rule('valid_string', 'numeric')->add_rule('price_unit', 10);
		$val->add('discount_switch', '割引額')
		->add_rule(['discount_switch' => function ($switch) {
			if (empty(Validation::active()->input($switch))) {
				Validation::active()->set_message('discount_switch', '割引額を設定してください。');
				return false;
			}
			return true;
		}]);
		return $val;
	}

	// 検索クエリ
	public static function BuildSearchQuery(){
		$query = Model_Coupon::query();
		// 検索条件
		if (Input::get("find")) {
		 	$selectflag = 1;
			$word = '%'. Input::get("find") .'%';
			$query->where_open()
				->where("name", "LIKE", $word)
				->or_where("code", Input::get("find"))
				->where_close();
		}
		// 順番
		if( Input::get("order_by") == "name" ) $query->order_by('name', 'asc');
		if( Input::get("order_by") == "code" ) $query->order_by('code', 'asc');
		if( Input::get("order_by") == "quantity" ) $query->order_by('quantity', 'asc');
		if( Input::get("order_by") == "start_time" ) $query->order_by('start_time', 'asc');
		if( Input::get("order_by") == "end_time" ) $query->order_by('end_time', 'asc');
 		return $query;
	}

	// クーポン取得
	public static function getCoupon($code) {
		if (empty($code)) {
			return false;
		}
		$query = Model_Coupon::query();
		$query->where('code', $code);
		$query->order_by('created_at', 'desc')->limit(1);
		return $query->get_one();
	}

	// クーポンの有効判定
	public function isValid() {
		if (empty($this->end_time)) {
			// 有効期限の設定なし
			return true;
		} elseif ($this->end_time > time()) {
			// 有効期限の範囲内
			return true;
		} else {
			return false;
		}
	}
	
	// 可読
	public function readable() {
		if (empty($this)) {
			return;
		}
		if (empty($this->start_time)) {
			$this->start_date_ = Date::forge($this->created_at)->format("%Y/%m/%d", true);
		} else {
			$this->start_date_ = Date::forge($this->start_time)->format("%Y/%m/%d", true);
		}
		if (empty($this->end_time)) {
			$this->end_date_ = '';
		} else {
			$this->end_date_ = Date::forge($this->end_time)->format("%Y/%m/%d", true);
		}
	}
}
