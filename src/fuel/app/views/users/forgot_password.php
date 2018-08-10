<div id="forgot_password" class="section-container">
	<div class="section-inner">
		<div class="section-contents">

			<p class="text">パスワードを忘れた場合、メールアドレスを入力し、「送信する」ボタンをクリックして下さい。<br>入力されたメールアドレスに確認メールを送信いたします。</p>

			<div id="pass_wrap">
				<div class="form_wrap">
					<?php echo Form::open("users/forgot_password") ?>
						<?= Form::csrf() ?>
						<ul class="form_list inner">
							<li>
								<dl class="clearfix">
									<dt>メールアドレス</dt>
									<dd><input type="email" class="clear text" name="email" placeholder="name@example.com"></dd>
								</dl>
							</li>
						</ul>
						<div class="action">
							<div class="btn center">
								<div class="btn-inner">
									<button type="submit">送信する</button>
									<div class="line"></div>
									<div class="line2"></div>
								</div>
							</div>
						</div>
					<?php echo Form::close() ?>
				</div><!-- /.form_wrap -->
			</div><!-- /#login_wrap -->

		</div><!-- /.section-contents -->
	</div><!-- /.section-inner -->
</div><!-- /.section-container -->