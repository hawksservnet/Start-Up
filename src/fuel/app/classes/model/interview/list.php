<?php

/**
 * Model for table interview_lists
 * @author huynh
 */
class Model_Interview_List extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'event_id',
		'interview_item_id',
		'list_value',
		'list_text',
		'sort_no',
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

	protected static $_table_name = 'interview_lists';

	protected static $_belongs_to = array(
        'interview_items' => array(
            'model_to' => 'Model_Interview_Item',
            'key_from' => 'interview_item_id',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false,
		),
        'events' => array(
            'model_to' => 'Model_Event',
            'key_from' => 'event_id',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ),
	);


	public static function validate($factory)
	{
		$val = Validation::forge($factory);
        $val->add_field('list_value', 'リスト値', 'required|max_length[255]');
        $val->add_field('list_text', 'リスト表示値', 'required|max_length[255]');
        $val->add_field('sort_no', 'ソートNO', 'required|valid_string[numeric]');
		return $val;
	}

	public static function BuildSearchQuery(){
		$query = Self::query();

		// 順番
        if (!empty(Input::get("order_by"))) {
            if( Input::get("order_by") == "list_value" ) $query->order_by('list_value', 'asc');
            if( Input::get("order_by") == "sort_no" ) $query->order_by('sort_no', 'asc');
            if( Input::get("order_by") == "list_text" ) $query->order_by('list_text', 'asc');
        }

 		return $query;
	}

	public static function get_field($field, $id)
	{
		if (empty($id)) {
			$rtn = '';
		} else {
			$sql = 'SELECT '. $field .' FROM interview_lists WHERE id='. $id;
			$query = DB::query($sql);
			$res = $query->execute();
			if (empty($res[0])) {
				$rtn = '';
			} else {
				$rtn = Arr::get($res[0], $field);
			}
		}
		return $rtn;
	}
    public static function queryFromItemId($itemId, $eventId) {
        $model= self::query();
        $model = $model->where(['event_id','=',$eventId])
            ->where(['interview_item_id','=',$itemId]);
        return $model;
    }

}
