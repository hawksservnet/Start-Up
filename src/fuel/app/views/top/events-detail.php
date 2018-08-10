<?php
$page_id = 'events'; //ページ独自にスタイルを指定する場合は入力
$page_title = ''; //ページ名
$child_title = ''; //子ページ名
$page_description = '';
$page_keyword = '';
$page_path = ''; //階層
$extra_css = '
'; //何か追加で読み込みたいCSSがあればlinkタグごと記述
	// <script src="assets/js/index.js"></script>


$extra_js = '
<script src="//maps.google.com/maps/api/js"></script>
<script src="assets/js/events.js"></script>
'; //何か追加で読み込みたいJSがあればscriptタグごと記述
include '_header.php'; ?>

		<h2 id="page-title" class="clearfix">
			<div class="page-title-inner">
				<span class="en">EVENTS</span>
				<span class="jp">イベント</span>
			</div>
		</h2>

		<div class="section-container">
			<div class="section-inner">
				<div class="section-contents">

					<article id="events-detail-container">

						<section id="events-main" class="detail-section-container">
							<div class="events-title-container">
								<div class="events-title-inner">
									<time class="date"><div class="date-inner">2017.1.15 17:00~</div></time>
									<h3 class="title">独立支援セミナーダミーダミーダミー</h3>
									<p class="category">カテゴリA</p>
								</div>
							</div><!-- /.events-title-container -->

							<p class="photo"><span class="photo-inner" style="background-image:url('assets/img/index/dummy-events_img.jpg');"></span></p>
							<div class="text-container">
								<p class="text">文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります
								文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります<br>
								文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここ<br>
								に入ります文章がここに入ります文章がここに入ります文章がここに入ります<br>
								文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります<br>
								文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります</p>
							</div>

							<div class="info-container clearfix">
								<div class="table-container">
									<table>
										<tr>
											<th>日時</th>
											<td>2016年12月23日（木）18:30〜22:30</td>
										</tr>
										<tr>
											<th>定員</th>
											<td>40名</td>
										</tr>
										<tr>
											<th>会場</th>
											<td>スタートアップハブ東京 大会議室<br>〒000-0000 東京都渋谷区◯◯◯◯◯◯◯◯</td>
										</tr>
										<tr>
											<th>主催者</th>
											<td>東京都</td>
										</tr>
										<tr>
											<th>URL</th>
											<td><a href="http://tokyo.co.jp" target="_blank">http://tokyo.co.jp</a></td>
										</tr>
									</table>
								</div><!-- /.table-container -->
								<div class="map-container">
									<div id="map"></div>
								</div><!-- /.map-container -->
							</div>

							<div class="btn center">
								<div class="btn-inner black">
									<a href="">
										<span class="text jp">参加申し込み</span>
									</a>
									<div class="line"></div>
									<div class="line2"></div>
								</div>
							</div>

						</section><!-- /.detail-section-container -->

						<section class="detail-section-container">

							<!-- フリーエリア -->

						</section><!-- /.detail-section-container -->

					</article>

				</div><!-- /.section-contents -->
			</div><!-- /.section-inner -->
		</section><!-- /.section-container -->

<?php include '_footer.php'; ?>