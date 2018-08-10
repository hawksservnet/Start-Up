<?php

class Model_Ic_Card extends \Orm\Model_Soft
{
	const num_register_limit = 4;

	protected static $_properties = array(
		'id',
		'code',
		'user_id',
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

	protected static $_table_name = 'ic_cards';

	protected static $_belongs_to = array(
			'user' => array(
				'key_from'       => 'user_id',
				'model_to'       => 'Model_User',
				'key_to'         => 'id',
				'cascade_save'   => true,
				'cascade_delete' => false,
			),
	);

	public static function validate($factory,$id=null)
	{
		$val = Validation::forge($factory);
		$val
			->add('card_num', 'ICカード番号')
			->add_rule('required')
			->add_rule('min_length',10)
			->add_rule('max_length',20)
			->add_rule('valid_string','numeric')
			->add_rule(['unique_card_num' => function ($card_num) use($id) {
				$query = self::query();
				$query->where('code', $card_num);
				if($id)
					$query->where('id', '!=',$id);
				$count = $query->count();
				if($count > 0){
					Validation::active()->set_message('unique_card_num', 'すでに登録されています');
					return false;
				}
				return true;
			}]);
		return $val;
	}

	public static function saveNewIcCard($user, $code){
		$ic_card = new Model_Ic_Card();
		$ic_card->user_id = $user->id;
		$ic_card->code = $code;
		$result = $ic_card->save();
		if( $result ){
			\SendMail::addIcCard($ic_card);
		}
		if(count($user->ic_cards)>=Model_Ic_Card::num_register_limit){
			$ic_cards = Model_Ic_Card::query()->where('user_id',$user->id)->order_by('created_at','desc')->limit(100)->offset(3)->get();
			foreach($ic_cards as $card){
				$card->delete();
			}
		}
		return $result;
	}


}
