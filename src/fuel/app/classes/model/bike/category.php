<?php

class Model_Bike_Category extends \Orm\Model_Soft
{
	protected static $_properties = array(
		'id',
		'name',
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

	protected static $_table_name = 'bike_categories';
	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', '名前', 'required');
		return $val;
	}
}
