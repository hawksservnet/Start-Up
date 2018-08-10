<?php // fuel/app/classes/controller/users.php

class Controller_Admin_Users extends Controller_Admin
{

	/**
	 * メンバー一覧
	 */
	public function action_index()
	{

		$query = Model_User::BuildSearchQuery(Input::get());
		//$query->where("group", "!=", 100); // 管理者(admin)はリストに出さない
		if (empty(Input::get())) {
			// デフォルトで一般メンバー会員を選択
			$query->where("group", 1);
		}
		if (empty(Input::get('order'))) {
			$query->order_by('id', 'desc');
		} else {
			if (Input::get('order') == 'name') {
				$query->order_by('hiragana_name_last', Input::get('desc')?'desc':'asc');
				$query->order_by('hiragana_name_first', Input::get('desc')?'desc':'asc');
				$query->order_by('name_last', Input::get('desc')?'desc':'asc');
				$query->order_by('name_first', Input::get('desc')?'desc':'asc');
			} else {
				$query->order_by(Input::get('order'), Input::get('desc')?'desc':'asc');
			}
		}

		$data = Input::get();
		$count = $query->count();
		$pagination = myPagination::create($count,20);
		$data["per_page"] = $pagination->per_page;
		$data["page"] = $pagination->current_page;
		$data["pagination"] = $pagination;
		$data['users'] = $query->limit($pagination->per_page)->offset($pagination->offset)->get();
		$data['count'] = $count;
		$data['total_count'] = Model_User::query()->count();
		$data["order_by"] = array(
			'' => '表示順',
			"id" => "ユーザーID順",
			"name_last" => "名前順",
		);

		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'user-registration.js';
		$this->template->extra_css = 'user-registration.css';

		$this->template->page_id = 'index';
		$this->template->page_title = 'メンバーリトス';
		$this->template->page_title_inner_en = 'MEMBER LIST';
		$this->template->page_title_inner_jp = 'メンバーリスト';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$this->template->content = View::forge('admin/users/index', $data); // コンテンツ
	}

	/**
	 * show
	 */
	public function action_show($id = null)
	{
		$user = Model_User::find($id);

		$this->template->extra_css = 'preentre.css';
		
		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'メンバー登録情報表示'; //ページ名
		$this->template->page_title_inner_en = 'MEMBER EDIT';
		$this->template->page_title_inner_jp = 'メンバー編集';
		$this->template->page_description = '';
		$this->template->page_keyword = '';
		$data['from_index'] = strpos(Input::referrer(), '/users?')?1:0;
		$data['user'] = $user;
		if (!empty($user->preentre_requests)) {
			// プレアントレの申請情報
			$preentre_request = reset($user->preentre_requests);
			$data['preentre_request'] = $preentre_request;
		}
		$this->template->content = View::forge('admin/users/show', $data); // コンテンツ
	}

	/**
	 * edit password
	 */
	public function action_status_change($id = null)
	{
		$user = Model_User::find($id);
		if (empty($user)) {
			Response::redirect('admin/users/');
		}
		if (Input::method() == 'POST')
		{
			$user->type = Input::post('type');

			if ($user->save())
			{
				Session::set_flash('success', '会員種別を更新しました');
			}
			else
			{
				Session::set_flash('error', '会員種別を更新できませんでした');
			}
			Response::redirect_back();
		}
	}

	/**
	 * edit
	 */
	public function action_edit($id = null)
	{
		$user = Model_User::find($id);
		if (strpos(Input::referrer(), 'edit_confirm')) {
			// 確認画面からの戻りならば、セッションを読み込む
			$inputs = Session::get('Users.input.'. $id);
			$user->set($inputs);
		}
		
		if (empty($user)) {
			Response::redirect('users/');
		}
		if (Input::method() == 'POST')
		{
			$val = Model_User::validate('edit', $id);
			if ($val->run())
			{
				$user->name_last = Input::post('name_last');
				$user->name_first = Input::post('name_first');
				$user->email = Input::post('email');
				$user->tel = Input::post('tel');

				$user->hiragana_name_last = Input::post('hiragana_name_last');
				$user->hiragana_name_first = Input::post('hiragana_name_first');
				$user->birthday = (string) Input::post('birth_year')
					.'-'. str_pad(Input::post('birth_month'), 2, 0, STR_PAD_LEFT)
					.'-'. str_pad(Input::post('birth_day', '01'), 2, 0, STR_PAD_LEFT);
				$user->sex = Input::post('sex');
				$user->zip = Input::post('zip');
				$user->pref = Input::post('pref');
				$user->city = Input::post('city');

				$user->organization = Input::post('organization');
				$user->position = Input::post('position');
				$user->job = Input::post('job');
				$user->cardid = Input::post('cardid');

				$user->mailmagazine_info = Input::post('mailmagazine_info');
				$user->nationality = Input::post('nationality');
				$user->interest = Input::post('interest');
				$user->preparation = Input::post('preparation');

				$user->group = Input::post('group');
				$user->type = Input::post('type');

				Session::set('Users.input.'. $id, $user->to_array());
				Response::redirect('admin/users/edit_confirm/'.$user->id);
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'user-registration.js';
		$this->template->extra_css = 'user-registration.css';

		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'メンバー登録情報編集'; //ページ名
		$this->template->page_title_inner_en = 'MEMBER EDIT';
		$this->template->page_title_inner_jp = 'メンバー編集';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$data['user'] = $user;
		$data['jobs'] = Config::get('master.JOBS');
		$this->template->content = View::forge('admin/users/edit', $data); // コンテンツ
	}
	/**
	 * edit confirm
	 */
	public function action_edit_confirm($id)
	{
		$user = Model_User::find($id);
		$user->set(Session::get('Users.input.'. $id));

		if (Input::method() == 'POST')
		{
			{
				if ($user->save())
				{
					Session::set_flash('success', 'メンバー情報を更新しました');
					Response::redirect('admin/users/edit/'.$user->id);
				}
				else
				{
					Session::set_flash('error', 'メンバー情報を更新できませんでした');
				}
			}
		}

		$this->template->extra_css = 'preentre.css';
		
		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'メンバー登録情報確認'; //ページ名
		$this->template->page_title_inner_en = 'MEMBER EDIT CONFIRMATION';
		$this->template->page_title_inner_jp = 'メンバー編集確認';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$data['user'] = $user;
		$this->template->content = View::forge('admin/users/edit_confirm', $data); // コンテンツ
	}

	/**
	 * edit password
	 */
	public function action_edit_pw($id = null)
	{
		$user = Model_User::find($id);
		if (empty($user)) {
			Response::redirect('users/');
		}
		if (Input::method() == 'POST')
		{
			$val = Model_User::validate('change_pw');
			if ($val->run())
			{
				$user->password = Auth::hash_password(Input::post('password'));

				if ($user->save())
				{
					Session::set_flash('success', 'パスワードを更新しました');
					//Auth::logout();
				}
				else
				{
					Session::set_flash('error', 'パスワードを更新できませんでした');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'user-registration.js';
		$this->template->extra_css = 'user-registration.css';

		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'メンバー登録情報編集'; //ページ名
		$this->template->page_title_inner_en = 'MEMBER PASSWORD';
		$this->template->page_title_inner_jp = 'パスワード変更';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$data['user'] = $user;
		$data['jobs'] = Config::get('master.JOBS');
		$this->template->content = View::forge('admin/users/edit_pw', $data); // コンテンツ
	}

	/**
	 * add
	 */
	public function action_add()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_User::validate('add');
			if ($val->run())
			{
				$user = Model_User::forge(array(
					'name_last' => Input::post('name_last'),
					'name_first' => Input::post('name_first'),
					'email' => Input::post('email'),
					'username' => Input::post('email'),
					'tel' => Input::post('tel'),

					'password' => Auth::hash_password(Input::post('password')),

					'hiragana_name_last' => Input::post('hiragana_name_last'),
					'hiragana_name_first' => Input::post('hiragana_name_first'),
					'birthday' => (string) Input::post('birth_year')
						.'-'. str_pad(Input::post('birth_month'), 2, 0, STR_PAD_LEFT)
						.'-'. str_pad(Input::post('birth_day', '01'), 2, 0, STR_PAD_LEFT),
					'sex' => Input::post('sex'),
					'zip' => Input::post('zip'),
					'pref' => Input::post('pref'),
					'city' => Input::post('city'),

					'organization' => Input::post('organization'),
					'position' => Input::post('position'),
					'job' => Input::post('job'),
					'cardid' => Input::post('cardid'),

					'mailmagazine_info' => Input::post('mailmagazine_info'),
					'nationality' => Input::post('nationality'),
					'interest' => Input::post('interest'),
					'preparation' => Input::post('preparation'),

					'group' => Input::post('group'),
					'type' => Input::post('type'),
				));
				Session::set('Users.input.add', $user->to_array());
				Response::redirect('admin/users/add_confirm');
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->page_path = Uri::base(false);
		$this->template->extra_js = 'user-registration.js';
		$this->template->extra_css = 'user-registration.css';

		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'メンバー登録'; //ページ名
		$this->template->page_title_inner_en = 'MEMBER ADD';
		$this->template->page_title_inner_jp = 'メンバー登録';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		if (strpos(Input::referrer(), 'add_confirm')) {
			// 確認画面からの戻りならば、セッションを読み込む
			$inputs = Session::get('Users.input.add');
			$user = Model_User::forge($inputs);
			$data = compact('user');
		} else {
			$data = array();
		}
		$data['jobs'] = Config::get('master.JOBS');
		$this->template->content = View::forge('admin/users/add', $data); // コンテンツ
	}
	/**
	 * add confirm
	 */
	public function action_add_confirm()
	{
		$user = Model_User::forge(Session::get('Users.input.add'));

		if (Input::method() == 'POST')
		{
			{
				if ($user->save())
				{
					Session::set_flash('success', 'メンバーを追加しました');
					Response::redirect('admin/users/');
				}
				else
				{
					Session::set_flash('error', 'メンバーを追加できませんでした');
				}
			}
		}

		$this->template->extra_css = 'preentre.css';
		
		$this->template->page_id = ''; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title = 'メンバー登録確認'; //ページ名
		$this->template->page_title_inner_en = 'MEMBER ADD CONFIRMATION';
		$this->template->page_title_inner_jp = 'メンバー登録確認';
		$this->template->page_description = '';
		$this->template->page_keyword = '';

		$data['user'] = $user;
		$this->template->content = View::forge('admin/users/edit_confirm', $data); // コンテンツ
	}

	/**
	 * CSVエクスポート
	 */
	public function action_csv_export()
	{
		$query = Model_User::BuildSearchQuery(Input::get());
		//$query->where("group", "!=", 100); // 管理者(admin)はリストに出さない
		$query->order_by('id', 'desc');
		$users = $query->get();
		$csv_array = array();
		foreach($users as $user){
			$array = array(); $hdr = array();
			$array[] = $user->id; $hdr[]= "ID";
			$array[] = $user->name_last; $hdr[] = "姓";
			$array[] = $user->name_first; $hdr[] = "名";
			$array[] = $user->hiragana_name_last; $hdr[] = "姓ふりがな";
			$array[] = $user->hiragana_name_first; $hdr[] = "名ふりがな";
			$array[] = $user->email; $hdr[] = 'メールアドレス';
			$array[] = $user->tel; $hdr[] = '電話番号';
			$array[] = $user->getBirthday(); $hdr[] = '生年月';
			$array[] = $user->getSex(); $hdr[] = '性別';
			$array[] = $user->nationality; $hdr[] = '国籍';
			$array[] = $user->zip; $hdr[] = '郵便番号';
			$array[] = $user->getPref(); $hdr[] = '都道府県';
			$array[] = $user->city; $hdr[] = '市町村区';
			$array[] = $user->organization; $hdr[] = '所属組織名';
			$array[] = $user->position; $hdr[] = '役職';
			$array[] = $user->getJob(); $hdr[] = '職業';
			$array[] = $user->cardid; $hdr[] = '入館カードID';
			$array[] = $user->interest?'あり':'なし'; $hdr[] = '起業への興味';
			$array[] = $user->getPreparation(); $hdr[] = '起業への準備';
			$array[] = $user->mailmagazine_info?'受け取る':'受け取らない'; $hdr[] = 'DMによる案内';

			$array[] = $user->getGroupName(); $hdr[] = 'アカウント種別';
			$array[] = $user->getType(); $hdr[] = '会員種別';

			$array[] = date('Y年m月d日', $user->created_at); $hdr[] = '登録日';

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
				   . '-members-'
				   . Date::forge()->format("%Y%m%d", true)
				   . '.csv';
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=". $file_name);
		$csv = mb_convert_encoding($csv, "SJIS-win", "UTF-8");
		return $csv;
	}
}
