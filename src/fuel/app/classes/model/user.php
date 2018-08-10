<?php

class Model_User extends \Orm\Model_Soft
{
	const USER = 1;
	const ORGANIZER = 50;
	const ADMIN = 100;
	protected static $_properties = array(
		'id',
		'name_last',
		'name_first',
		'email',
		'tel',
		'password',

		'group',
		'username',
		'last_login',
		'login_hash',
		'profile_fields',

		'hiragana_name_last',
		'hiragana_name_first',
		'birthday',
		'sex',
		'zip',
		'pref',
		'city',
		'address',
		'building',
		'organization',
		'position',
		'job',
		'interest',
		'preparation',
		'mailmagazine',
		'mailmagazine_info',
		'role01',
		'role02',
		'role03',
		'role04',
		'role05',
		'role06',
		'role07',
		'role08',
		'role09',
		'role10',
		'role11',
		'role12',
		'event',
		'matching',
		'entrepreneur_date',
		'business_type',
		'industry',
		'type',
		'nationality',
		'cardid',

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
	//protected static $_has_one = array(
	//);
	//protected static $_belongs_to = array(
	//);
	protected static $_has_many = array(
			'my_requests' => array(
				'key_from'       => 'id',
				'model_to'       => 'Model_Event_Request',
				'key_to'         => 'user_id',
				'cascade_save'   => true,
				'cascade_delete' => false,
				'conditions' => array(
					'where' => array(array('status', '<', 20)), // キャンセル待ち、予約済み
				)
			),
			'accepted_requests' => array(
				'key_from'		 => 'id',
				'model_to'		 => 'Model_Event_Request',
				'key_to'		 => 'user_id',
				'cascade_save'	 => true,
				'cascade_delete' => false,
				'conditions' => array(
					'where' => array( // 開催済み
						array('status', '>', 20),
						array('status', '<', 50)
					)
				)
			),
			'event_requests' => array(
				'key_from'       => 'id',
				'model_to'       => 'Model_Event_Request',
				'key_to'         => 'user_id',
				'cascade_save'   => true,
				'cascade_delete' => false,
			),
			'preentre_requests' => array(
				'key_from'       => 'id',
				'model_to'       => 'Model_Preentre_Request',
				'key_to'         => 'user_id',
				'cascade_save'   => true,
				'cascade_delete' => false,
				'conditions' => array(
					'order_by' => array('created_at' => 'desc'),
				)
			),
			'preentre_requesting' => array(
				'key_from'       => 'id',
				'model_to'       => 'Model_Preentre_Request',
				'key_to'         => 'user_id',
				'cascade_save'   => true,
				'cascade_delete' => false,
				'conditions' => array(
					'where' => array('status' => 1),
					'order_by' => array('created_at' => 'desc'),
				)
			),
	);
	protected static $_soft_delete = array(
		'mysql_timestamp' => false,
	);

	protected static $_table_name = 'users';

	public static function validate($factory, $id = null)
	{
		$val = Validation::forge($factory);
		$val->add_callable('MyRules');

		if ($factory == 'change_pw') {
			$val->add_field('password', 'パスワード', 'required|min_length[8]')
				->add_rule('eq_field', 'passwordcheck', 'パスワード');
			$val->add_field('passwordcheck', 'パスワード（確認）', 'required');
		}
		if ($factory == 'edit' or $factory == 'add') {
			$val->add_field('name_last', 'お名前（姓）', 'required');
			$val->add_field('name_first', 'お名前（名）', 'required');
			$val->add_field('hiragana_name_last', 'お名前（姓ふりがな）', 'required')
				->add_rule('hiragana');
			$val->add_field('hiragana_name_first', 'お名前（名ふりがな）', 'required')
				->add_rule('hiragana');
			$val->add_field('email', 'メールアドレス', 'required')
				->add_rule('valid_email')
				->add_rule(['unique_email' => function ($email) use($id) {
					$login_user = Model_User::getLoginUser();
					$query = Model_User::query();
					$query->where('email', $email);
					$query->where('id', '!=' ,$id);
					$count = $query->count();
					if($count > 0){
						Validation::active()->set_message('unique_email', 'すでに登録されてるメールアドレスです');
						return false;
					}
					return true;
				}]);
			$val->add('emailcheck', 'メールアドレス（確認）')
				->add_rule('eq_field', 'email', 'メールアドレス');
			$val->add_field('tel', '電話番号', 'required')
				->add_rule('max_length', 13)
				->add_rule('phone');
			$val->add_field('birth_year', '生年月', 'required');
			$val->add_field('birth_month', '生年月', 'required');
			$val->add_field('sex', '性別', 'required');
			$val->add_field('nationality', '国籍', 'required');
			$val->add_field('zip', '郵便番号', 'required')
				->add_rule('zip');
			$val->add_field('pref', '都道府県', 'required');
			$val->add_field('city', '市町村区', 'required');
			$val->add('address', '番地')
				->add_rule('num', '-');
			$val->add_field('job', '職業', 'required');
			$val->add_field('interest', '起業への興味', 'required');
			$val->add_field('preparation', '起業への準備', 'required');
		}
		if ($factory == 'edit_dm' or $factory == 'add') {
			$val->add_field('mailmagazine_info', 'DMによる案内', 'required');
		}
		if ($factory == 'add') {
			$val->add_field('group', 'アカウント種別', 'required');
		}
		return $val;
	}

	public static function getLoginUser(){
		list(, $userid) = Auth::get_user_id();
		return self::find($userid);
	}

	public static function BuildSearchQuery($params){
		$query = self::query();

		if (isset($params["find"]) and $params["find"]) {
			$word = "%". $params["find"] ."%";
			$query->where_open()
					->where("id", $params["find"])
					->or_where("name_last", "LIKE", $word)
					->or_where("name_first", "LIKE", $word)
			->where_close();
		}
		if (isset($params["userid"]) and $params["userid"]) {
			$query->where("id", $params["userid"]);
		}
		if (isset($params["name"]) and $params["name"]) {
			$name = mb_convert_kana($params["name"], 's'); // 全角スペースを半角に
			$query->or_where_open();
			if (count($name_array = explode(' ', $name)) > 1)
			{ // スペースで区切られた検索ワードなら、それぞれで名前フィールドの検索
				foreach ($name_array as $each) {
					$word = "%". $each ."%";
					$query->and_where_open()
						->where("name_last", "LIKE", $word)
						->or_where("name_first", "LIKE", $word)
						->and_where_close();
				}
			} else {
				$query->and_where_open();
				// 名前フィールドの検索
				$word = "%". $name ."%";
				$query->or_where_open()
					->where("name_last", "LIKE", $word)
					->or_where("name_first", "LIKE", $word)
					->or_where_close();
				// 検索ワードを分割しながら、姓名続き検索
				$len = mb_strlen($name); // 検索文字列の長さ
				for ($num = 1; $num < $len; $num++) {
					$word1 = "%". mb_substr($name, 0, $num);
					$word2 = mb_substr($name, $num, $len - $num) ."%";
					$query->or_where_open()
						->where("name_last", "LIKE", $word1)
						->where("name_first", "LIKE", $word2)
						->or_where_close();
				}
				$query->and_where_close();
			}
			$query->or_where_close();
		}
		if (isset($params["kana"]) and $params["kana"]) {
			$name = mb_convert_kana($params["kana"], 's'); // 全角スペースを半角に
			$query->or_where_open();
			if (count($name_array = explode(' ', $name)) > 1)
			{ // スペースで区切られた検索ワードなら、それぞれで名前フィールドの検索
				foreach ($name_array as $each) {
					$word = "%". $each ."%";
					$query->and_where_open()
						->where("hiragana_name_last", "LIKE", $word)
						->or_where("hiragana_name_first", "LIKE", $word)
						->and_where_close();
				}
			} else {
				$query->and_where_open();
				// 名前フィールドの検索
				$word = "%". $name ."%";
				$query->or_where_open()
					->where("hiragana_name_last", "LIKE", $word)
					->or_where("hiragana_name_first", "LIKE", $word)
					->or_where_close();
				// 検索ワードを分割しながら、姓名続き検索
				$len = mb_strlen($name); // 検索文字列の長さ
				for ($num = 1; $num < $len; $num++) {
					$word1 = "%". mb_substr($name, 0, $num);
					$word2 = mb_substr($name, $num, $len - $num) ."%";
					$query->or_where_open()
						->where("hiragana_name_last", "LIKE", $word1)
						->where("hiragana_name_first", "LIKE", $word2)
						->or_where_close();
				}
				$query->and_where_close();
			}
			$query->or_where_close();
		}
		if (isset($params["birthday_start"]) and !empty(implode('',$params["birthday_start"]))) {
			$birthday_start = date(($params["birthday_start"][0]?:date('Y')).'-'.($params["birthday_start"][1]?:'01').'-01');
			$query->where("birthday", ">=", $birthday_start);
		}
		if (isset($params["birthday_end"]) and !empty(implode('', $params["birthday_end"]))) {
			$birthday_end = date(($params["birthday_end"][0]?:date('Y')).'-'.($params["birthday_end"][1]?:'12').'-01');
			$birthday_end = date('Y-m-d', strtotime($birthday_end .'+1 month'));
			$query->where("birthday", "<", $birthday_end);
		}
		if (isset($params["registration_start"]) and $params["registration_start"]) {
			$query->where("created_at", ">=", strtotime($params["registration_start"]));
		}
		if (isset($params["registration_end"]) and $params["registration_end"]) {
			$query->where("created_at", "<=", strtotime($params["registration_end"])+ 24*60*60);
		}
		if (isset($params["login_start"]) and $params["login_start"]) {
			$query->where("last_login", ">=", strtotime($params["login_start"]));
		}
		if (isset($params["login_end"]) and $params["login_end"]) {
			$query->where("last_login", "<=", strtotime($params["login_end"])+ 24*60*60);
		}
		if( Input::get("order_by") == "id" ) $query->order_by('id', 'asc');
		if( Input::get("order_by") == "name" ) $query->order_by('name_last', 'asc')->order_by('name_first', 'asc');

		if (isset($params["email"]) and $params["email"]) {
			$query->where("email", 'LIKE','%'.$params["email"].'%');
		}
		if (isset($params["tel"]) and $params["tel"]) {
			$query->where("tel", "=", $params["tel"]);
		}
		if (isset($params["sex_selected"]) and $params["sex_selected"]) {
			$query->where("sex", "in", $params["sex_selected"]);
		}
		if (isset($params["nationality"]) and $params["nationality"]) {
			$query->where("nationality", $params["nationality"]);
		}
		if (isset($params["pref"]) and $params["pref"]) {
			$query->where("pref", $params["pref"]);
		}
		if (isset($params["city"]) and $params["city"]) {
			$query->where("city", 'LIKE','%'.$params["city"].'%');
		}
		if (isset($params["interest"]) and $params["interest"]) {
			$query->where_open();
			$query->where("interest", 'in', $params["interest"]);
			if (in_array(0, $params["interest"])) {
				$query->or_where("interest", null);
			}
			$query->where_close();
		}
		if (isset($params["preparation"]) and $params["preparation"]) {
			$query->where_open();
			$query->where("preparation", 'in', $params["preparation"]);
			if (in_array(0, $params["preparation"])) {
				$query->or_where("preparation", null);
			}
			$query->where_close();
		}
		if (isset($params["organization"]) and $params["organization"]) {
			$query->where("organization", 'LIKE','%'.$params["organization"].'%');
		}
		if (isset($params["position"]) and $params["position"]) {
			$query->where("position", 'LIKE','%'.$params["position"].'%');
		}
		if (isset($params["group"]) and $params["group"]) {
			$query->where("group", $params["group"]);
		}
		if (isset($params["type_selected"]) and $params["type_selected"]) {
			$query->where("type", 'in',$params["type_selected"]);
		}
		if (isset($params["mailmagazine_info_selected"]) and $params["mailmagazine_info_selected"]) {
			$query->where("mailmagazine_info", 'in',$params["mailmagazine_info_selected"]);
		}
		return $query;
	}

	/**
	 * 最終利用時刻を返す
	 * @return [type] [description]
	 */
	public function getLastUse(){
		if($this->last_order and $this->last_order->start_time){
			return date('Y/m/d',$this->last_order->start_time);
		}
		return '';

	}
	/**
	 * ユーザーの利用回数を返す
	 * レンタル中と利用済のオーダーを数える
	 */
	public function getUseCount(){
		$query = Model_Order::query();
		$query->where('user_id',$this->id);
		$query->where_open()
			->where('status', Model_Order::status_now_rental)
			->or_where('status', Model_Order::status_return)
			->where_close();
		return $query->count();
	}

	/**
	 * アカウントを無効にする
	 * simpleauthの role を banned にしてログインできなくする。
	 * stop_flagは立てておく。
	public function toDisable() {
		$this->stop_flag = 1;
		$this->group = -1; // banned role のグループ
		return $this->save();
	}
	 */

	/**
	 * アカウントを有効に戻す
	public function toEnable($group = 1) {
		$this->stop_flag = 0;
		$this->group = $group;
		return $this->save();
	}
	 */

	/**
	 * アカウントが無効（停止中）かを判定
	 * group が -1 (banned role) ならば無効と判定する。
	 */
	public function isDisabled() {
		$disable = false;
		if ($this->group == -1) {
			$disable = true;
		}
		return $disable;
	}

	public function getGroupName() {
		$user_group = Config::get('master.USER_GROUP');
		if (array_key_exists($this->group, $user_group)) {
			return $user_group[$this->group];
		} else {
			return '';
		}
	}
	public function getType() {
		$user_types = Config::get('master.USER_TYPES');
		if (array_key_exists($this->type, $user_types)) {
			return $user_types[$this->type];
		} else {
			return '';
		}
	}
	public function getName($separator = ' ') {
		return $this->name_last . $separator . $this->name_first;
	}
	public function getHiraganaName($separator = ' ') {
		return $this->hiragana_name_last . $separator . $this->hiragana_name_first;
	}
	public function getSex() {
		if ($this->sex == 1)
			$sex = '男性';
		elseif ($this->sex == 2)
			$sex = '女性';
		else
			$sex = '';
		return $sex;
	}
	public function getPref() {
		$prefecture_codes = Config::get('master.PREFECTURE_CODES');
		if (empty($this->pref)) {
			$pref = '';
		} else {
			$pref = $prefecture_codes[$this->pref];
		}
		return $pref;
	}
	public function getJob() {
		$jobs = Config::get('master.JOBS');
		if (array_key_exists($this->job, $jobs)) {
			return $jobs[$this->job];
		} else {
			return '';
		}
	}
	public function getBirthday($separator = ' ') {
		if (empty($this->birthday))
			return '';
		else
			return Date::forge(strtotime($this->birthday))->format("%Y年%m月");
	}
	public function getBirthYear() {
		if (empty($this->birthday))
			return '';
		else
			return Date::forge(strtotime($this->birthday))->format("%Y");
	}
	public function getBirthMonth() {
		if (empty($this->birthday))
			return '';
		else
			return Date::forge(strtotime($this->birthday))->format("%m");
	}
	public function getBirthDate() {
		if (empty($this->birthday))
			return '';
		else
			return Date::forge(strtotime($this->birthday))->format("%d");
	}
	public function getRegistrationDate() {
		return Date::forge($this->created_at)->format("%Y年%m月%d日");
	}
	public function getPreparation() {
		switch ($this->preparation) {
			case '1':
				return 'している';
			case '2':
				return '情報収集中';
			default:
				return 'していない';
		}
	}

	public static function getNameList() {
		$users = self::query()->get();
		foreach ($users as $user) {
			$list[$user->id] = $user->getName();
		}
		return $list;
	}

	public function isOrganizer() {
		return Auth::member(self::ORGANIZER);
	}

	public function isAdmin() {
		return Auth::member(self::ADMIN);
	}

	public function isPreentre() {
		// 既にプレアントレ
		if ($this->type == 2) return true;
		// プレアントレ申請中
		if (!empty($this->preentre_requesting)) return true;
		// プレアントレではない
		return false;
	}
}
