	
	<p class="text_wrap inner">ご登録のメールアドレスを入力して下さい。<br>
	新しいパスワードを記載したメールが送信されます。</p>

	<form action="" id="" method="post">
	<?= Form::csrf() ?>
	<div class="form_wrap">

		<ul class="form_list inner">
			<li>
				<dl class="clearfix">
					<dt class="required">メールアドレス</dt>
					<dd><?php echo Form::input("email", Input::post('email'), array('type'=>'email', 'placeholder'=>"name@example.com", "class"=>"clear text")) ?></dd>
				</dl>
			</li>
		</ul>
		<div class="bg_black_wrap fixed_bottom">
			<div class="btn black center"><button><span>次へ</span></button></div>
		</div>
	</div>
	</form>

