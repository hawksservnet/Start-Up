<?php

class Model_Event_Tag extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'event_id',
		'tag_id',
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

	protected static $_table_name = 'event_tags';

	protected static $_belongs_to = array(
		'event' => array(
			'model_to' => 'Model_Event',
			'key_from' => 'event_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
		'tag' => array(
			'model_to' => 'Model_Tag',
			'key_from' => 'tag_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
	);

}
