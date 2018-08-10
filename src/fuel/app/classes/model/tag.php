<?php
class Model_Tag extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory,  $id = null)
	{
		$val = Validation::forge($factory . $id);
		$val->add_callable('MyRules');
		if ($factory == 'create') {
			$val->add_field('name', 'タグ名', 'required|max_length[200]')
				->add_rule('unique2', 'tags.name');
		} else {
			$val->add_field('name', 'タグ名', 'required|max_length[200]')
				->add_rule('unique2', 'tags.name', $id);
		}
		return $val;
	}

	protected static $_has_many = array(
		'event_tags' => array(
			'model_to' => 'Model_Event_Tag',
			'key_from' => 'id',
			'key_to' => 'tag_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),
	);

	public function getEventNum() {
		return count($this->event_tags);
	}

	public static function setSearchCondition ($query, $keyword = null) {
		if(empty($query)) $query = self::query();
		if(!empty($keyword)) {
			$query
				->where('name', 'like', "%{$keyword}%");
		}
		return $query;
	}

}
