<?php
    $url = "https://startuphub.tokyo/";
    if (strpos($_SERVER["HTTP_HOST"],'dev-mp') !== false) {
        $url ='https://dev.startuphub.tokyo/';
    }
?>
<div id="mypage" class="section-container">
	<div class="mypage-navi">
		<div class="inner">
			<ul>
				<li><a href="<?php echo Uri::create('mypage/index'); ?>">予約・開催済みイベント</a></li>
				<li class="active"><a href="<?php echo Uri::create('mypage/profile'); ?>">登録情報</a></li>
                <li><a href="<?php echo $url . 'mypage/reserve/list'; ?>">コンシェルジュ相談申込履歴</a></li>
                <li><a href="<?php echo $url . 'mypage/nursery/list'; ?>">一時保育サービス予約状況</a></li>
			</ul>
		</div>
	</div>
	<div class="section-inner">
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
						<div class="detail-action">
							<div class="btn w110 h40 icon-none">
								<div class="btn-inner clear">
									<a href="<?php echo Uri::create('users/edit/'. $user->id .'/base'); ?>">変更</a>
									<div class="line"></div>
									<div class="line2"></div>
								</div>
							</div>
						</div>
					</dd>
				</dl>
				<dl class="profile-row">
					<dt class="profile-head">DMによる案内</dt>
					<dd class="profile-detail">
						<div class="detail-content">
							<?= $user->mailmagazine_info?'受け取る':'受け取らない'  ?>
						</div>
						<div class="detail-action">
							<div class="btn w110 h40 icon-none">
								<div class="btn-inner clear">
									<a href="<?php echo Uri::create('users/edit/'. $user->id .'/dm'); ?>">変更</a>
									<div class="line"></div>
									<div class="line2"></div>
								</div>
							</div>
						</div>
					</dd>
				</dl>
				<dl class="profile-row">
					<dt class="profile-head">パスワード</dt>
					<dd class="profile-detail">
						<div class="detail-content">＊＊＊＊＊＊</div>
						<div class="detail-action">
							<div class="btn w110 h40 icon-none">
								<div class="btn-inner clear">
									<a href="<?php echo Uri::create('users/edit_pw/'. $user->id); ?>">変更</a>
									<div class="line"></div>
									<div class="line2"></div>
								</div>
							</div>
						</div>
					</dd>
				</dl>
        <?php $preentre_request = reset($user->preentre_requests);
        if (!empty($preentre_request->updated_at)){ // プレアントレデータあり　
          $end_at = mktime(0, 0, 0, date('m', $preentre_request->updated_at) + 4, 0, date('Y', $preentre_request->updated_at));
        }?>
				<dl class="profile-row">
					<dt class="profile-head">会員種別</dt>
					<dd class="profile-detail">
						<div class="detail-content">
              <?php
            		if(!empty($preentre_request->updated_at) and (strtotime(date("Y/m/d")) > strtotime(date('Y/m/d', $end_at)))){
            			echo "メンバー";
            		}else{
            			echo $user->getType();
            		}
              ?>
							　/　メンバー登録日: <?= $user->getRegistrationDate() ?>
						</div>
						<div class="detail-action">
						</div>
					</dd>
				</dl>
        <?php if (!empty($preentre_request->updated_at)){ // プレアントレデータあり　?>
        <dl class="profile-row">
					<dt class="profile-head">プレアントレメンバー有効期限</dt>
					<dd class="profile-detail">
						<div class="detail-content">
              <?php
                //システム日時　＜＝　有効期限
            		if(strtotime(date("Y/m/d")) <= strtotime(date('Y/m/d', $end_at))){
            			echo date('Y/m/d', $end_at);
            		}else{
            			echo "<font color='red'>".date('Y/m/d', $end_at)."　※期限切れ</font>";
            		}
              ?>
            </div>
						<div class="detail-action">
						</div>
					</dd>
				</dl>
        <?php } ?>
			</div>
      <?php if (!$user->isPreentre()): // プレアントレでない、申請中でもない ?>
            <div class="btn center mt">
                <div class="btn-inner black">
                    <a href="<?= Uri::create("mypage/preentre"); ?>">
                        <span class="text">プレアントレメンバーになる</span>
                    </a>
                    <div class="line"></div>
                    <div class="line2"></div>
                </div>
            </div>
            <p class="bottom-info-text">
				プレアントレメンバーになると会員限定エリア（メンバーズサロン）が利用できます。<br>その他、プレアントレ限定のセミナーやサポートプログラム（計画中）を受けられます。<br>
            	<a href="<?php echo $url.'pre-entre/'; ?>" class="link-color">詳細はこちら</a></p>
      <?php endif; ?>



		</div><!-- /.section-contents -->
	</div><!-- /.section-inner -->
</div><!-- /.section-container -->
