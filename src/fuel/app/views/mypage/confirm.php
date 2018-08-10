<?php echo Form::open('mypage/confirm') ?>
<?php echo Form::csrf() ?>

	<div class="form_wrap">
		<ul class="form_list confirm inner">
			<li>
				<dl class="clearfix">
					<dt>名前</dt>
					<dd><?php echo $session['name'] ?></dd>
				</dl>
			</li>
			<li>
				<dl class="clearfix">
					<dt>メールアドレス</dt>
					<dd><?php echo $session['email'] ?></dd>
				</dl>
			</li>
			<li>
				<dl class="clearfix">
					<dt>電話番号</dt>
					<dd><?php echo $session['tel'] ?></dd>
				</dl>
			</li>
			<?php if (!empty($session['password'])): ?>
			<li>
				<dl class="clearfix">
					<dt>パスワード</dt>
					<dd>英数8桁以上</dd>
				</dl>
			</li>
			<?php endif; ?>
		</ul>
		<p class="inner">変更内容をご確認下さい。</p>
	</div>

	<div class="bg_black_wrap fixed_bottom">
		<?php echo Form::hidden('edit_complete', '1') ?>
		<div class="btn black center"><button><span>変更する</span></button></div>
	</div>
<?php echo Form::close() ?>
