<?php

class Controller_Api extends Controller_Rest
{
	protected $format = 'json';
	public function before(){
		Log::warning(Uri::current());
		$json_string = file_get_contents('php://input');
		Log::warning('api params',$json_string);
		$json_string = str_replace('00000000', "0", $json_string);
		$post = json_decode($json_string,true);
		$_POST = $post?:array();
		
		parent::before();
	}

	/**
	 * 認証用トークンを取得、更新するためのマスタートークンを発行
	 * 通常時はAPI自体を休止。マスタートークン再配布の必要性があるときのみ起動する
	 */
	public function post_mastertoken()
	{
		$bike = self::getBike(Input::post('bike_id'));
		if(!$bike)
			return $this->response(array('status'=>'error','error_text'=>'no bike'),400);
		$bike->master_token = Config::get('master.master_token');
		$bike->save();
		return $this->response(array('master_token'=>$bike->master_token));

	}
	/**
	 * マスタートークンを用いてAPI認証用トークンを取得
	 */
	public function post_token()
	{
		$bike = self::getBike(Input::post('bike_id'));
		if(!$bike)
			return $this->response(array('status'=>'error','error_text'=>'no bike'),400);
		if($bike->master_token != Input::post('master_token') or !Input::post('master_token'))
			return $this->response(array('status'=>'error','error_text'=>'token mismatch'),400);
		//token配布
		$bike->createToken();
		$bike->save();
		return $this->response(array('api_token'=>$bike->token));

	}
	/**
	 * 現在の自転車の状態と位置情報をサーバーへ登録する
	 */
	public function post_register_status()
	{
		$bike = self::getBikeFromToken(Input::post('bike_id'),Input::post('api_token'));
		if(!$bike)
			return $this->response(array('error'=>'no bike'),400);
		$bike->battery_remaining = self::calcBatteryValue(Input::post('batt_remaining'));
		// $bike->status = Input::post('status');
		$bike->save();
		#TODO 実装方法確認
		// $bike->data_category = Input::post('data_category');
		if(Input::post('gps')){
			foreach(Input::post('gps') as $gps_data){
				self::save_gps($bike,$gps_data);
			}
		}

		$bike->updateGps();
		return $this->response(array("request_status"=> "OK"));
	}
	/**
	 * 自転車IDとPINコードを受領して、正当に予約されているユーザーかを認証する
	 */
	public function post_auth_reserve()
	{

		$bike = self::getBikeFromToken(Input::post('bike_id'),Input::post('api_token'));
		if(!$bike)
			return $this->response(array('status'=>'error','error_text'=>'no bike'),400);
		//緯度経度がある場合それを保存
		self::save_gps($bike,array('lat'=>Input::post('lat'),'lon'=>Input::post('lon'),'created_at'=>time()));
		$bike->updateGps();
		if(Input::post('data_category')!='01')
			return $this->response(array('status'=>'error','error_text'=>'category error'),400);
		$order = $bike->getCurrentOrder();
		if(!$order)
			return $this->response(array('status'=>'error','error_text'=>'no order'),400);
		if($order->pin_code != Input::post('pin_code'))
			return $this->response(array('status'=>'error','error_text'=>'pin_code error'),400);
		if($order->rentalStart()){
			return $this->response(array("request_status"=> "OK"));
		}else{
			return $this->response(array("request_status"=> "OK"));
			//return $this->response(array('status'=>'error','error_text'=>'rental start error'),400);
		}
		//lat lonについて検証事項確認

	}
	/**
	 * 自転車ID、ICカード番号を受領して、正当に課金可能なユーザーかを認証する
	 */
	public function post_auth_ic()
	{
		$bike = self::getBikeFromToken(Input::post('bike_id'),Input::post('api_token'));
		if(!$bike)
			return $this->response(array('status'=>'error','error_text'=>'no bike'),400);
		if(Input::post('data_category')!='01')
			return $this->response(array('status'=>'error','error_text'=>'category error'),400);
		self::save_gps($bike,array('lat'=>Input::post('lat'),'lon'=>Input::post('lon'),'created_at'=>time()));
		$bike->updateGps();
		$order = $bike->getCurrentOrder();
		if(!$order){
			//オーダー作成
			$order = Model_Order::create_order_by_idm( Input::post('idm_code'),$bike);
			if(!$order){
				return $this->response(array('status'=>'error','error_text'=>'no order'),400);
			}
		}
		if(!$order->user->ic_cards){
			return $this->response(array('status'=>'error','error_text'=>'no ic_card'),400);
		}
		foreach($order->user->ic_cards as $ic_card){
			if($ic_card->code == Input::post('idm_code')){
				if($order->rentalStart()){
					return $this->response(array("request_status"=> "OK"));
				}else{
					return $this->response(array("request_status"=> "OK"));
					//return $this->response(array('status'=>'error','error_text'=>'rental start error'),400);
				}
			}
		}
		//lat lonについて検証事項確認
		return $this->response(array('status'=>'error','error_text'=>'no ic_card match'),400);
	}
	/**
	 * 自転車IDをを受領して、返却可能かどうかを返す。
	 * 返却可能であればそのまま返却成立、不可時は返却不可である旨を応答し、ステータス遷移を行わない。
	 */
	public function post_auth_return()
	{
		$bike = self::getBikeFromToken(Input::post('bike_id'),Input::post('api_token'));
		if(!$bike)
			return $this->response(array('status'=>'error','error_text'=>'no bike'),400);
		self::save_gps($bike,array('lat'=>Input::post('lat'),'lon'=>Input::post('lon'),'created_at'=>time()));
		$bike->updateGps();
		$order = $bike->getCurrentOrder();
		if(!$order){
			Log::error('no order return bike_id:'.$bike->id);
			return $this->response(array("request_status"=> "OK"));
		}
		if($order->status != Model_Order::status_now_rental )
			return $this->response(array('status'=>'error','error_text'=>'order already return'),400);
		if($port = self::can_return($order,Input::post('lat'),Input::post('lon'))){
			if($order->bike_return($port)){
				return $this->response(array("request_status"=> "OK"));
			}else{
				return $this->response(array('status'=>'error','error_text'=>'return failed'),400);
			}
		}else{
			return $this->response(array('status'=>'error','error_text'=>'no port found'),400);
		}
	}
	/**
	 * 利用中に、解錠用ICカードを新規登録できる(どのユーザーが利用しているかはサーバーサイドで判断)
	 * 上限3枚で、4枚目が登録された場合は最も古い1枚を自動削除
	 */
	public function post_register_ic()
	{
		$bike = self::getBikeFromToken(Input::post('bike_id'),Input::post('api_token'));

		if(!$bike)
			return $this->response(array('status'=>'error','error_text'=>'no bike'),400);
		$order = $bike->getCurrentOrder();
		if(!$order)
			return $this->response(array('status'=>'error','error_text'=>'no order'),400);

		//レンタル中のみ追加可能
		if($order->status != Model_Order::status_now_rental )
			return $this->response(array('status'=>'error','error_text'=>'order already return'),400);
		if(Input::post('idm_code')){
			$ic_card = Model_Ic_Card::query()->where('code',Input::post('idm_code'))->get_one();
			if($ic_card)
				return $this->response(array('status'=>'error','error_text'=>'card already registerd'),400);

			Model_Ic_Card::saveNewIcCard($order->user, Input::post('idm_code'));

			return $this->response(array("request_status"=> "OK"));
		}
		return $this->response(array('status'=>'error','error_text'=>'no idm_code'),400);
	}
	/**
	 * 盗難の疑いがあるときにデータを登録する
	 */
	public function post_theft_warning(){
		$bike = self::getBikeFromToken(Input::post('bike_id'),Input::post('api_token'));
		if(!$bike)
			return $this->response(array('status'=>'error','error_text'=>'no bike'),400);
		$bike->status = Model_Bike::status_theft;
		$bike->save();
		#TODO 盗難時のフロー
		if(Input::post('gps')){
			foreach(Input::post('gps') as $gps_data){
				self::save_gps($bike,$gps_data);
			}
		}
		$bike->updateGps();
		return $this->response(array("request_status"=> "OK"));

	}
	/**
	 * 盗難警告状態の解除申請API
	 */
	public function post_theft_warning_off(){
		$bike = self::getBikeFromToken(Input::post('bike_id'),Input::post('api_token'));
		if(!$bike)
			return $this->response(array('status'=>'error','error_text'=>'no bike'),400);
		if(Input::post('gps')){
			foreach(Input::post('gps') as $gps_data){
				self::save_gps($bike,$gps_data);
			}
		}
		$bike->updateGps();
		if($bike->status!=Model_Bike::status_theft)
			return $this->response(array('status'=>'error','error_text'=>'status error'),400);

		$bike->status = Model_Bike::status_theft_release;
		$bike->save();
		#TODO 盗難解除時のフロー


		return $this->response(array("request_status"=> "OK"));

	}
	public function post_key_open(){
		$bike = self::getBikeFromToken(Input::post('bike_id'),Input::post('api_token'));
		if(!$bike)
			return $this->response(array('status'=>'error','error_text'=>'no bike'),400);
		if(Input::post('result')=='OK'){
			$bike->writeStatusChange($bike->status,$bike->status,'解錠');
		}elseif(Input::post('result')=='NG'){
			$bike->writeStatusChange($bike->status,$bike->status,'解錠失敗');
		}
		return $this->response(array("request_status"=> "OK"));
	}
	/**
	 * bike_idを受け取ってcodeで検索して返す
	 * @return Model_Bike
	 */
	public static function getBike($bike_id){
		if(!$bike_id)
			return null;
		$bike = Model_Bike::query()->where('code',$bike_id)->get_one();
		return $bike;
	}
	/**
	 * bike_idを受け取ってcodeで検索して返す
	 * @return Model_Bike
	 */
	public static function getBikeFromToken($bike_id,$token){
		if(!$bike_id)
			return null;
		$bike = Model_Bike::query()->where('code',$bike_id)->get_one();
		if($bike->token == $token and $token and $bike->token)
			return $bike;
		return null;
	}
	/**
	 * 返却可能領域かどうかをチェックする
	 * @param  [type] $bike 今乗ってる車両
	 * @param  [type] $lat  緯度
	 * @param  [type] $lon  経度
	 * @return boolean      返却可能領域かどうかのフラグ
	 */
	public static function can_return($bike,$lat,$lon){
		$lat = self::gps_format_change($lat);
		$lon = self::gps_format_change($lon);
		if(!$lat or !$lon)
			return false;
		$select = "*,( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( lat ) ) * cos( radians( lon ) - radians(".$lon.") ) + sin( radians(".$lat.") ) * sin( radians( lat ) ) ) ) as distance";
		$query = \DB::select(\DB::expr($select))->from("ports")->having(\DB::expr('distance'),'<',0.2);

		$query->order_by('distance','asc');
		// $query->where("date","between",array($from,$end));

		$ports = $query->as_object('Model_Port')->execute()->as_array();
		foreach($ports as $port){
			if($port->parking_num_limit > $port->get_bike_num()){
				return $port;
			}
		}
		return false;
	}
	public static function save_gps($bike,$gps_data){
		$gps_data['lat'] = self::gps_format_change($gps_data['lat']);
		$gps_data['lon'] = self::gps_format_change($gps_data['lon']);
		if($gps_data['lat']==0 or $gps_data['lon'] ==0)
			return;
		$gps_model = new Model_Gps();
		$gps_model->bike_id = $bike->id;
		$order = $bike->getCurrentOrder();
		if($order){
			$gps_model->user_id = $order->user_id;//ユーザーID
			$gps_model->order_id = $order->id;//ユーザーID
		}else{
			$gps_model->user_id = 0;//ユーザーID
			$gps_model->order_id = 0;//ユーザーID
		}
		$gps_model->lat = $gps_data['lat'];
		$gps_model->lon = $gps_data['lon'];
		$gps_model->save();
		// $gps_model->created_at = strtotime($gps_data['created_at'])?:time();
		// $gps_model->save();
		
	}
	protected static function gps_format_change($gps){
		if($gps<1000)
			return $gps;
		$gps = $gps/100;
		$gps_do = floor($gps);
		$gps_hun = floor(($gps-$gps_do)*100);
		$gps_byo = ((($gps-$gps_do)*100 - $gps_hun)*100);
		return $gps_do + ($gps_hun * 100 +$gps_byo )/6000;
	}
	public static function calcBatteryValue($value){
		switch ($value) {
			case '1':
				return 100;
			case '2':
				return 75;
			case '3':
				return 50;
			case '4':
				return 25;
			default:
				return 0;
		}
	}
}
