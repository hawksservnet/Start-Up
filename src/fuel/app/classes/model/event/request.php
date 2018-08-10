<?php

class Model_Event_Request extends \Orm\Model
{
	const STATUS_REQUEST = 1;
	const STATUS_CANCEL_WAIT = 2;
	const STATUS_RESERVED = 11;
	const STATUS_ACCEPTED = 21;
	const STATUS_PARTICIPATED = 31;
	const STATUS_ABSENTED = 41;
	const STATUS_CANCEL = 99;
    const APPROVAL = 1;
    const NON_APPROVED = 2;
    const APPROVAL_WAITING = 0;

	protected static $_properties = array(
		'id',
		'user_id',
		'event_id',
		'status',
		'waiting_order',
		'option',
		'note',
        'approval',
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

	protected static $_table_name = 'event_requests';

	public static function validate($factory, $id = null)
	{
		$val = Validation::forge($factory);
		//$val->add_callable('MyRules');

		$val->add_field('user_id', 'ユーザーID', 'required');
		$val->add_field('event_id', 'イベントID', 'required');
		$val->add_field('status', 'ステータス', 'required');
		return $val;
	}

	public static function BuildSearchQuery($params){
		$query = self::query();

		return $query;
	}

	protected static $_belongs_to = array(
		'user' => array(
			'model_to' => 'Model_User',
			'key_from' => 'user_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
		'event' => array(
			'model_to' => 'Model_Event',
			'key_from' => 'event_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
	);

	public function getStatusClass() {
		if ($this->status == self::STATUS_CANCEL_WAIT) {
			// キャンセル待ち
			return 'red';
		} else {
			return 'green';
		}
	}

	public static function getRequestStatus() {
		return Config::get('master.REQUEST_STATUS');
	}

	public function getStatus(){
		$event_request = $this;
  		$erStatus = '';
		$event = $event_request->event;
		if ($event_request->status == Model_Event_Request::STATUS_CANCEL_WAIT) {
					$erStatus = 'キャンセル待ち';
				} else if ($event_request->status == Model_Event_Request::STATUS_PARTICIPATED) {
					$erStatus = '参加済み';
				} else if ($event_request->status == Model_Event_Request::STATUS_CANCEL) {
					if ($event_request->approval ==  Model_Event_Request::APPROVAL)
					$erStatus = 'キャンセル（承認後）';
				else 
					$erStatus = 'キャンセル';
				} else {
					if ($event->approval == 0){
						if($event_request->status == Model_Event_Request::STATUS_RESERVED) {
							$erStatus = '予約済';
						}
					} else {
						if ($event_request->approval == Model_Event_Request::APPROVAL_WAITING) {
							$erStatus = '審査中';
						} else if ($event_request->approval == Model_Event_Request::APPROVAL) {
							$erStatus = '当選';
						} else if ($event_request->approval == Model_Event_Request::NON_APPROVED) {
							$erStatus = '落選';
						}
						
					}
				}
		return $erStatus;
	}

	public function getAppvoral(){
		$current_date = new \DateTime();
		$event_request = $this;
		$start_date= date("Y-m-d H:i", strtotime($this->event->start_time));
		if ($start_date < $current_date->format('Y-m-d H:i') || $event_request->status==99 ||  $event_request->status ==31){
			return '';
		} else {
			if($event_request->approval == 0 ) {
				return '承認まち';
			} elseif($event_request->approval == 1) {
				return '承認';
			} elseif($event_request->approval == 2) {
				return '非承認';
			}
		}
		return '';
	}

	public function getWaitingInfo(){
		if ($this->status == self::STATUS_CANCEL_WAIT) {
			// キャンセル待ち
			return '（'. $this->getWaitingOrder() .'人目）';
		} else {
			return '';
		}
	}
	public function getWaitingOrder() {
		$waiting_requests = $this->event->waiting_requests;
		$count = 0;
		foreach ($waiting_requests as $request) {
			$count += 1;
			if ($request->id == $this->id) {
				break;
			}
		}
		return $count;
	}

	public static function setSearchCondition ($query, $condition) {
		if(!empty($condition['user_status'])) {
			$query->and_where_open();
			foreach ($condition['user_status'] as $key => $user_status_id) {
				$query->or_where('status', $user_status_id);
			}
			$query->and_where_close();
		}

		if(!empty($condition['keyword'])) {
			$query->related('user');
			$query->and_where_open();
				$query->or_where(DB::expr("concat(`t1`.`name_last`, '　', `t1`.`name_first`)"), 'like', "%{$condition['keyword']}%");
				$query->or_where(DB::expr("concat(`t1`.`name_last`, ' ', `t1`.`name_first`)"), 'like', "%{$condition['keyword']}%");
				$query->or_where('user.tel', 'like', "%{$condition['keyword']}%");
				$query->or_where('user.email', 'like', "%{$condition['keyword']}%");
			$query->and_where_close();
		}

		return $query;
	}

	public static function countStatusQuery($event_id, $status_id) {
		$query = self::query();
		$query->select(DB::expr('count(`id`)'));
		$query
			->where('event_id', $event_id)
			->where('status', $status_id);
		return $query;

	}

	public static function countReserveQuery($event_id) {
		return self::countStatusQuery($event_id, self::STATUS_RESERVED);
	}

	public static function countCancelWaitQuery($event_id) {
		return self::countStatusQuery($event_id, self::STATUS_CANCEL_WAIT);
	}

	public static function getOldestCancelWait($event_id) {
		$query = self::query();
		$query
			->where('event_id', $event_id)
			->where('status', self::STATUS_CANCEL_WAIT)
			->order_by('created_at', 'asc');
		return $query->get_one();
	}
    /**
     * @author: HuynhPS
     * @param int $eventId input parameter
     * @param int $approvalStatus approval status: 0:承認まち 1:承認済 2:非承認
     * @return mixed
     */
    public static function countApprovalNumberQuery($eventId, $approvalStatus) {
        $query = self::query();
        return $query
            ->where('event_id','=',$eventId)
            ->where('status', '!=', self::STATUS_CANCEL)
            ->where('approval','=',$approvalStatus)
            ->count('id');
    }

	/**
     * @author: HuynhPS
     * @param int $eventId input parameter
     * @param int $Status approval status: 0:承認まち 1:承認済 2:非承認
     * @return mixed
     */
    public static function countStatusNumberQuery($eventId, $Status) {
        $query = self::query();
        return $query
            ->where('event_id','=',$eventId)
            ->where('status', '=', $Status)
            ->count('id');
    }
}
