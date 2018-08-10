<div id="login-container" class="section-container">
	<div class="section-inner">
		<div class="section-contents">

			<div id="login_wrap">
				<div class="form_wrap">
                    <?php
                    $loginAction = "users/login";
                    if(!empty($this->data) && !empty($this->data['h'])){
                        $loginAction = $loginAction . ("?h=" . $this->data['h']);
                    }
                    ?>
					<?php echo Form::open($loginAction) ?>
						<?= Form::csrf() ?>
						<ul class="form_list inner">
							<li>
								<dl class="clearfix">
									<dt>ID</dt>
									<dd><input type="email" class="clear text" name="email" placeholder="name@example.com"></dd>
								</dl>
							</li>
							<li>
								<dl class="clearfix">
									<dt>PASS</dt>
									<dd><input type="password" class="clear text" name="password" placeholder="英数8桁以上"></dd>
								</dl>
							</li>
						</ul>
						<div class="action">
							<div class="btn center">
								<div class="btn-inner">
									<button type="submit">ログインする</button>
									<div class="line"></div>
									<div class="line2"></div>
								</div>
							</div>
							<div class="text_remind">
								<a href="<?php echo Uri::create('users/forgot_password'); ?>"><span>パスワードを忘れた方はこちら</span></a>
							</div>
						</div>
					<?php echo Form::close() ?>
				</div><!-- /.form_wrap -->
			</div><!-- /#login_wrap -->

		</div><!-- /.section-contents -->
	</div><!-- /.section-inner -->
</div><!-- /.section-container -->