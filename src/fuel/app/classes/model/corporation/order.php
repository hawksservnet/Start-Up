<?php

class Model_Corporation_Order extends \Orm\Model_Soft
{
	protected static $_properties = array(
		'id',
		'company_name',
		'company_zip',
		'company_pref_id',
		'company_address',
		'company_tel',
		'company_fax',
		'status',
		'plan_id',
		'start_time',
		'end_time',
		'month_price',
		'num_users',
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

	protected static $_table_name = 'corporation_orders';

}
