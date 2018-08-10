<?php // app/classes/model/event.php

class Model_Event extends \Orm\Model_Soft
{
	protected static $_properties = array(
		'id',
		'title',
		'user_id',
		'organizer',
		'wp_url',
		'img_url',
        'approval',
		'capacity',
		'start_date',
		'end_date',
		'start_time',
		'end_time',
		'reception_open',
		'reception_close',
		'charge',
		'status',
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
	//protected static $_has_one = array(
	//);
	protected static $_belongs_to = array(
		'user' => array(
			'model_to' => 'Model_User',
			'key_from' => 'user_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
	);
	protected static $_has_many = array(
		'event_categories' => array(
			'model_to' => 'Model_Event_Category',
			'key_from' => 'id',
			'key_to' => 'event_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),
		'event_tags' => array(
			'model_to' => 'Model_Event_Tag',
			'key_from' => 'id',
			'key_to' => 'event_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),
		'event_requests' => array(
			'model_to' => 'Model_Event_Request',
			'key_from' => 'id',
			'key_to' => 'event_id',
			'cascade_save' => true,
			'cascade_delete' => true,
			'conditions' => array(
				'order_by' => array(
					'created_at' => 'asc'
				)
			)
		),
		'waiting_requests' => array(
			'model_to' => 'Model_Event_Request',
			'key_from' => 'id',
			'key_to' => 'event_id',
			'cascade_save' => true,
			'cascade_delete' => true,
			'conditions' => array(
				'where' => array(array('status', 2)), // キャンセル待ち
				'order_by' => array(
					'created_at' => 'asc'
				)
			)
		),
		'reserved_requests' => array(
			'model_to' => 'Model_Event_Request',
			'key_from' => 'id',
			'key_to' => 'event_id',
			'cascade_save' => true,
			'cascade_delete' => true,
			'conditions' => array(
				'where' => array( // 予約済み
					array('status', '>', 10),
					array('status', '<', 20)
				),
				'order_by' => array(
					'created_at' => 'asc'
				)
			)
		),
		'accepted_requests' => array(
			'model_to' => 'Model_Event_Request',
			'key_from' => 'id',
			'key_to' => 'event_id',
			'cascade_save' => true,
			'cascade_delete' => true,
			'conditions' => array(
				'where' => array( // 開催済み
					array('status', '>', 20),
					array('status', '<', 50)
				),
				'order_by' => array(
					'created_at' => 'asc'
				)
			)
		),
        'interview_items' => array(
            'model_to' => 'Model_Interview_Item',
            'key_from' => 'id',
            'key_to' => 'event_id',
            'cascade_save' => true,
            'cascade_delete' => true,
            'conditions' => array(
                'order_by' => array(
                    'sort_no' => 'asc'
                )
            )
        ),
	);
	protected static $_soft_delete = array(
		'mysql_timestamp' => false,
	);

	protected static $_table_name = 'events';

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		//$val->add_callable('MyRules');

		$val->add_field('title', 'イベント名称', 'required|max_length[255]');
		$val->add_field('wp_url', 'イベントページURL', 'max_length[255]');
		$val->add_field('charge', '料金', 'required|valid_string[numeric]');
		$val->add_field('capacity', '定員数', 'required|valid_string[numeric]');
		$val->add_field('organizer', '主催者', 'required|max_length[255]');
		$val->add_field('status', 'ステータス', 'required|valid_string[numeric]');
		return $val;
	}

	public static function setAddEventValidate ($val) {
		$val->add('start_date', '開催日')
			->add_rule(['check_start_date' => function () {
				if(empty(Input::post('start_year')) or empty(Input::post('start_month')) or empty(Input::post('start_day'))) {
					Validation::active()->set_message('check_start_date', '開催日が正しくないか入力されていません。');
					return false;
				}
				return true;
			}]);
		$val->add('start_time', '開催時間')
			->add_rule(['check_start_time' => function () {
				if(!empty(Input::post('start_hour')) and !empty(Input::post('start_min'))) return true;
				Validation::active()->set_message('check_start_time', '開催時間が正しくないか入力されていません。');
				return false;
			}]);
		$val->add('end_time', '終了時間')
			->add_rule(['check_end_time' => function () {
				if(!empty(Input::post('end_hour')) and !empty(Input::post('end_min'))) return true;
				Validation::active()->set_message('check_end_time', '終了時間が正しくないか入力されていません。');
				return false;
			}]);
		$val->add('reception_time', '受付開始時間')
			->add_rule(['check_reception_time' => function () {
				if(!empty(Input::post('reception_hour')) and !empty(Input::post('reception_min'))) return true;
				Validation::active()->set_message('check_reception_time', '受付開始時間が正しくないか入力されていません。');
				return false;
			}]);
		return $val;
	}

	// 予約数とキャンセル待ち数を返すサブクエリ
	public static function countSubQuery () {
		// ステータスが予約済みのレコードの合計を計算する部分的なsql
		$sum_reserve_sql = Str::tr('sum(case when `event_requests`.`status` = :STATUS_RESERVED then 1 else 0 end) as reserve_num', array('STATUS_RESERVED' => Model_Event_Request::STATUS_RESERVED));
		// ステータスがキャンセル待ちのレコードの合計を計算する部分的なsql
		$sum_cancel_wait_sql = Str::tr('sum(case when `event_requests`.`status` = :STATUS_CANCEL_WAIT then 1 else 0 end) as cancel_wait_num', array('STATUS_CANCEL_WAIT' => Model_Event_Request::STATUS_CANCEL_WAIT));

		$query = DB::select(DB::expr("`events`.*, {$sum_reserve_sql}, {$sum_cancel_wait_sql}"));
		$query
			->from('events')
			->join('event_requests', 'LEFT OUTER') // event_requestsがまだ１件も作成されていないものもヒットするようにleft outer joinを使う
			->on('event_requests.event_id', '=', 'events.id')
			->group_by('events.id'); // 重複行があるのでまとめて重複行をなくす

		return $query;
	}

	public static function setSearchCondition ($query, $params = null) {

		if(!empty($params['title'])) {
			$query->where('events.title', 'like', "%{$params['title']}%");
		}

		if(!empty($params['organizer'])) {
			$query->where('events.organizer', 'like', "%{$params['organizer']}%");
		}

		if(!empty($params['capacity_min'])) {
			$query->where('events.capacity', '>=', $params['capacity_min']);
		}

		if(!empty($params['capacity_max'])) {
			$query->where('events.capacity', '<=', $params['capacity_max']);
		}

		if(!empty($params['tag'])) {
			// $query
			// 	->related('event_tags')
			// 		->related('event_tags.tag');
			$query
				->join('event_tags')
				->on('event_tags.event_id', '=', 'events.id')
				->join('tags')
				->on('tags.id', '=', 'event_tags.tag_id');
			$query->and_where_open();
			$tags = explode(',', $params['tag']);
			foreach ($tags as $key => $tag_str) {
				$tag_str = trim(mb_convert_kana($tag_str, "s"));
				if(empty($tag_str)) continue;

				$query->or_where('tags.name', 'like', "%{$tag_str}%");
			}
			$query->and_where_close();
		}

		if(!empty($params['start_date_start'])) {
			$query->where('events.start_date', '>=', $params['start_date_start']);
		}
		if(!empty($params['start_date_end'])) {
			$query->where('events.start_date', '<=', $params['start_date_end']);
		}

		if(!empty($params['statuses'])) {
			$query->and_where_open();
			foreach ($params['statuses'] as $key => $status_id) {
				$query->or_where('events.status', $status_id);
			}
			$query->and_where_close();
		}

		if(!empty($params['categories'])) {
			$query
				->join('event_categories')
				->on('event_categories.event_id', '=', 'events.id');
			$query->and_where_open();
			foreach ($params['categories'] as $key => $category_id) {
				$query->or_where('event_categories.category_id', $category_id);
			}
			$query->and_where_close();
		}
/*
		$user = Model_User::getLoginUser();
		if($user->isOrganizer()) {
			$query->where('events.user_id', $user->id);
		}
*/
		$query->group_by('events.id');

		return $query;

	}

	public static function BuildSearchQuery($params = null){
		$query = DB::select(DB::expr('`events`.*, `sub`.`reserve_num`, `sub`.`cancel_wait_num`'))->from('events');

		// eventsテーブルの各idについて、予約済み数などを計算するサブクエリをsubという別名としてjoinする
		$sub_query = self::countSubQuery();
		$sub_query = self::setSearchCondition($sub_query, $params);
		$query
			->join(array(DB::expr("({$sub_query->compile()})"), 'sub'))
			->on('sub.id', '=', 'events.id');

		$query = self::setSearchCondition($query, $params);

		// TODO:空き有り、キャンセル待ち
		if(!empty($params['is_remaining'])) {
			$query->where(DB::expr('(`events`.`capacity` - `sub`.`reserve_num`)'), '>', 0);
			$query->where('events.status', '!=', 2); // 締め切り済みのイベントは除く
			$query->where('events.start_date', '>=', date('Y-m-d')); // 開催日を過ぎているイベントは除く
		}

		if(!empty($params['is_waiting'])) {
			$query->where('sub.cancel_wait_num', '>', 0);
		}

		return $query;
	}

	/**
	 * 最終利用時刻を返す
	 * @return [type] [description]
	 */
	public function getLastUse(){
		if($this->last_order and $this->last_order->start_time){
			return date('Y/m/d',$this->last_order->start_time);
		}
		return '';

	}
	/**
	 * ユーザーの利用回数を返す
	 * レンタル中と利用済のオーダーを数える
	 */
	public function getUseCount(){
		$query = Model_Order::query();
		$query->where('event_id',$this->id);
		$query->where_open()
			->where('status', Model_Order::status_now_rental)
			->or_where('status', Model_Order::status_return)
			->where_close();
		return $query->count();
	}

	/**
	 * アカウントが無効（停止中）かを判定
	 * group が -1 (banned role) ならば無効と判定する。
	 */
	public function isDisabled() {
		$disable = false;
		if ($this->group == -1) {
			$disable = true;
		}
		return $disable;
	}

	public function getGroupName() {
		$event_group = Config::get('master.EVENT_GROUP');
		if (array_key_exists($this->group, $event_group)) {
			return $event_group[$this->group];
		} else {
			return '';
		}
	}
	public function getType() {
		$event_types = Config::get('master.EVENT_TYPES');
		if (array_key_exists($this->type, $event_types)) {
			return $event_types[$this->type];
		} else {
			return '';
		}
	}
	public function getName($separator = ' ') {
		return $this->name_last . $separator . $this->name_first;
	}
	public function getHiraganaName($separator = ' ') {
		return $this->hiragana_name_last . $separator . $this->hiragana_name_first;
	}
	public function getSex() {
		if ($this->sex == 1)
			$sex = '男性';
		elseif ($this->sex == 2)
			$sex = '女性';
		else
			$sex = '';
		return $sex;
	}
	public function getPref() {
		$prefecture_codes = Config::get('master.PREFECTURE_CODES');
		if (empty($this->pref)) {
			$pref = '';
		} else {
			$pref = $prefecture_codes[$this->pref];
		}
		return $pref;
	}
	public function getJob() {
		$jobs = Config::get('master.JOBS');
		if (array_key_exists($this->job, $jobs)) {
			return $jobs[$this->job];
		} else {
			return '';
		}
	}
	public function getBirthday($separator = ' ') {
		if (empty($this->birthday))
			return '';
		else
			return Date::forge(strtotime($this->birthday))->format("%Y年%m月%d日");
	}
	public function getStartYear() {
		if (empty($this->start_date))
			return '';
		else
			return Date::forge(strtotime($this->start_date))->format("%Y");
	}
	public function getStartMonth() {
		if (empty($this->start_date))
			return '';
		else
			return Date::forge(strtotime($this->start_date))->format("%m");
	}
	public function getStartDay() {
		if (empty($this->start_date))
			return '';
		else
			return Date::forge(strtotime($this->start_date))->format("%d");
	}
	public function getStartHour() {
		if (empty($this->start_time))
			return '';
		else
			return Date::forge(strtotime($this->start_time))->format("%H");
	}
	public function getStartMin() {
		if (empty($this->start_time))
			return '';
		else
			return Date::forge(strtotime($this->start_time))->format("%M");
	}
	public function getEndHour() {
		if (empty($this->end_time))
			return '';
		else
			return Date::forge(strtotime($this->end_time))->format("%H");
	}
	public function getEndMin() {
		if (empty($this->end_time))
			return '';
		else
			return Date::forge(strtotime($this->end_time))->format("%M");
	}
	public function getReceptionHour() {
		if (empty($this->reception_open))
			return '';
		else
			return Date::forge(strtotime($this->reception_open))->format("%H");
	}
	public function getReceptionMin() {
		if (empty($this->reception_open))
			return '';
		else
			return Date::forge(strtotime($this->reception_open))->format("%M");
	}
	public function getStartDate() {
		return Date::forge(strtotime($this->start_date))->format("%Y年%m月%d日");
	}
	public function getStartTime() {
		return Date::forge(strtotime($this->start_time))->format("%H時%M分");
	}
	public function getEndTime() {
		return Date::forge(strtotime($this->end_time))->format("%H時%M分");
	}
	public function getRegistrationDate() {
		return Date::forge($this->created_at)->format("%Y年%m月%d日");
	}
	public function getOrganizer() {
		if(!empty($this->organizer)) return $this->organizer;
		return !empty($this->user)?$this->user->organization:'';
	}

	public function hasRelated($related_name, $id = null, $key = null, $val = null) {
		if(empty($id)) {
			return !empty($this->$related_name);
		}else {
			$arr = Arr::assoc_to_keyval($this->$related_name, $key, $val);
			return in_array($id, $arr);
		}
	}

	public function hasCategory($id = null) {
		if(empty($id)) {
			return !empty($this->event_categories);
		}else {
			$arr = Arr::assoc_to_keyval($this->event_categories, 'id', 'category_id');
			return in_array($id, $arr);
		}
	}

	public function hasTag($id = null) {
		if(empty($id)) {
			return !empty($this->event_tags);
		}else {
			$arr = Arr::assoc_to_keyval($this->event_tags, 'id', 'tag_id');
			return in_array($id, $arr);
		}	}

	public static function getTitleList() {
		$events = self::query()->get();
		foreach ($events as $event) {
			$list[$event->id] = $event->title;
		}
		return $list;
	}

	public static function getRequestStatus() {
		return Config::get('master.REQUEST_STATUS');
	}

	public function getRequestNum($status_id = null) {
		$query = Model_Event_Request::query();
		$query->where('event_id', $this->id);
		if (empty($status_id)) {
			// ステータス指定がない場合は、キャンセル以外を数える
			$query->where('status', '!=', Model_Event_Request::STATUS_CANCEL);
		} else {
			$query->where('status', $status_id);
		}
		return $query->count();
	}

	public function getReserveNum() {
		return $this->getRequestNum(Model_Event_Request::STATUS_RESERVED);
	}

	public function getCancelWaitNum() {
		return $this->getRequestNum(Model_Event_Request::STATUS_CANCEL_WAIT);
	}

	public function getCancelNum() {
		return $this->getRequestNum(Model_Event_Request::STATUS_CANCEL);
	}

	public function getAttendNum() {
		return $this->getRequestNum(Model_Event_Request::PARTICIPATED);
	}

	public function getVacancy() {
		// 空席の数を返す
		if ($this->approval == 1) {
			return 1;
		}else {
		return $this->capacity
			- count($this->reserved_requests)
			- count($this->accepted_requests);
		}
	}
	public function nextWaitingOrder() {
		// 待ちの順番を返す
		if (empty($this->waiting_requests)) {
			return 1;
		} else {
			return count($this->waiting_requests) + 1;
		}
	}

	public static function getRemindEvents() {
		$target_date = new Datetime();
		$target_date->setTimestamp(time());
		$target_date->modify('+1 day');

		$query = self::query();
		$query
			->where('start_date', '>=', $target_date->format('Y-m-d 00:00:00'))
			->where('start_date', '<=', $target_date->format('Y-m-d 23:59:59'));
		return $query;
	}
	
	/**
	 * カテゴリ名を配列で返す
	 */
	public function getCategoryNames() {
		if (empty($this->event_categories)) {
			return array();
		} else {
			foreach ($this->event_categories as $event_category) {
				$category = Model_Category::find($event_category->category_id);
				$categories[] = $category->name;
			}
			return $categories;
		}
	}
	/**
	 * タグ名を配列で返す
	 */
	public function getTagNames() {
		if (empty($this->event_tags)) {
			return array();
		} else {
			foreach ($this->event_tags as $event_tag) {
				$tag = Model_Tag::find($event_tag->tag_id);
				$tags[] = $tag->name;
			}
			return $tags;
		}
	}

}
