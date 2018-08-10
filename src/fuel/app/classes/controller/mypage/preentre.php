<?php

class Controller_Mypage_Preentre extends Controller_Base
{
	public function action_index()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Preentre_Request::validate('index');
			if ($val->run()) {
				$preentre_request = array(
					'intention' => Input::post('intention'),
					'business_type' => Input::post('business_type'),
					'business_type_text' => Input::post('business_type_text'),
					'business_style' => Input::post('business_style'),
					'business_style_text' => Input::post('business_style_text'),
					'problem01' => Input::post('problem01'),
					'problem02' => Input::post('problem02'),
					'problem03' => Input::post('problem03'),
					'problem04' => Input::post('problem04'),
					'problem05' => Input::post('problem05'),
					'problem06' => Input::post('problem06'),
					'problem07' => Input::post('problem07'),
					'problem08' => Input::post('problem08'),
					'problem09' => Input::post('problem09'),
					'problem10' => Input::post('problem10'),
					'problem11' => Input::post('problem11'),
					'problem12' => Input::post('problem12'),
					'problem13' => Input::post('problem13'),
					'problem14' => Input::post('problem14'),
					'problem15' => Input::post('problem15'),
					'problem16' => Input::post('problem16'),
					'problem17' => Input::post('problem17'),
					'problem18' => Input::post('problem18'),
					'problem19' => Input::post('problem19'),
					'problem20' => Input::post('problem20'),
					'problem21' => Input::post('problem21'),
					'problem22' => Input::post('problem22'),
					'problem23' => Input::post('problem23'),
					'problem24' => Input::post('problem24'),
					'problem25' => Input::post('problem25'),
					'problem26' => Input::post('problem26'),
					'problem27' => Input::post('problem27'),
					'problem28' => Input::post('problem28'),
					'problem29' => Input::post('problem29'),
					'problem30' => Input::post('problem30'),
					'problem31' => Input::post('problem31'),
					'problem32' => Input::post('problem32'),
					'problem_text' => Input::post('problem_text'),
					//'wish' => Input::post('wish'),
					'wish01' => Input::post('wish01'),
					'wish02' => Input::post('wish02'),
					'wish03' => Input::post('wish03'),
					'wish04' => Input::post('wish04'),
					'wish05' => Input::post('wish05'),
					'wish06' => Input::post('wish06'),
					'wish07' => Input::post('wish07'),
					'wish08' => Input::post('wish08'),
					'wish09' => Input::post('wish09'),
					'wish10' => Input::post('wish10'),
					'wish11' => Input::post('wish11'),
					'wish12' => Input::post('wish12'),
					'wish13' => Input::post('wish13'),
					'wish14' => Input::post('wish14'),
					'wish15' => Input::post('wish15'),
					'wish16' => Input::post('wish16'),
				);
				Session::set('Mypage.preentre_request', $preentre_request);
				Response::redirect('mypage/preentre/confirm');
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$data['page_id'] = 'preentre';
		$data['back_link'] = 'back';
		$data['parent_title'] = '';
		$data['page_title'] = 'プレアントレ申し込みフォーム';

		// Asset::css(array("company.css"), array(), 'extra_css', false);

		$this->template->page_id     = 'mypage'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->page_title_inner_en = 'PRE ENTRE';
		$this->template->page_title_inner_jp = $data['page_title'];
		$this->template->child_title = ''; //子ページ名
		$this->template->content = View::forge('mypage/preentre/index'); // コンテンツ
	}

	public function action_confirm()
	{
		$inputs = Session::get('Mypage.preentre_request');
		$preentre_request = Model_Preentre_Request::forge($inputs);
		$preentre_request->user_id = $this->current_user->id;
		$preentre_request->status = 1; // 申請中
		if (Input::method() == 'POST')
		{
			if ($preentre_request->save())
			{
				\Sendmail::notifyPreentreRequesting($this->current_user); // 申請者向けメール
				\Sendmail::notifyPreentreRequest($preentre_request); // 事務局向けメール
				Response::redirect('mypage/preentre/complete');
			}
			else
			{
				Session::set_flash('error', '申請できませんでした');
			}
		}
		$data['page_id'] = 'preentre';
		$data['back_link'] = 'back';
		$data['parent_title'] = '';
		$data['page_title'] = 'プレアントレ申し込みフォーム - 確認画面';

		// Asset::css(array("company.css"), array(), 'extra_css', false);

		$this->template->page_id     = 'mypage'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->page_title_inner_en = 'PRE ENTRE';
		$this->template->page_title_inner_jp = $data['page_title'];
		$this->template->child_title = ''; //子ページ名
		$data['preentre_request'] = $preentre_request;
		$this->template->content = View::forge('mypage/preentre/confirm', $data); // コンテンツ
	}

	public function action_complete()
	{
		$data['page_id'] = 'preentre';
		$data['back_link'] = 'back';
		$data['parent_title'] = '';
		$data['page_title'] = 'プレアントレ申し込みフォーム - 完了画面';

		// Asset::css(array("company.css"), array(), 'extra_css', false);

		$this->template->page_id     = 'mypage'; //ページ独自にスタイルを指定する場合は入力
		$this->template->page_title  = $data['page_title']; //ページ名
		$this->template->page_title_inner_en = 'PRE ENTRE';
		$this->template->page_title_inner_jp = $data['page_title'];
		$this->template->child_title = ''; //子ページ名
		$this->template->content = View::forge('mypage/preentre/complete'); // コンテンツ
	}

}
