<?php
class SendMail
{
	public static function addAccount($user){
		Config::load('master', true); // 定数ファイル
		$email = Email::forge();
		$email->from(Config::get('master.SERVICE_MAIL_ADDRESS'), Config::get('master.HOME_DOMAIN'));
		$email->to($user->email, $user->name_last . $user->name_first);
		$email->bcc(Config::get('master.SERVICE_MAIL_DESTINATION'), Config::get('master.HOME_DOMAIN'));
		$email->subject('【'. Config::get('master.SERVICE_NAME') .'】アカウント本登録完了のお知らせ');
		$data = [
			'name'  =>  $user->name_last . $user->name_first,
			'email' =>  $user->email,
			'tel'   =>  $user->tel,
		];
		$body = View::forge("email/user_add_account", $data);
		$email->body($body);
		try
		{
				$email->send();
		}
		catch(\EmailValidationFailedException $e)
		{
				// バリデーションが失敗したとき
				Log::error($e->getMessage());
				Log::error($e->getMessage());
		}
		catch(\EmailSendingFailedException $e)
		{
				// ドライバがメールを送信できなかったとき
				Log::error($e->getMessage());
		}
	}

	public static function userEdit($user, $user_pass=null){
		Config::load('master', true); // 定数ファイル
		$email = Email::forge();
		$email->from(Config::get('master.SERVICE_MAIL_ADDRESS'), Config::get('master.HOME_DOMAIN'));
		$email->to($user->email, $user->name_last . $user->name_first);
		$email->subject('【'. Config::get('master.SERVICE_NAME') .'】会員情報変更のお知らせ');
		$data = [
			'name'      => $user->name_last . $user->name_first,
			'email'     => $user->email,
			'tel'       => $user->tel,
			'user_pass' => $user_pass,
		];
		$body = View::forge("email/user_edit", $data);
		$email->body($body);
		try
		{
				$email->send();
		}
		catch(\EmailValidationFailedException $e)
		{
				// バリデーションが失敗したとき
				Log::error($e->getMessage());
		}
		catch(\EmailSendingFailedException $e)
		{
				// ドライバがメールを送信できなかったとき
				Log::error($e->getMessage());
		}
	}


	public static function onetimeUrl($onetime){
		Config::load('master', true); // 定数ファイル
		$email = Email::forge();
		$email->from(Config::get('master.SERVICE_MAIL_ADDRESS'), Config::get('master.HOME_DOMAIN'));
		$email->to($onetime->email, $onetime->name_last . $onetime->name_first);
		$email->subject('【'. Config::get('master.SERVICE_NAME') .'】アカウント本登録URLのご案内');
		$data = [
			'name' =>  $onetime->name_last . $onetime->name_first,
			'service_name' => Config::get('master.SERVICE_NAME'),
			'url' => Uri::create("users/confirm_email_verification", array(), array('hash'=>$onetime->hash)),
		];
		$body = View::forge("email/user_onetime", $data);
		$email->body($body);
		try
		{
		    $email->send();
		}
		catch(\EmailValidationFailedException $e)
		{
		    // バリデーションが失敗したとき
				Log::error($e->getMessage());
		}
		catch(\EmailSendingFailedException $e)
		{
		    // ドライバがメールを送信できなかったとき
				Log::error($e->getMessage());
		}

	}

	// キャンセル待ちとして登録していたイベントの予約が完了
	public static function notifyReservedFromCancelWait($event_request_id) {
		$event_request = Model_Event_Request::find($event_request_id);
		$user = $event_request->user;
		$event = $event_request->event;
		Config::load('master', true); // 定数ファイル
		$email = Email::forge();
		$email->from(Config::get('master.EVENT_INFO_MAIL_ADDRESS'), Config::get('master.HOME_DOMAIN'));
		$email->to($user->email, $user->name_last . $user->name_first);
		$email->bcc(Config::get('master.EVENT_INFO_MAIL_DESTINATION'), Config::get('master.HOME_DOMAIN'));
		$email->subject('【'. Config::get('master.SERVICE_NAME') .'】イベント申込受付確認メール（キャンセル待ち繰り上げ）');
		$data = [
			'event'		=> $event,
			'event_request' => $event_request,
			'user' 		=> $user,
		];
		$body = View::forge("email/notify_reserved_from_cancel_wait", $data);
		$email->body($body);
		try
		{
				$email->send();
		}
		catch(\EmailValidationFailedException $e)
		{
				// バリデーションが失敗したとき
				Log::error($e->getMessage());
		}
		catch(\EmailSendingFailedException $e)
		{
				// ドライバがメールを送信できなかったとき
				Log::error($e->getMessage());
		}
	}

    // イベント申し込み　承認
    public static function notifyEventRequestApprovalChange($event_request_id, $formContent) {
        $event_request = Model_Event_Request::find($event_request_id);
        $user = $event_request->user;
        $event = $event_request->event;
        Config::load('master', true); // 定数ファイル
        $email = Email::forge();
        $email->from(Config::get('master.EVENT_INFO_MAIL_ADDRESS'), Config::get('master.HOME_DOMAIN'));
        $email->to($user->email, $user->name_last . $user->name_first);
        $email->bcc(Config::get('master.EVENT_INFO_MAIL_DESTINATION'), Config::get('master.HOME_DOMAIN'));
        $email->subject('【'. Config::get('master.SERVICE_NAME') .'】イベント予約 審査合格のお知らせ');
        $data = [
            'event'		=> $event,
            'user' 		=> $user,
            'formContent' => $formContent,
        ];
        $body = View::forge("email/notify_event_request_approval_change", $data);
        $email->body($body);
        try
        {
            $email->send();
        }
        catch(\EmailValidationFailedException $e)
        {
            // バリデーションが失敗したとき
            Log::error($e->getMessage());
        }
        catch(\EmailSendingFailedException $e)
        {
            // ドライバがメールを送信できなかったとき
            Log::error($e->getMessage());
        }
    }

    // イベント申し込み　非承認
    public static function notifyEventRequestNonApprovalChange($event_request_id, $formContent) {
        $event_request = Model_Event_Request::find($event_request_id);
        $user = $event_request->user;
        $event = $event_request->event;
        Config::load('master', true); // 定数ファイル
        $email = Email::forge();
        $email->from(Config::get('master.EVENT_INFO_MAIL_ADDRESS'), Config::get('master.HOME_DOMAIN'));
        $email->to($user->email, $user->name_last . $user->name_first);
        $email->bcc(Config::get('master.EVENT_INFO_MAIL_DESTINATION'), Config::get('master.HOME_DOMAIN'));
        $email->subject('【'. Config::get('master.SERVICE_NAME') .'】イベント予約 審査結果のお知らせ');
        $data = [
            'event'		=> $event,
            'user' 		=> $user,
            'formContent' => $formContent,
        ];
        $body = View::forge("email/notify_event_request_non_approval_change", $data);
        $email->body($body);
        try
        {
            $email->send();
        }
        catch(\EmailValidationFailedException $e)
        {
            // バリデーションが失敗したとき
            Log::error($e->getMessage());
        }
        catch(\EmailSendingFailedException $e)
        {
            // ドライバがメールを送信できなかったとき
            Log::error($e->getMessage());
        }
    }

    // イベント申請登録
	public static function notifyEventRequestAdd($event_request_id) {
		$event_request = Model_Event_Request::find($event_request_id);
		$user = $event_request->user;
		$event = $event_request->event;
		Config::load('master', true); // 定数ファイル
		$email = Email::forge();
		$email->from(Config::get('master.EVENT_INFO_MAIL_ADDRESS'), Config::get('master.HOME_DOMAIN'));
		$email->to($user->email, $user->name_last . $user->name_first);
		$email->bcc(Config::get('master.EVENT_INFO_MAIL_DESTINATION'), Config::get('master.HOME_DOMAIN'));
		$data = [
			'event'		=> $event,
			'event_request' => $event_request,
			'user' 		=> $user,
		];
		if ($event->approval == 1)
		{
			//notify_event_waiting
			$email->subject('【'. Config::get('master.SERVICE_NAME') .'】イベント申込受付確認メール（審査中）');
			$body = View::forge("email/notify_event_waiting", $data);
		} elseif ($event->approval == 0) {
			//notify_event_confirm
			$email->subject('【'. Config::get('master.SERVICE_NAME') .'】イベント申込受付確認メール');
			$body = View::forge("email/notify_event_confirm", $data);
		}
		$email->body($body);
		try
		{
				$email->send();
		}
		catch(\EmailValidationFailedException $e)
		{
				// バリデーションが失敗したとき
				Log::error($e->getMessage());
		}
		catch(\EmailSendingFailedException $e)
		{
				// ドライバがメールを送信できなかったとき
				Log::error($e->getMessage());
		}
	}

	// イベント申請登録（キャンセル待ち）
	public static function notifyEventRequestWaiting($event_request_id) {
		$event_request = Model_Event_Request::find($event_request_id);
		$user = $event_request->user;
		$event = $event_request->event;
		Config::load('master', true); // 定数ファイル
		$email = Email::forge();
		$email->from(Config::get('master.EVENT_INFO_MAIL_ADDRESS'), Config::get('master.HOME_DOMAIN'));
		$email->to($user->email, $user->name_last . $user->name_first);
		$email->bcc(Config::get('master.EVENT_INFO_MAIL_DESTINATION'), Config::get('master.HOME_DOMAIN'));
		$email->subject('【'. Config::get('master.SERVICE_NAME') .'】イベントキャンセル待ち確認メール');
		$data = [
			'event'		=> $event,
			'event_request' => $event_request,
			'user' 		=> $user,
		];
		$body = View::forge("email/notify_event_request_waiting", $data);
		$email->body($body);
		try
		{
				$email->send();
		}
		catch(\EmailValidationFailedException $e)
		{
				// バリデーションが失敗したとき
				Log::error($e->getMessage());
		}
		catch(\EmailSendingFailedException $e)
		{
				// ドライバがメールを送信できなかったとき
				Log::error($e->getMessage());
		}
	}

	// イベント申請キャンセル
	public static function notifyEventRequestCancel($event_request_id) {
		$event_request = Model_Event_Request::find($event_request_id);
		$user = $event_request->user;
		$event = $event_request->event;
		Config::load('master', true); // 定数ファイル
		$email = Email::forge();
		$email->from(Config::get('master.EVENT_INFO_MAIL_ADDRESS'), Config::get('master.HOME_DOMAIN'));
		$email->to($user->email, $user->name_last . $user->name_first);
		$email->bcc(Config::get('master.EVENT_INFO_MAIL_DESTINATION'), Config::get('master.HOME_DOMAIN'));
		$email->subject('【'. Config::get('master.SERVICE_NAME') .'】イベント申込キャンセル確認メール');
		$data = [
			'event'		=> $event,
			'event_request' => $event_request,
			'user' 		=> $user,
		];
		$body = View::forge("email/notify_event_request_cancel", $data);
		$email->body($body);
		try
		{
				$email->send();
		}
		catch(\EmailValidationFailedException $e)
		{
				// バリデーションが失敗したとき
				Log::error($e->getMessage());
		}
		catch(\EmailSendingFailedException $e)
		{
				// ドライバがメールを送信できなかったとき
				Log::error($e->getMessage());
		}
	}

	// イベント開催日前日のリマインドメール
	public static function remindEvent($event_request_id) {
		$event_request = Model_Event_Request::find($event_request_id);
		$user = $event_request->user;
		$event = $event_request->event;

		Config::load('master', true); // 定数ファイル
		$email = Email::forge();
		$email->from(Config::get('master.EVENT_INFO_MAIL_ADDRESS'), Config::get('master.HOME_DOMAIN'));
		$email->to($user->email, $user->name_last . $user->name_first);
		$email->bcc(Config::get('master.EVENT_INFO_MAIL_DESTINATION'), Config::get('master.HOME_DOMAIN'));
		$email->subject('【'. Config::get('master.SERVICE_NAME') .'】参加予定イベントの再確認のお知らせ');
		$data = [
			'event'		=> $event,
			'event_request' => $event_request,
			'user' 		=> $user,
		];
		$body = View::forge("email/remind_event", $data);
		$email->body($body);
		try
		{
				$email->send();
		}
		catch(\EmailValidationFailedException $e)
		{
				// バリデーションが失敗したとき
				Log::error($e->getMessage());
		}
		catch(\EmailSendingFailedException $e)
		{
				// ドライバがメールを送信できなかったとき
				Log::error($e->getMessage());
		}

	}

	// プレアントレ申請の受付メール（申請者向け）
	public static function notifyPreentreRequesting($user) {
		Config::load('master', true); // 定数ファイル
		$email = Email::forge();
		$email->from(Config::get('master.PREENTRE_MAIL_ADDRESS'), Config::get('master.HOME_DOMAIN'));
		$email->to($user->email, $user->name_last . $user->name_first);
		$email->bcc(Config::get('master.PREENTRE_MAIL_DESTINATION'), Config::get('master.HOME_DOMAIN'));
		$email->subject('【'. Config::get('master.SERVICE_NAME') .'】プレアントレメンバー申請完了のお知らせ');
		$data = [
			'user' 		=> $user,
		];
		$body = View::forge("email/preentre_requesting", $data);
		$email->body($body);
		try
		{
				$email->send();
		}
		catch(\EmailValidationFailedException $e)
		{
				// バリデーションが失敗したとき
				Log::error($e->getMessage());
		}
		catch(\EmailSendingFailedException $e)
		{
				// ドライバがメールを送信できなかったとき
				Log::error($e->getMessage());
		}
	}

	// プレアントレ申請の受付メール（事務局向け）
	public static function notifyPreentreRequest($preentre_request) {
		Config::load('master', true); // 定数ファイル
		$email = Email::forge();
		$email->from(Config::get('master.PREENTRE_MAIL_ADDRESS'), Config::get('master.HOME_DOMAIN'));
		$email->to(Config::get('master.PREENTRE_MAIL_DESTINATION'), Config::get('master.HOME_DOMAIN'));
		$email->subject('【承認依頼】プレアントレメンバー申請のお知らせ');
		$data = [
			'preentre_request' 		=> $preentre_request,
		];
		$body = View::forge("email/preentre_request", $data);
		$email->body($body);
		try
		{
				$email->send();
		}
		catch(\EmailValidationFailedException $e)
		{
				// バリデーションが失敗したとき
				Log::error($e->getMessage());
		}
		catch(\EmailSendingFailedException $e)
		{
				// ドライバがメールを送信できなかったとき
				Log::error($e->getMessage());
		}
	}

	// プレアントレ承認メール
	public static function notifyPreentreApproved($preentre_request) {
		Config::load('master', true); // 定数ファイル
		$user = $preentre_request->user;
		$email = Email::forge();
		$email->from(Config::get('master.PREENTRE_MAIL_ADDRESS'), Config::get('master.HOME_DOMAIN'));
		$email->to($user->email, $user->name_last . $user->name_first);
		$email->bcc(Config::get('master.PREENTRE_MAIL_DESTINATION'), Config::get('master.HOME_DOMAIN'));
		$email->subject('【'. Config::get('master.SERVICE_NAME') .'】プレアントレメンバー承認のお知らせ');
		$data = [
			'user' 		=> $user,
			'preentre_request' 		=> $preentre_request,
		];
		$body = View::forge("email/preentre_approved", $data);
		$email->body($body);
		try
		{
				$email->send();
		}
		catch(\EmailValidationFailedException $e)
		{
				// バリデーションが失敗したとき
				Log::error($e->getMessage());
		}
		catch(\EmailSendingFailedException $e)
		{
				// ドライバがメールを送信できなかったとき
				Log::error($e->getMessage());
		}
	}
	// プレアントレ非承認メール
	public static function notifyPreentreDisapproved($user) {
		Config::load('master', true); // 定数ファイル
		$email = Email::forge();
		$email->from(Config::get('master.PREENTRE_MAIL_ADDRESS'), Config::get('master.HOME_DOMAIN'));
		$email->to($user->email, $user->name_last . $user->name_first);
		$email->bcc(Config::get('master.PREENTRE_MAIL_DESTINATION'), Config::get('master.HOME_DOMAIN'));
		$email->subject('【'. Config::get('master.SERVICE_NAME') .'】プレアントレメンバー非承認のお知らせ');
		$data = [
			'user' 		=> $user,
		];
		$body = View::forge("email/preentre_disapproved", $data);
		$email->body($body);
		try
		{
				$email->send();
		}
		catch(\EmailValidationFailedException $e)
		{
				// バリデーションが失敗したとき
				Log::error($e->getMessage());
		}
		catch(\EmailSendingFailedException $e)
		{
				// ドライバがメールを送信できなかったとき
				Log::error($e->getMessage());
		}
	}
}
