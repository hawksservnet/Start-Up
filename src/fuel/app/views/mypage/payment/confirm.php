<?php echo Form::open('mypage/payment/confirm') ?>
	<div class="form_wrap">
		<ul class="form_list confirm inner">
			<li>
				<dl class="clearfix">
					<dt>カード番号</dt>
					<dd>1234 5678 9012 3456</dd>
				</dl>
			</li>
			<li>
				<dl class="clearfix">
					<dt>有効期限</dt>
					<dd>00/00</dd>
				</dl>
			</li>
			<li>
				<dl class="clearfix">
					<dt>セキュリティコード</dt>
					<dd>000</dd>
				</dl>
			</li>
		</ul>
		<p>変更内容をご確認下さい。</p>
	</div>

	<div class="bg_black_wrap fixed_bottom">
		<div class="btn black center"><button><span>変更する</span></button></div>
	</div>
<?php echo Form::close() ?>
