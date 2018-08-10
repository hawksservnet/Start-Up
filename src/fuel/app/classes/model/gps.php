<?php

class Model_Gps extends \Orm\Model_Soft
{
	protected static $_properties = array(
		'id',
		'user_id',
		'bike_id',
		'order_id',
		'date',
		'lat',
		'lon',
		'status',
		'scale',
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

	protected static $_table_name = 'gps';

}
