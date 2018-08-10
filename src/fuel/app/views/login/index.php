			<?php if(!$is_pc): ?>
				<div id="login_wrap">
					<div class="form_wrap">
						<?php if(isset($login_alert)): ?>
							<p class="alert_text"><span>予約いただくにはログインが必要です。<br>はじめてご利用の方はアカウント登録をお願いいたします。</span></p>
						<?php endif; ?>
						<h2 class="sub_title">オリジナルアカウント</h2>
            			<?= Form::open(); ?>
						<?= Form::csrf() ?>
							<ul class="form_list inner">
								<li>
									<dl class="clearfix">
										<dt>メールアドレス</dt>
										<dd><input type="email" class="clear text" name="email" placeholder="name@example.com"></dd>
									</dl>
								</li>
								<li>
									<dl class="clearfix">
										<dt>パスワード</dt>
										<dd><input type="password" class="clear text" name="password" placeholder="英数8桁以上"></dd>
									</dl>
								</li>
							</ul>
							<a class="text_remind" href="<?php echo Uri::create('login/remind_password') ?>"><span>パスワードをお忘れの方</span></a>
							<div class="bg_black_wrap">
								<div class="btn green center"><button><span>ログイン</span></button></div>
							</div>
						</form>
					</div><!-- /.form_wrap -->
				</div><!-- /#login_wrap -->
				<?php endif; ?>

				<?php if($is_pc): ?>
					<div id="login_wrap">
						<div class="form_wrap">
							<p class="login_text">当サービスはスマートフォンにてご利用いただけます。<br>
							以下のボタンよりスマートフォンへURLをお送りいただきアクセスをしてください。<br>
							ご登録いただいたアカウントでログインをすると直ぐにサービスをご利用開始いただけます。</p>
							<div class="btn_wrap">
								<div class="btn center black"><a href="mailto:?subject=HELLOCYCLING&body=<?= Config::get('master.HELLOCYCLING_URL'); ?>"><span>メールで送る</span></a></div>
							</div>
						</div><!-- /.form_wrap -->
					</div><!-- /#login_wrap -->
					<h2 id="page_title">新規登録</h2>
					<div id="login_wrap">
						<div class="form_wrap">
							<p class="login_text">会員のご登録はPCからも可能です。以下のボタンよりご登録いただけます。</p>
						</div><!-- /.form_wrap -->
					</div><!-- /#login_wrap -->
				<?php endif; ?>

				<div id="account_wrap">
					<h2 class="sub_title"><span>はじめてご利用の方</span></h2>
					<div class="btn black center"><a href="<?= Uri::create('users/add_account'); ?>"><span>新しいアカウントを作成</span></a></div>


					<h2 class="sub_title"><span>Faceboookアカウントをお持ちの方</span></h2>
					<div class="btn facebook center"><a href="<?php echo Uri::create('auth/oauth/facebook') ?>"><span>Facebookアカウントでログイン</span></a></div>
				</div><!-- /#account_wrap -->

<script>
  // マップ位置をクリア
  window.sessionStorage.removeItem('last_lat')
  window.sessionStorage.removeItem('last_lng')
  window.sessionStorage.removeItem('last_zoom')
</script>
