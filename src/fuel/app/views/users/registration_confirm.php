		<div id="user-registration" class="section-container">
			<div class="section-inner">
				<div class="section-contents">

					<ul id="progress-navi">
						<li><span><span class="en">STEP.1</span> 入力</span></li>
						<li class="current"><span><span class="en">STEP.2</span> 確認</span></li>
						<li><span><span class="en">STEP.3</span> 送信完了</span></li>
					</ul>

					<form id="form" method="post" action="" name="form">
						<?= Form::csrf() ?>

						<div class="form-wrap clearfix">
							<dl class="clearfix">
								<dt>お名前</dt>
								<dd>
									<?php echo $onetimes['name_last']; ?><?php echo $onetimes['name_first']; ?>
								</dd>
							</dl>
							<dl class="clearfix">
								<dt>お名前（ふりがな）</dt>
								<dd>
									<?php echo $onetimes['hiragana_name_last']; ?><?php echo $onetimes['hiragana_name_first']; ?>
								</dd>
							</dl>
							<dl class="clearfix">
								<dt>メールアドレス</dt>
								<dd class="clearfix">
									<?php echo $onetimes['email']; ?>
								</dd>
							</dl>
							<!-- <dl class="clearfix">
							<dt>パスワード</dt>
							<dd class="clearfix">
							<?php echo $onetimes['password']; ?>
							</dd>
							</dl> -->
							<dl class="clearfix">
								<dt>電話番号</dt>
								<dd>
									<?php echo $onetimes['tel']; ?>
								</dd>
							</dl>
							<dl class="clearfix">
								<dt>生年月</dt>
								<dd>
									<?php echo $onetimes['birth_year']; ?>年 <?php echo $onetimes['birth_month']; ?>月
								</dd>
							</dl>
							<dl class="clearfix">
								<dt>性別</dt>
								<dd>
									<?php if ($onetimes['sex'] == 1): ?>
									  <p>男性</p>
									<?php elseif ($onetimes['sex'] == 2): ?>
									  <p>女性</p>
									<?php endif; ?>
								</dd>
							</dl>
              <dl class="clearfix">
                <dt>国籍</dt>
                <dd>
                  <?php echo $onetimes['nationality']; ?>
                </dd>
              </dl>
							<dl class="clearfix">
								<dt>住所</dt>
								<dd>
									〒<?php echo $onetimes['zip']; ?><br>
                  <?php $pref_code = Config::get('master.PREFECTURE_CODES'); ?>
                  <?php echo $pref_code[$onetimes['pref']]; ?><?php echo $onetimes['city']; ?>
                  <?php //echo $onetimes['address']; ?>
                  <?php //echo $onetimes['building']; ?>
								</dd>
							</dl>
							<dl class="clearfix">
								<dt>所属組織名</dt>
								<dd>
									<?php echo $onetimes['organization']; ?>
								</dd>
							</dl>
							<dl class="clearfix">
								<dt>役職</dt>
								<dd>
									<?php echo $onetimes['position']; ?>
								</dd>
							</dl>
							<dl class="clearfix">
								<dt>職業</dt>
								<dd>
									<?php echo $jobs[$onetimes['job']]; ?>
								</dd>
							</dl>

              <dl class="clearfix">
                <dt>起業への興味</dt>
                <dd>
                  <?php if (empty($onetimes['interest'])): ?>
                    <p>なし</p>
                  <?php else: ?>
                    <p>あり</p>
                  <?php endif; ?>
                </dd>
              </dl>
              <dl class="clearfix">
                <dt>起業への準備</dt>
                <dd>
                  <?php if (empty($onetimes['preparation'])): ?>
                    <p>していない</p>
                  <?php elseif ($onetimes['preparation'] == 1): ?>
                    <p>している</p>
                  <?php elseif ($onetimes['preparation'] == 2): ?>
                    <p>情報収集中</p>
                  <?php endif; ?>
                </dd>
              </dl>

<?php if (false): ?>
  <!--
	<dl class="clearfix">
	<dt>メルマガ登録</dt>
	<dd>
	<?php if (empty($onetimes['mailmagazine'])): ?>
	<p>しない</p>
	<?php else: ?>
	<p>する</p>
	<?php endif; ?>
	</dd>
	</dl> -->
<?php endif; ?>
							<dl class="clearfix">
								<dt>DMによる案内</dt>
								<dd>
									<?php if (empty($onetimes['mailmagazine_info'])): ?>
                    <p>受け取らない</p>
									<?php else: ?>
                    <p>受け取る</p>
									<?php endif; ?>
								</dd>
							</dl>
<?php if (false): ?>
  <!--
	<dl class="clearfix">
	<dt>起業における役割<span>（複数選択可）</span></dt>
	<dd>
	<?php echo $onetimes['role01']?'<p>経営専従</p>':''; ?>
	<?php echo $onetimes['role02']?'<p>プランナー</p>':''; ?>
	<?php echo $onetimes['role03']?'<p>マーケッター</p>':''; ?>
	<?php echo $onetimes['role04']?'<p>エンジニア</p>':''; ?>
	<?php echo $onetimes['role05']?'<p>研究者</p>':''; ?>
	<?php echo $onetimes['role06']?'<p>デザイナー</p>':''; ?>
	</dd>
	</dl>
	<dl class="clearfix">
	<dt>イベント参加状況</dt>
	<dd class="textarea">
	<pre><?php echo $onetimes['event']; ?></pre>
	</dd>
	</dl>
	<dl class="clearfix">
	<dt>マッチング履歴</dt>
	<dd class="textarea">
	<pre><?php echo $onetimes['matching']; ?></pre>
	</dd>
	</dl>
	<dl class="clearfix">
	<dt>起業予定日</dt>
	<dd>
	<?php if (!empty($onetimes['entrepreneur_year']) and !empty($onetimes['entrepreneur_month'])): ?>
	<?php echo $onetimes['entrepreneur_year']; ?>年 <?php echo $onetimes['entrepreneur_month']; ?>月
	<?php endif; ?>
	</dd>
	</dl>
	<dl class="clearfix">
	<dt>起業の業態</dt>
	<dd>
	<?php echo $business_types[$onetimes['business_type']]; ?>
	</dd>
	</dl>
	<dl class="clearfix">
	<dt>業種</dt>
	<dd>
	<?php echo $onetimes['industry']; ?>
	</dd>
	</dl> -->
<?php endif; ?>
						</div>

						<div class="btn-list clearfix">
							<div class="btn w160 h60 icon-none back">
								<div class="btn-inner clear">
									<a onClick="history.back(); return false;">
										<span class="text en">BACK</span>
									</a>
									<div class="line"></div>
									<div class="line2"></div>
								</div>
							</div>
							<div class="btn">
								<div class="btn-inner black">
									<button id="submit-btn">
										<span class="text en">SUBMIT</span>
									</button>
									<div class="line"></div>
									<div class="line2"></div>
								</div>
							</div>
						</div><!--btn_list-->

					</form>

				</div><!-- /.section-contents -->
			</div><!-- /.section-inner -->
		</div><!-- /.section-container -->
