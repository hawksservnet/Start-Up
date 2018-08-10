<?php

/**
 * Model for table interview_items
 * @author huynh
 */
class Model_Interview_Item extends \Orm\Model
{
    const INTERVIEW_TEXT = 1;
    const INTERVIEW_RADIO = 2;
    const INTERVIEW_CHECKBOX = 3;
    const INTERVIEW_TEXTAREA = 4;
	protected static $_properties = array(
		'id',
		'event_id',
		'sort_no',
		'item_name',
		'type',
		'other_check',
		'select_max',
		'required',
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

	protected static $_table_name = 'interview_items';

	protected static $_has_many = array(
        'interview_lists' => array(
            'key_from'       => 'id',
            'model_to'       => 'Model_Interview_List',
            'key_to'         => 'interview_item_id',
            'cascade_save'   => true,
            'cascade_delete' => true,
            'conditions' => array(
                'order_by' => array(
                    'sort_no' => 'ASC',
                )
            ),
        ),
        'interview_answers' => array(
            'key_from'       => 'id',
            'model_to'       => 'Model_Interview_Answer',
            'key_to'         => 'interview_item_id',
            'cascade_save'   => true,
            'cascade_delete' => true,
        ),

	);

	protected static $_belongs_to = array(
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
        $val->add_field('sort_no', 'ソートNO', 'required|valid_string[numeric]');
        $val->add_field('type', 'タイプ', 'required|valid_string[numeric]');
		return $val;
	}
    public static function setAddInterviewValidate ($val) {
        $val->add('interview_types', 'タイプ')
            ->add_rule(['check_interview_types' => function () {
                if(empty(Input::post('interview_types')) or !preg_match('/^\d+$/', Input::post('interview_types'))) {
                    Validation::active()->set_message('check_interview_types', '開催日が正しくないか入力されていません。');
                    return false;
                }
                return true;
            }]);
        $val->add('item_name', '項目名')
            ->add_rule(['check_item_name' => function () {
                if(empty(Input::post('item_name')) or mb_strlen(Input::post('item_name')) > 255) {
                    Validation::active()->set_message('check_item_name', '開催日が正しくないか入力されていません。');
                    return false;
                }
                return true;
            }]);
        $val->add('list_text', 'リスト表示値')
            ->add_rule(['check_list_text' => function () {
                if(!empty(Input::post('interview_types')) and (Input::post('interview_types') == 2 or Input::post('interview_types') == 3) and empty(Input::post('interview_types'))){
                    Validation::active()->set_message('check_list_text', 'この項目は必須入力です。');
                    return false;
                }
                return true;
            }]);
        $val->add('select_max', '最大選択数')
            ->add_rule(['check_select_max' => function () {
                if(!empty(Input::post('interview_types')) and Input::post('interview_types') == 3){
                    /*
                    if(empty(Input::post('select_max')) or !preg_match('/^\d+$/', Input::post('select_max'))){
                        Validation::active()->set_message('check_select_max', '開催日が正しくないか入力されていません。');
                        return false;
                    }*/
                    if(!empty(Input::post('select_max')) && !preg_match('/^\d+$/', Input::post('select_max'))){
                        Validation::active()->set_message('check_select_max', '開催日が正しくないか入力されていません。');
                        return false;
                    }
                    $newInterviewListCount = count(explode(PHP_EOL,Input::Post('list_text')));
                    if(Input::post('select_max') === 0 or Input::post('select_max') > $newInterviewListCount){
                        Validation::active()->set_message('check_select_max', '1は' . $newInterviewListCount . '以下で入力してください。');
                        return false;
                    }
                }
                return true;
            }]);
        return $val;
    }

	public static function BuildSearchQuery($eventId){
		$query = self::query();
        $query->where('event_id','=',$eventId);
		// 順番
        if (!empty(Input::get("order_by"))) {
            if( Input::get("order_by") == "item_name" ) $query->order_by('item_name', 'asc');
            if( Input::get("order_by") == "sort_no" ) $query->order_by('sort_no', 'asc');
            if( Input::get("order_by") == "type" ) $query->order_by('type', 'asc');
        } else {
            $query->order_by('sort_no', 'asc');
        }

 		return $query;
	}
    public static function getInterviews($eventId)
    {
        return self::BuildSearchQuery($eventId)->get();
    }
	public static function get_field($field, $id)
	{
		if (empty($id)) {
			$rtn = '';
		} else {
			$sql = 'SELECT '. $field .' FROM interview_items WHERE id='. $id;
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

	public static function getIdFromName($name) {
		$model= self::query()->where("item_name", $name)->get_one();
		if ($model) {
			return $model->id;
		} else {
			return 0;
		}
	}
    public static function queryFromId($id, $eventId) {
        $model= self::BuildSearchQuery($eventId);
        $model = $model->where(['id','=',$id])
        ->order_by('sort_no', 'asc');
        return $model->get_one();
    }
    public static function selectMaxSort($eventId) {
        $model= self::BuildSearchQuery($eventId)->max('sort_no');
        return $model;
    }
}
