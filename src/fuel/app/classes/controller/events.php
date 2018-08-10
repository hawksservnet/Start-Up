<?php // fuel/app/classes/controller/events.php

class Controller_Admin_Events extends Controller_Admin
{


	/**
	 * イベント一覧
	 */
	public function action_index()
	{
		// オーガナイザの場合は、自分の作成したイベントのみ閲覧できる
		$query = Model_Event::BuildSearchQuery(Input::get());
		if (empty(Input::get('order'))) {
			$query->order_by('id', 'desc');
		} else {
			if (Input::get('order') == 'start_date' or Input::get('order') == 'start_time') {
				$query->order_by('start_date', Input::get('desc')?'desc':'asc');
				$query->order_by('start_time', Input::get('desc')?'desc':'asc');
			} else {
				$query->order_by(Input::get('order'), Input::get('desc')?'desc':'asc');
			}
		}

		$data = Input::get();
		$count = count($query->as_object('Model_Event')->execute());
		// $count = $query->count();
		$pagination = myPagination::create($count,20);
		$data["per_page"] = $pagination->per_page;
		$data["page"] = $pagination->current_page;
		$data["pagination"] = $pagination;
		$data['events'] = $query->limit($pagination->per_page)->offset($pagination->offset)->as_object('Model_Event')->execute()->as_array();
		// $data['events'] = $query->limit($pagination->per_page)->offset($pagination->offset)->get();
		$data['count'] = $count;
		$data['total_count'] = Model_Event::count();
		$data['event_statuses'] = Model_Event_Status::find('all');
		$data['categories'] = Model_Category::find('all');


		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'event.js';
		$this->template->extra_css = 'event.css';

		$this->template->page_id = 'index'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'イベントリトス';
		$this->template->page_title_inner_en = 'EVENT LIST';
		$this->template->page_title_inner_jp = 'イベントリスト';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$this->template->content = View::forge('admin/events/index', $data); // コンテンツ
	}

	public function action_view($id) {
		$event = Model_Event::find($id);
		// オーガナイザの場合は、自分の作成したイベントのみ閲覧できる
		if (!$this->current_user->isAdmin()) {
			if($event->user_id != $this->current_user->id) {
				Session::set_flash('error', '閲覧権限がありません。');
				Response::redirect('admin/events/index');
			}
		}

		$query = Model_Event_Request::query();
		$query->order_by('id', 'asc');
		$query->where('event_id', $id);
		$query = Model_Event_Request::setSearchCondition($query, Input::param('condition'));
		$event_requests = $query->get();

		if(!empty(Input::post('event_status_change'))) {
			$event->status = Input::post('event_status');
			$event->save();
			Session::set_flash('success', 'ステータスを変更しました。');
		}

		if(!empty(Input::post('target_requests')) and !empty(Input::post('user_status'))) {
			$cancel_wait = Model_Event_Request::STATUS_CANCEL_WAIT;
			$cancel = Model_Event_Request::STATUS_CANCEL;
			$reserved = Model_Event_Request::STATUS_RESERVED;

			foreach (Input::post('target_requests') as $event_request_id => $target_user_id) {
				$event_request = $event->event_requests[$event_request_id];
				if(empty($event_request)) continue;

				$before_status = $event_request->status;
				$event_request->status = Input::post('user_status');
				$event->event_requests[$event_request_id] = $event_request;
				// 予約済からキャンセルに変更なら、キャンセル待ちを一件予約済に繰り上げて通知メール送信
				if(($before_status == $reserved) and ($event_request->status == $cancel)) {
					$oldest_cancel_wait = Model_Event_Request::getOldestCancelWait($event->id);
					if(!empty($oldest_cancel_wait)) {
						$oldest_cancel_wait->status = $reserved;
						$event->event_requests[$oldest_cancel_wait->id] = $oldest_cancel_wait;
						SendMail::notifyReservedFromCancelWait($oldest_cancel_wait->id);
					}
				}
				// キャンセル待ちから予約済に変更なら、通知メール送信
				if(($before_status == $cancel_wait) and ($event_request->status == $reserved)) {
					SendMail::notifyReservedFromCancelWait($event_request->id);
				}
			}
			if($event->save()) {
				Session::set_flash('success', 'イベント参加者のステータスを更新しました。');
			}else {
				Session::set_flash('error', 'イベント参加者のステータス更新に失敗しました。');
			}
		}

		$data = array();
		$data['event'] = $event;
		$data['event_statuses'] = Model_Event_Status::find('all');
		$data['request_statuses'] = Model_Event::getRequestStatus();
		$data['event_requests'] = $event_requests;
		$data['categories'] = $event->getCategoryNames(); // カテゴリー名
		$data['tags'] = $event->getTagNames(); // タグ名
		$this->template->content = View::forge('admin/events/view', $data);

	}

	/**
	 * edit
	 */
	public function action_edit($id = null)
	{
		$event = Model_Event::find($id);
		if (strpos(Input::referrer(), 'edit_confirm')) {
			// 確認画面からの戻りならば、セッションを読み込む
			$inputs = Session::get('Events.input.'. $id);
			$event->set($inputs);
		}
		
		// オーガナイザの場合は、自分の作成したイベントのみ閲覧できる
		if (!$this->current_user->isAdmin()) {
			if($event->user_id != $this->current_user->id) {
				Session::set_flash('error', '閲覧権限がありません。');
				Response::redirect('admin/events/index');
			}
		}
		if (empty($event)) {
			Response::redirect('events/');
		}
		if (Input::method() == 'POST')
		{
			$val = Model_Event::validate('edit', $id);
			if ($val->run())
			{
				$user = Model_User::getLoginUser();
				$event->title = Input::post('title');
 				$event->wp_url = Input::post('wp_url');
 				$event->img_url = Input::post('img_url');
 				$event->start_date = (string) Input::post('start_year')
 						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
 						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT);
 				$event->start_time = (string) Input::post('start_year')
 						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
 						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT)
 						.' '. str_pad(Input::post('start_hour'), 2, 0, STR_PAD_LEFT)
 						.':'. str_pad(Input::post('start_min'), 2, 0, STR_PAD_LEFT)
 						.':00';
 				$event->end_time = (string) Input::post('start_year')
 						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
 						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT)
 						.' '. str_pad(Input::post('end_hour'), 2, 0, STR_PAD_LEFT)
 						.':'. str_pad(Input::post('end_min'), 2, 0, STR_PAD_LEFT)
 						.':00';
 				$event->reception_open = (string) Input::post('start_year')
 						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
 						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT)
 						.' '. str_pad(Input::post('reception_hour'), 2, 0, STR_PAD_LEFT)
 						.':'. str_pad(Input::post('reception_min'), 2, 0, STR_PAD_LEFT)
 						.':00';
 				$event->organizer = Input::post('organizer');
 				$event->capacity = Input::post('capacity');
 				$event->charge = Input::post('charge');
 				$event->status = Input::post('status');
 				$event->user_id = $user->id;

				if (Input::post('categories')) {
					$categories = Input::post('categories');
				}

				if (Input::post('tags')) {
					$tags = Input::post('tags');
				}

				Session::set('Events.input.'. $id , $event->to_array() + compact('categories', 'tags'));
				Response::redirect('admin/events/edit_confirm/'. $id);
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'event.js';
		$this->template->extra_css = 'event.css';

		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'イベント登録情報編集'; //ページ名
		$this->template->page_title_inner_en = 'EVENT EDIT';
		$this->template->page_title_inner_jp = 'イベント編集';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$data = array();
		$data['event'] = $event;
		$data['event_statuses'] = Model_Event_Status::find('all');
		$data['categories'] = Model_Category::find('all');
		$data['tags'] = Model_Tag::find('all');

		$this->template->content = View::forge('admin/events/edit', $data); // コンテンツ
	}
	/**
	 * edit confirm
	 */
	public function action_edit_confirm($id) {
		$event = Model_Event::find($id);

		// 入力情報
		$inputs = Session::get('Events.input.'. $id);

		if (Input::method() == 'POST')
		{
			// イベントカテゴリを消す
			foreach ($event->event_categories as $key => $event_category) {
				$event_category->delete();
			}
			// タグを消す
			foreach ($event->event_tags as $key => $event_tag) {
				$event_tag->delete();
			}
			
			$event->set($inputs);
			// カテゴリ
			$event->event_categories = array();
			if (!empty($inputs['categories'])) {
				foreach ($inputs['categories'] as $key => $category_id) {
					$event_category = Model_Event_Category::forge();
					$event_category->category_id = $category_id;
					$event->event_categories[] = $event_category;
				}
			}
			// タグ
			$event->event_tags = array();
			if (!empty($inputs['tags'])) {
				foreach ($inputs['tags'] as $key => $tag_id) {
					$event_tag = Model_Event_Tag::forge();
					$event_tag->tag_id = $tag_id;
					$event->event_tags[] = $event_tag;
				}
			}
			
			if ($event->save())
			{
				Session::set_flash('success', 'イベント情報を更新しました');
				Response::redirect('admin/events/view/'. $id);
			}
			else
			{
				Session::set_flash('error', 'イベント情報を更新できませんでした');
			}
		}
		
		$event->set($inputs);
		// カテゴリ
		$event->event_categories = array();
		if (!empty($inputs['categories'])) {
			foreach ($inputs['categories'] as $key => $category_id) {
				$event_category = Model_Event_Category::forge();
				$event_category->category_id = $category_id;
				$event->event_categories[] = $event_category;
			}
		}
		// タグ
		$event->event_tags = array();
		if (!empty($inputs['tags'])) {
			foreach ($inputs['tags'] as $key => $tag_id) {
				$event_tag = Model_Event_Tag::forge();
				$event_tag->tag_id = $tag_id;
				$event->event_tags[] = $event_tag;
			}
		}
		
		$data = array();
		$data['event'] = $event;
		$data['event_statuses'] = Arr::assoc_to_keyval(Model_Event_Status::find("all"), 'id', 'name');
		$data['categories'] = $event->getCategoryNames(); // カテゴリー名
		$data['tags'] = $event->getTagNames(); // タグ名
		$this->template->content = View::forge('admin/events/edit_confirm', $data);
	}

	/**
	 * add
	 */
	public function action_add()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Event::validate('add');
			$val = Model_Event::setAddEventValidate($val);

			if ($val->run())
			{
				$user = Model_User::getLoginUser();
				$event = Model_Event::forge(array(
					'title' => Input::post('title'),
					'wp_url' => Input::post('wp_url'),
					'img_url' => Input::post('img_url'),
					'start_date' => (string) Input::post('start_year')
						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT),
					'start_time' => (string) Input::post('start_year')
						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT)
						.' '. str_pad(Input::post('start_hour'), 2, 0, STR_PAD_LEFT)
						.':'. str_pad(Input::post('start_min'), 2, 0, STR_PAD_LEFT)
						.':00',
					'end_time' => (string) Input::post('start_year')
						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT)
						.' '. str_pad(Input::post('end_hour'), 2, 0, STR_PAD_LEFT)
						.':'. str_pad(Input::post('end_min'), 2, 0, STR_PAD_LEFT)
						.':00',
					'reception_open' => (string) Input::post('start_year')
						.'-'. str_pad(Input::post('start_month'), 2, 0, STR_PAD_LEFT)
						.'-'. str_pad(Input::post('start_day'), 2, 0, STR_PAD_LEFT)
						.' '. str_pad(Input::post('reception_hour'), 2, 0, STR_PAD_LEFT)
						.':'. str_pad(Input::post('reception_min'), 2, 0, STR_PAD_LEFT)
						.':00',
					'organizer' => Input::post('organizer'),
					'capacity' => Input::post('capacity', 0),
					'charge' => Input::post('charge', 0),
					'status' => Input::post('status', null),
					'user_id' => $user->id,
				));
				if(Input::post('categories')) {
					foreach (Input::post('categories') as $key => $category_id) {
						$event_category = Model_Event_Category::forge();
						$event_category->category_id = $category_id;
						$event->event_categories[] = $event_category;
					}
				}

				if (Input::post('categories')) {
					$categories = Input::post('categories');
				}

				if (Input::post('tags')) {
					$tags = Input::post('tags');
				}

				Session::set('Events.input.add', $event->to_array() + compact('categories', 'tags'));
				Response::redirect('admin/events/add_confirm');
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'event.js';
		$this->template->extra_css = 'event.css';

		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'イベント登録'; //ページ名
		$this->template->page_title_inner_en = 'EVENT ADD';
		$this->template->page_title_inner_jp = 'イベント登録';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		if (strpos(Input::referrer(), 'add_confirm')) {
			// 確認画面からの戻りならば、セッションを読み込む
			$inputs = Session::get('Events.input.add');
			$event = Model_Event::forge($inputs);
			$data = compact('event');
		} else {
			$data = array();
		}
		$data['event_statuses'] = Model_Event_Status::find('all');
		$data['categories'] = Model_Category::find('all');
		$data['tags'] = Model_Tag::find('all');
		$this->template->content = View::forge('admin/events/add', $data); // コンテンツ
	}
	/**
	 * add confirm
	 */
	public function action_add_confirm() {
		// 入力情報
		$inputs = Session::get('Events.input.add');
		$event = Model_Event::forge($inputs);
		// カテゴリ
		$event->event_categories = array();
		if (!empty($inputs['categories'])) {
			foreach ($inputs['categories'] as $key => $category_id) {
				$event_category = Model_Event_Category::forge();
				$event_category->category_id = $category_id;
				$event->event_categories[] = $event_category;
			}
		}
		// タグ
		$event->event_tags = array();
		if (!empty($inputs['tags'])) {
			foreach ($inputs['tags'] as $key => $tag_id) {
				$event_tag = Model_Event_Tag::forge();
				$event_tag->tag_id = $tag_id;
				$event->event_tags[] = $event_tag;
			}
		}
		
		if (Input::method() == 'POST')
		{
			if ($event->save())
			{
				Session::set_flash('success', 'イベントを追加しました');
				Response::redirect('admin/events');
			}
			else
			{
				Session::set_flash('error', 'イベントを追加できませんでした');
			}
		}
		
		$data = array();
		$data['event'] = $event;
		$data['event_statuses'] = Arr::assoc_to_keyval(Model_Event_Status::find("all"), 'id', 'name');
		$data['categories'] = $event->getCategoryNames(); // カテゴリー名
		$data['tags'] = $event->getTagNames(); // タグ名
		$this->template->content = View::forge('admin/events/edit_confirm', $data);
	}


	public function action_export_csv($id) {
		$event = Model_Event::find($id);
		// オーガナイザの場合は、自分の作成したイベントのみ閲覧できる
		if (!$this->current_user->isAdmin()) {
			if($event->user_id != $this->current_user->id) {
				Session::set_flash('error', '閲覧権限がありません。');
				Response::redirect('admin/events/index');
			}
		}

		$query = Model_Event_Request::query();
		$query->order_by('id', 'asc');
		$query->where('event_id', $id);
		$query = Model_Event_Request::setSearchCondition($query, Input::param('condition'));
		$event_requests = $query->get();

		// CSV
		$csv_array = array();
		foreach($event_requests as $request){
			if (empty($request->user)) continue;
			$array = array(); $hdr = array();
			//$array[] = $request->id; $hdr[]= "'ID'";
			$array[] = $request->user->id; $hdr[] = "ユーザーID";
			$array[] = $request->user->getName(); $hdr[] = "名前";
			$array[] = $request->user->getHiraganaName(); $hdr[] = "よみがな";
			$array[] = $request->user->getBirthday(); $hdr[] = "生年月";
			$array[] = $request->user->getSex(); $hdr[] = "性別";
			$array[] = $request->user->nationality; $hdr[] = "国籍";
			$array[] = $request->user->zip; $hdr[] = "郵便番号";
			$array[] = $request->user->getPref(); $hdr[] = "都道府県";
			$array[] = $request->user->city; $hdr[] = "市区町村";
			$array[] = $request->user->tel; $hdr[] = "電話番号";
			$array[] = $request->user->email; $hdr[] = "メールアドレス";
			$array[] = $request->user->organization; $hdr[] = "所属組織名";
			$array[] = $request->user->position; $hdr[] = "役職";
			$array[] = $request->user->getJob(); $hdr[] = "職種";
			
			$array[] = $request->user->interest==1?'あり':'なし'; $hdr[] = "起業についての興味";
			$array[] = $request->user->getPreparation(); $hdr[] = "起業の準備";
			$array[] = $request->user->mailmagazine_info?'受け取る':'受け取らない'; $hdr[] = "DMによる案内";
			$array[] = $request->user->group?Config::get('master.USER_GROUP')[$request->user->group]:''; $hdr[] = "アカウント種別";
			$array[] = $request->user->type?Config::get('master.USER_TYPES')[$request->user->type]:''; $hdr[] = "会員種別";
			$array[] = $request->getStatus(); $hdr[] = "ステータス";
			
			$csv_array[] = $array;
		}
		$csv = implode(',', $hdr) ."\n";
		foreach($csv_array as $key => $array){
			foreach($array as $key => $value){
				$value = preg_replace('/"/', '""', $value);
				if(preg_match('/["\r\n,]/', $value) > 0){
					$value = '"' . $value . '"';
				}
				$csv .= $value . ',';
			}
			$csv .= "\n";
		}
		$file_name = Config::get('master.EXPORT_FILE_PREFIX')
				   // 日本語ファイル名使う場合 //. '-event-requests['. Util::convertFileName($event->title) .']'
				   . '-Event'. $event->id .'-'
				   . Date::forge()->format("%Y%m%d", true)
				   . '.csv';
		header("Content-Type: application/octet-stream");
		header('Content-Disposition: attachment; filename="'. $file_name .'"');
		$csv = mb_convert_encoding($csv, "SJIS-win", "UTF-8");
		return $csv;
	}

}
