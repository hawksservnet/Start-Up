<?php // fuel/app/classes/controller/admin/preentre/requests.php

class Controller_Admin_Preentre_Requests extends Controller_Admin
{
	/**
	 * 一覧
	 */
	public function action_index()
	{
		$data['requests'] = Model_Preentre_Request::find('all', array(
			'order_by' => array(
				'created_at' => 'desc',
			)
		));
		$this->template->title = "PreentreRequests";
		$this->template->content = View::forge('admin/preentre/index', $data);
	}

	public function action_review($id = null)
	{
		$preentre_request = Model_Preentre_Request::find($id);

		if (Input::method() == 'POST')
		{
			if (empty(Input::post('approval'))) {
				Session::set_flash('success', '承認の有無を選択してください。');
			} elseif (Input::post('approval') == 11) {
				// 承認OK
				$preentre_request->setApproval(11);
				\Sendmail::notifyPreentreApproved($preentre_request); // 申請者向けメール
				Session::set_flash('success', 'プレアントレ申請を承認しました。');
				Response::redirect('admin/preentre/requests');
			} elseif (Input::post('approval') == 21) {
				// 承認されない
				$preentre_request->setNoApproval(21);
				\Sendmail::notifyPreentreDisapproved($preentre_request->user); // 申請者向けメール
				Session::set_flash('success', 'プレアントレ申請は承認されませんでした。');
				Response::redirect('admin/preentre/requests');
			}
		}

		$this->template->extra_css = 'preentre.css';

		$data['preentre_request'] = $preentre_request;
		$data['user'] = $preentre_request->user;
		$this->template->title = "PreentreRequest";
		$this->template->content = View::forge('admin/preentre/review', $data);
	}
}
