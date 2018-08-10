<?php

class Model_Onetime extends \Orm\Model
{
	const num_lifetime = 3600 * 24; // 本登録まで24時間以内

	protected static $_properties = array(
		'id',
		'name_last',
		'name_first',
		'email',
		'password',
		'tel',
		'hash',
		'data',
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

	protected static $_table_name = 'onetimes';

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_callable('MyRules');
		$val->add_field('name_last', 'お名前（姓）', 'required');
		$val->add_field('name_first', 'お名前（名）', 'required');
		$val->add_field('hiragana_name_last', 'お名前（姓ふりがな）', 'required')
			->add_rule('hiragana');
		$val->add_field('hiragana_name_first', 'お名前（名ふりがな）', 'required')
			->add_rule('hiragana');
		$val->add_field('email', 'メールアドレス', 'required')
			->add_rule('valid_email')
			->add_rule(['unique_email' => function ($email) {
				$query = Model_User::query();
				$query->where('email', $email);
				$count = $query->count();
				if($count > 0){
					Validation::active()->set_message('unique_email', 'すでに登録されてるメールアドレスです');
					return false;
				}
				return true;
			}]);
		$val->add_field('emailcheck', 'メールアドレス（確認）', 'required')
			->add_rule('eq_field', 'email', 'メールアドレス');
		$val->add_field('password', 'パスワード', 'required|min_length[8]')
			->add_rule('eq_field', 'passwordcheck', 'パスワード');
		$val->add_field('passwordcheck', 'パスワード（確認）', 'required');
		$val->add_field('tel', '電話番号', 'required')
			->add_rule('max_length', 13)
			->add_rule('phone');
		$val->add_field('birth_year', '生年月', 'required');
		$val->add_field('birth_month', '生年月', 'required');
		// $val->add_field('birth_day', '生年月', 'required');
		// TODO 日付のチェックを追加する
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
		//$val->add_field('mailmagazine', 'メルマガ登録', 'required');
		$val->add_field('mailmagazine_info', 'DMによる案内', 'required');
		//$val->add('role', '起業における役割')
		//	->add_rule(['roles' => function () {
		//		if (empty(Validation::active()->input('role01'))
		//		and empty(Validation::active()->input('role02'))
		//		and empty(Validation::active()->input('role03'))
		//		and empty(Validation::active()->input('role04'))
		//		and empty(Validation::active()->input('role05'))
		//		and empty(Validation::active()->input('role06'))) {
		//			Validation::active()->set_message('roles', '起業における役割は少なくとも一つ選択してください。');
		//			return false;
		//		} else {
		//			return true;
		//		}
		//	}]);

		return $val;
	}

	public function checkLifetime(){
		if( (time()-$this->created_at) < Model_Onetime::num_lifetime ) return true;
		else return false;
	}

	/**
	 * ワンタイムのメールアドレスが登録済みのか確認
	 */
	public function checkExistingUser() {
		$query = Model_User::query();
		$query->where('email', $this->email);
		$count = $query->count();
		if ($count > 0) return true; // 登録済み
		else return false;
	}
}
