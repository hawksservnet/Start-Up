<?php
  $url = (strpos($_SERVER["HTTP_HOST"],':8081') === false)?"https://startuphub.tokyo/":"http://startuphub.tokyo:8081/" ;
?>
<div id="mypage" class="section-container">
	<div class="mypage-navi">
		<div class="inner">
			<ul>
				<li class="active"><a href="<?php echo Uri::create('mypage/index'); ?>">予約・開催済みイベント</a></li>
				<li><a href="<?php echo Uri::create('mypage/profile'); ?>">登録情報</a></li>
			</ul>
		</div>
	</div>
	<div class="section-inner">
		<div class="section-contents">

			<div class="event-information">
				<div class="event-navi">
					<ul>
						<li><a href="<?php echo Uri::create('mypage/index'); ?>">予約済みイベント</a></li>
						<li class="active"><a href="<?php echo Uri::create('mypage/event_history'); ?>">開催済みイベント</a></li>
					</ul>
				</div>
      <?php if (empty($requests)): ?>

            <div class="event-none-container clearfix">
                <p class="text">参加いただいたイベントはございません。<br>
                	以下のボタンよりイベントをご予約いただけます。ご希望のイベントをお選びください。</p>

                <div class="btn-list clearfix">
                    <div class="btn center">
                        <div class="btn-inner black">
                            <a href="<?php echo $url.'event/'; ?>">
                                <span class="text">イベントを予約する</span>
                            </a>
                            <div class="line"></div>
                            <div class="line2"></div>
                        </div>
                    </div>
                </div><!--btn_list-->
            </div>


      <?php else: ?>
				<div class="event-content">
					<div class="event-select">
						<div class="event-select-group">
							<div class="select-title">MONTH</div>
							<div class="select-body">
								<div class="select">
									<select class="select half required" name="job" id="form_job">
										<option value="" selected="selected">開催月から探す</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<ul class="event-list">
          <?php foreach ($requests as $rkey => $request): ?>
						<li class="event-item start<?php echo Date::forge(strtotime($request->event->start_time))->format("%Y年%m月") ?>">
							<div class="image-box"><a href="<?= $request->event->wp_url; ?>"><img src="<?= $request->event->img_url ?>" alt=""></a></div>
							<div class="detail-box">
								<p class="datetime"><?= $request->event->getStartDate() ?>
                          <?= $request->event->getStartTime() ?> 〜 <?= $request->event->getEndTime() ?>
                </p>
								<p class="title"><a href="<?= $request->event->wp_url; ?>"><?= $request->event->title ?></a></p>
								<p class="host">主催者：<?= $request->event->organizer ?></p>
							</div>
						</li>
          <?php endforeach; ?>
					</ul>
				</div>
      <?php endif; ?>
			</div>

		</div><!-- /.section-contents -->
	</div><!-- /.section-inner -->
</div><!-- /.section-container -->
