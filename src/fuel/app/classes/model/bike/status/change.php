<?php

class Model_Bike_Status_Change extends \Orm\Model_Soft
{
	protected static $_properties = array(
		'id',
		'bike_id',
		'port_id',
		'status_from',
		'status_to',
		'deleted_at',
		'created_at',
		'updated_at',
		'comment',
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

	protected static $_table_name = 'bike_status_changes';

}
