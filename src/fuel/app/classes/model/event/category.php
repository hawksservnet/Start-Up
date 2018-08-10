<?php

class Model_Event_Category extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'event_id',
		'category_id',
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

	protected static $_table_name = 'event_categories';

	protected static $_belongs_to = array(
		'event' => array(
			'model_to' => 'Model_Event',
			'key_from' => 'event_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
		'category' => array(
			'model_to' => 'Model_Category',
			'key_from' => 'category_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
	);

}
