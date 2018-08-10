<?php

class Model_Company extends \Orm\Model_Soft
{
	protected static $_properties = array(
		'id',
		'code',
		'name',
		'short_name',
		'establish_date',
		'ceo_name',
		'major_shareholder',
		'pref_id',
		'area_id',
		'zip_1',
		'zip_2',
		'address',
		'tel',
		'opening_hour',
		'closing_hour',
		'business_hour',
		'email',
		'site_url',
		'capital',
		'business',
		'overview',
		'provision_path',
		'photo_path',
		'brand_name',
		'system_charge_rate',
		'deleted_at',
		'created_at',
		'updated_at',
	);

	protected static $_has_many = array(
		'bikes' => array(
			'model_to' => 'Model_Bike',
			'key_from' => 'id',
			'key_to' => 'company_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),
		'ports' => array(
			'key_from'       => 'id',
			'model_to'       => 'Model_Port',
			'key_to'         => 'company_id',
			'cascade_save'   => true,
			'cascade_delete' => true,
		),
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

	protected static $_table_name = 'companies';

	public static function validate($factory, $id = null)
	{
		$val = Validation::forge($factory . $id);
		$val->add_callable('MyRules');
		if ($factory == 'create') {
			$val->add_field('name', '社名', 'required')->add_rule('unique', 'companies.name');
		} else {
			$val->add_field('name', '社名', 'required')->add_rule('unique', 'companies.name', $id);
		}
		$val->add_field('short_name', '社名（短縮）', 'required');
		$val->add('establish_year', '設立年')->add_rule('valid_string', 'numeric');
		$val->add('establish_month', '設立月')->add_rule('numeric_min', 1)->add_rule('numeric_max', 12);
// TODO 設立年だけ、月だけの入力の場合のルールを追加
		$val->add('zip_1', '郵便番号（上位）')->add_rule('valid_string', 'numeric')->add_rule('exact_length', 3);
		$val->add('zip_2', '郵便番号（下位）')->add_rule('valid_string', 'numeric')->add_rule('exact_length', 4);
		$val->add('tel', '電話番号')->add_rule('match_pattern', '/^[0-9-]*$/', '半角数字とハイフン');
		$val->add('system_charge_rate', 'システム利用料率')->add_rule('numeric_min', 0)->add_rule('numeric_max', 1);
		return $val;
	}

	// 検索クエリ
	// 参考：pars03/fuel/app/classes/model/report.php
	public static function BuildSearchQuery(){
		$query = Model_Company::query();
		// 検索条件
		if (Input::get("find")) {
		 	$selectflag = 1;
			$word = '%'. Input::get("find") .'%';
			$query->where_open()
				->where("name", "LIKE", $word)
				->or_where("short_name", "LIKE", $word)
				->or_where("code", Input::get("find"))
				->where_close();
		}
		if (Input::get("area_id")) {
		 	$selectflag = 1;
			$query->where("area_id", Input::get("area_id"));
		}

		if( Input::get("order_by") == "name" ) $query->order_by('name', 'asc');
		if( Input::get("order_by") == "area_id" ) $query->order_by('area_id', 'asc');
		if( Input::get("order_by") == "address" ) $query->order_by('address', 'asc');
		if( Input::get("order_by") == "code" ) $query->order_by('code', 'asc');
		if( Input::get("order_by") == "tel" ) $query->order_by('tel', 'asc');

 		return $query;
	}

	public static function getIdFromName($name) {
		$model= self::query()->where("name", $name)->get_one();
		if ($model) {
			return $model->id;
		} else {
			return is_int($name)?$name:null;
		}
	}
	public static function getIdFromCode($code) {
		$model= self::query()->where("code", $code)->get_one();
		if ($model) {
			return $model->id;
		} else {
			return null;
		}
	}
	public static function getPortCompanies() {
		$port_companies = Model_Company::query()
						->related('ports')->where('ports.company_id', '!=', null)
						->order_by('short_name')
						->get();
		return Arr::assoc_to_keyval($port_companies,'id','short_name');
	}
	public static function getBikeCompanies() {
		$bike_companies = Model_Company::query()
						->related('bikes')->where('bikes.company_id', '!=', null)
						->order_by('short_name')
						->get();
		return Arr::assoc_to_keyval($bike_companies,'id','short_name');
	}

	public function getBrandName() {
		if( $this->brand_name )
			return $this->brand_name;
		else
			return $this->name;
	}
	public function getBusinessHourInfo() {
		$rtn = '';
		// 営業時間
		if (!empty($this->opening_hour) && !empty($this->closing_hour)) {
			$rtn .= $this->opening_hour .'〜'. $this->closing_hour;
		} elseif (!empty($this->opening_hour)) {
			$rtn .= $this->opening_hour .'〜';
		} elseif (!empty($this->closing_hour)) {
			$rtn .= '〜'. $this->closing_hour;
		}
		if (empty($rtn)) {
			// 営業時間が未設定なら、business_hour のみ
			if (!empty($this->business_hour)) {
				$rtn .= $this->business_hour;
			}
		} else {
			$rtn .= ' ';
			// 休業日
			if (!empty($this->business_hour)) {
				$rtn .= ('休業日: '. $this->business_hour);
			}
		}
		return $rtn;
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
