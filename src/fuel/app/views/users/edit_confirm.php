<div id="user-registration" class="section-container">
  <div class="section-inner">
    <div class="section-contents">
      <p class="lead center">下記内容にお間違いがないかご確認ください。</p>
      <form method="post" enctype="multipart/form-data">



		<div class="section-contents">
			<div class="profile-wrap">
				<dl class="profile-row">
					<dt class="profile-head middle">基本情報</dt>
					<dd class="profile-detail">
						<div class="detail-content">
							<dl class="profile-item">
								<dt>名前</dt>
								<dd><?= $user->getName() ?></dd>
							</dl>
							<dl class="profile-item">
								<dt>ふりがな</dt>
								<dd><?= $user->getHiraganaName() ?></dd>
							</dl>
							<dl class="profile-item">
								<dt>メールアドレス</dt>
								<dd><?= $user->email ?></dd>
							</dl>
							<dl class="profile-item">
								<dt>電話番号</dt>
								<dd><?= $user->tel ?></dd>
							</dl>
							<dl class="profile-item">
								<dt>生年月</dt>
								<dd><?= $user->getBirthday() ?></dd>
							</dl>
							<dl class="profile-item">
								<dt>性別</dt>
								<dd><?= $user->getSex() ?></dd>
							</dl>
							<dl class="profile-item">
								<dt>国籍</dt>
								<dd><?= $user->nationality ?></dd>
							</dl>
							<dl class="profile-item">
								<dt>郵便番号</dt>
								<dd><?= $user->zip ?></dd>
							</dl>
							<dl class="profile-item">
								<dt>住所</dt>
								<dd><?= $user->getPref() . $user->city ?></dd>
							</dl>
							<dl class="profile-item">
								<dt>所属組織名</dt>
								<dd><?= $user->organization ?></dd>
							</dl>
							<dl class="profile-item">
								<dt>役職</dt>
								<dd><?= $user->position ?></dd>
							</dl>
							<dl class="profile-item">
								<dt>職業</dt>
								<dd><?= $user->getJob() ?></dd>
							</dl>

              <dl class="profile-item">
                <dt>起業への興味</dt>
                <dd>
                  <?php if (empty($user->interest)): ?>
                    <p>なし</p>
                  <?php else: ?>
                    <p>あり</p>
                  <?php endif; ?>
                </dd>
              </dl>
              <dl class="profile-item">
                <dt>起業への準備</dt>
                <dd>
                  <?php if (empty($user->preparation)): ?>
                    <p>していない</p>
                  <?php elseif ($user->preparation == 1): ?>
                    <p>している</p>
                  <?php elseif ($user->preparation == 2): ?>
                    <p>情報収集中</p>
                  <?php endif; ?>
                </dd>
              </dl>

						</div>
					</dd>
				</dl>
			</div>
		</div><!-- /.section-contents -->



        <!-- ボタン -->
        <div class="btn-list clearfix">
          <div class="btn w160 h60 icon-none back">
            <div class="btn-inner clear">
              <a class="overlay-text" id="reset-btn" onclick="history.back();return false">
                <span class="text en">BACK</span>
              </a>
              <div class="line"></div>
              <div class="line2"></div>
            </div>
          </div>
          <div id="submit-btn" class="btn">
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
    </div>
  </div>
</div>
