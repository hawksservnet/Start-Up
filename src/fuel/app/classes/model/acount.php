<?php

class Model_Acount extends \Orm\Model_Soft
{
	const USER = 1;
	const ORGANIZER = 50;
	const ADMIN = 100;

	protected static $_properties = array(
		'id',
		'login_id',
		'password',
		'account_name',
		'authority',
		'avail_flg',
		'created_id',
		'created_date',
		'modified_id',
		'modified_date',
		'deleted_at',
		'last_login',
		'login_hash',
	);


	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
			'property' => 'created_date',
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
			'property' => 'modified_date',
		),
	);



	protected static $_table_name = 'acounts';

	public function isOrganizer() {
//		return Auth::member(self::ORGANIZER);
		if ($this->authority == 2) return true;
	}
	public function isAdmin() {
//		return Auth::member(self::ADMIN);
		$permissionList = array(
			'Controller_Admin_Events' => array(0, 1, 2, 5),
			'Controller_Admin_Category' => array(0, 1),
			'Controller_Admin_Tag' => array(0, 1),
			'Controller_Admin_Users' => array(0, 1, 5),
			'Controller_Admin_Preentre_Requests' => array(0, 1, 5),
		);
		if(isset($permissionList[Request::active()->controller]) &&  in_array($this->authority, $permissionList[Request::active()->controller])){
			return true;
		}
		return false;
		
//		if ($this->authority == 0) return true;
	}


}
