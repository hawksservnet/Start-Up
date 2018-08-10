<?php echo Form::open('mypage/account') ?>
<?php echo Form::csrf() ?>
	<div class="form_wrap">
		<ul class="form_list inner">
			<li>
				<dl class="clearfix">
					<dt>名前</dt>
					<dd><?php echo Form::input('name', Input::post('name', isset($session) ? $session['name'] : $user->name), array('type'=>'text', 'class'=>'clear text', "placeholder"=>"やまだたろう")) ?>
						<p class="caution_text">お名前は漢字で正しくご入力をお願いします。正しくご入力いただけなかった場合、各種保険の適用外となってしまう場合がございます。</p>
					</dd>
				</dl>
			</li>
			<li>
				<dl class="clearfix">
					<dt>メールアドレス</dt>
					<dd><?php echo Form::input('email', Input::post('email', isset($session) ? $session['email'] : $user->email), array('type'=>'text', 'class'=>'clear text', "placeholder"=>"name@example.com")) ?></dd>
				</dl>
			</li>
			<li>
				<dl class="clearfix">
					<dt>電話番号</dt>
					<dd><?php echo Form::input('tel', Input::post('tel', isset($session) ? $session['tel'] : $user->tel), array('type'=>'tel', 'class'=>'clear text', "placeholder"=>"000-0000-0000")) ?></dd>
				</dl>
			</li>
			<li>
				<dl class="clearfix">
					<dt>パスワード（現在のパスワード）</dt>
					<dd><?php echo Form::password('password_confirm', '', array('type'=>'tel', 'class'=>'clear text', "placeholder"=>"英数8桁以上")) ?></dd>
				</dl>
			</li>
			<li>
				<dl class="clearfix">
					<dt>新パスワード（変更する場合）</dt>
					<dd><?php echo Form::password('password', '', array('type'=>'tel', 'class'=>'clear text', "placeholder"=>"英数8桁以上")) ?></dd>
				</dl>
			</li>
		</ul>
	</div>

	<div class="bg_black_wrap fixed_bottom">
		<div class="btn black center"><button><span>次へ</span></button></div>
	</div>
<?php echo Form::close() ?>
