	<form action="" id="" method="post">
	<?= Form::csrf() ?>
	<div class="form_wrap">

		<div class="text_wrap border_bottom inner">
			<p>下記の項目を確認の上、ログイン用のパスワードをご入力いただき、「次へ」ボタンを押してください。</p>
			<div class="bg_gray_wrap caution_text_wrap">
				<ul>
					<li>※退会後アカウントの復帰はできません。</li>
					<li>※お持ちのクーポンは全て無効となります。</li>
					<li>※新しい会員登録へのクーポンの移行はできません。</li>
				</ul>
			</div>
		</div>
		<?php if(!$order): ?>
			<ul class="form_list inner">
				<li>
					<dl class="clearfix">
						<dt class="required">パスワード</dt>
						<dd><?php echo Form::input("password", Input::post('password'), array('type'=>'password','placeholder'=>"英数8桁以上", "class"=>"clear text")) ?></dd>
					</dl>
				</li>
			</ul>
			<div class="btn_list_wrap inner">
				<div class="btn black center"><button><span>次へ</span></button></div>
				<div class="btn gray center mt"><a href="<?php echo Uri::create("mypage") ?>"><span>マイページに戻る</span></a></div>
			</div>
		<?php else: ?>
			<div class="bg_gray_wrap caution_text_wrap">
				<ul>
					<li>現在予約中または利用中の自転車があるため退会できません。</li>
					
				</ul>
			</div>
		<?php endif; ?>
	</div>
	</form>
