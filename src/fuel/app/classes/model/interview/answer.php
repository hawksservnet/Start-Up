<?php

/**
 * Model for table interview_answers
 * @author huynh
 */
class Model_Interview_Answer extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'event_request_id',
		'user_id',
		'event_id',
		'interview_item_id',
		'answer_text',
		'answer_value',
		'answer_count',
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

	protected static $_table_name = 'interview_answers';

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
        'users' => array(
            'model_to' => 'Model_User',
            'key_from' => 'user_id',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ),
	);


	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		// validate

		return $val;
	}

	public static function get_field($field, $id)
	{
		if (empty($id)) {
			$rtn = '';
		} else {
			$sql = 'SELECT '. $field .' FROM interview_answers WHERE id='. $id;
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

    /**
     * Get Tool tip content, list of interview answer
     * @param int $event_request_id
     * @param int $limit
     * @return array
     */
    public static function findByEventRequestId($event_request_id, $limit = 0) {
        $model= self::query()
            ->related('interview_items')
            ->where("event_request_id", $event_request_id)
            ->order_by('interview_items.sort_no')
            ->get();
        $tooltipContent = [];
        $count = 0;
        foreach ($model as $interview_answer){
            $newContent = $interview_answer->interview_items->item_name . "：";
            if($interview_answer->interview_items->type == Model_Interview_Item::INTERVIEW_TEXT ||
                $interview_answer->interview_items->type == Model_Interview_Item::INTERVIEW_TEXTAREA){
                $newContent = $newContent . $interview_answer->answer_text;
            } elseif($interview_answer->interview_items->type == Model_Interview_Item::INTERVIEW_RADIO ||
                $interview_answer->interview_items->type == Model_Interview_Item::INTERVIEW_CHECKBOX) {
                $newContent = $newContent . str_replace(';',' ',$interview_answer->answer_value);
            }
            $tooltipContent[] = $newContent;
            $count ++;
            if($count >= $limit && $limit > 0){
                break;
            }
        }
        return $tooltipContent;
    }

    public static function findByEventRequestIdToArray($event_request_id, $limit = 0) {
        $limit = $limit==0?2147483647:$limit;
        $model= self::query()
            ->related('interview_items')
            ->where("event_request_id", $event_request_id)
            ->order_by('interview_items.sort_no')
           
            ->get();
        return $model;
    }

	public static function getTotalAnswerEvent($event_request_id) {
		if (is_array($event_request_id)) {
			  $model= self::query()
            ->related('interview_items')
			->where('event_request_id', 'in',$event_request_id)
            ->order_by('interview_items.sort_no')
            
            ->count();
			return $model;
		}

	}

}
