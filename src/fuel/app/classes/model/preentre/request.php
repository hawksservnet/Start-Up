<?php

class Model_Preentre_Request extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'status',
		
		'intention',
		'business_type',
		'business_type_text',
		'business_style',
		'business_style_text',
		'problem01',
		'problem02',
		'problem03',
		'problem04',
		'problem05',
		'problem06',
		'problem07',
		'problem08',
		'problem09',
		'problem10',
		'problem11',
		'problem12',
		'problem13',
		'problem14',
		'problem15',
		'problem16',
		'problem17',
		'problem18',
		'problem19',
		'problem20',
		'problem21',
		'problem22',
		'problem23',
		'problem24',
		'problem25',
		'problem26',
		'problem27',
		'problem28',
		'problem29',
		'problem30',
		'problem31',
		'problem32',
		'problem_text',
		//'wish',
		'wish01',
		'wish02',
		'wish03',
		'wish04',
		'wish05',
		'wish06',
		'wish07',
		'wish08',
		'wish09',
		'wish10',
		'wish11',
		'wish12',
		'wish13',
		'wish14',
		'wish15',
		'wish16',
		
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

	protected static $_table_name = 'preentre_requests';

	protected static $_belongs_to = array(
		'user' => array(
			'model_to' => 'Model_User',
			'key_from' => 'user_id',
			'key_to' => 'id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
	);

	public static function validate($factory, $id = null)
	{
		$val = Validation::forge($factory);
		$val->add_field('intention', '起業への意思', 'required');
		$val->add_field('business_type', 'お考えの事業', 'required');
		$val->add_field('business_style', '起業スタイル', 'required');
		//$val->add_field('wish', '希望するサービス', 'required');
		return $val;
	}
	
	public function getIntention() {
		$option = Config::get('master.PREENTRE_INTENTION_OPTION');
		if (array_key_exists($this->intention, $option)) {
			return $option[$this->intention];
		} else {
			return '';
		}
	}
	public function getBusinessType() {
		$option = Config::get('master.PREENTRE_BUSINESS_OPTION');
		if (array_key_exists($this->business_type, $option)) {
			return $option[$this->business_type];
		} else {
			return '';
		}
	}
	public function getBusinessStyle() {
		$option = Config::get('master.PREENTRE_BUSINESS_STYLE_OPTION');
		if (array_key_exists($this->business_style, $option)) {
			return $option[$this->business_style];
		} else {
			return '';
		}
	}
	public function getBusinessProblems() {
		$option = Config::get('master.PREENTRE_PROBLEM_OPTION');
		$ret = array();
		if (!empty($this->problem01)) $ret[1] = $option['01'];
		if (!empty($this->problem02)) $ret[2] = $option['02'];
		if (!empty($this->problem03)) $ret[3] = $option['03'];
		if (!empty($this->problem04)) $ret[4] = $option['04'];
		if (!empty($this->problem05)) $ret[5] = $option['05'];
		if (!empty($this->problem06)) $ret[6] = $option['06'];
		if (!empty($this->problem07)) $ret[7] = $option['07'];
		if (!empty($this->problem08)) $ret[8] = $option['08'];
		if (!empty($this->problem09)) $ret[9] = $option['09'];
		if (!empty($this->problem10)) $ret[10] = $option['10'];
		
		if (!empty($this->problem11)) $ret[11] = $option['11'];
		if (!empty($this->problem12)) $ret[12] = $option['12'];
		if (!empty($this->problem13)) $ret[13] = $option['13'];
		if (!empty($this->problem14)) $ret[14] = $option['14'];
		if (!empty($this->problem15)) $ret[15] = $option['15'];
		if (!empty($this->problem16)) $ret[16] = $option['16'];
		if (!empty($this->problem17)) $ret[17] = $option['17'];
		if (!empty($this->problem18)) $ret[18] = $option['18'];
		if (!empty($this->problem19)) $ret[19] = $option['19'];
		if (!empty($this->problem20)) $ret[20] = $option['20'];
		
		if (!empty($this->problem21)) $ret[21] = $option['21'];
		if (!empty($this->problem22)) $ret[22] = $option['22'];
		if (!empty($this->problem23)) $ret[23] = $option['23'];
		if (!empty($this->problem24)) $ret[24] = $option['24'];
		if (!empty($this->problem25)) $ret[25] = $option['25'];
		if (!empty($this->problem26)) $ret[26] = $option['26'];
		if (!empty($this->problem27)) $ret[27] = $option['27'];
		if (!empty($this->problem28)) $ret[28] = $option['28'];
		if (!empty($this->problem29)) $ret[29] = $option['29'];
		if (!empty($this->problem30)) $ret[30] = $option['30'];
		
		if (!empty($this->problem31)) $ret[31] = $option['31'];
		if (!empty($this->problem32)) $ret[32] = $option['32'];
		return $ret;
	}
	public static function getBusinessProblemClass($key) {
		// 06-11 は、起業メンバーが集まらない件の子要素
		$ret = '';
		if ($key >= 6 and $key <= 11) $ret = 'member-problem';
		return $ret;
	}
	public function getWishes() {
		$option = Config::get('master.PREENTRE_WISH_OPTION');
		$ret = array();
		if (!empty($this->wish01)) $ret[1] = $option['01'];
		if (!empty($this->wish02)) $ret[2] = $option['02'];
		if (!empty($this->wish03)) $ret[3] = $option['03'];
		if (!empty($this->wish04)) $ret[4] = $option['04'];
		if (!empty($this->wish05)) $ret[5] = $option['05'];
		if (!empty($this->wish06)) $ret[6] = $option['06'];
		if (!empty($this->wish07)) $ret[7] = $option['07'];
		if (!empty($this->wish08)) $ret[8] = $option['08'];
		if (!empty($this->wish09)) $ret[9] = $option['09'];
		if (!empty($this->wish10)) $ret[10] = $option['10'];
		
		if (!empty($this->wish11)) $ret[11] = $option['11'];
		if (!empty($this->wish12)) $ret[12] = $option['12'];
		if (!empty($this->wish13)) $ret[13] = $option['13'];
		if (!empty($this->wish14)) $ret[14] = $option['14'];
		if (!empty($this->wish15)) $ret[15] = $option['15'];
		if (!empty($this->wish16)) $ret[16] = $option['16'];
		return $ret;
	}
	public function getStatus() {
		$option = Config::get('master.PREENTRE_REQUEST_STATUS');
		if (array_key_exists($this->status, $option)) {
			return $option[$this->status];
		} else {
			return '';
		}
	}
	public function setApproval($status) {
		// 承認
		$this->user->type = 2; // プレアントレ
		$this->user->save();
		$this->status = $status; // ステータス
		$this->save();
	}
	public function setNoApproval($status) {
		$this->status = $status; // ステータス
		$this->save();
	}
}
