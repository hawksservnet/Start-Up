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

					<p class="text">StartUpHUB TOKYOでは、会員の皆様の取り組みをサポートすべく、様々なイベントを開催しています。<br class="pc">
文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります<br class="pc">
文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります<br class="pc">
文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります</p>

					<nav id="month-category-list" class="clearfix">
						<div id="month-list" class="list-container">
							<p class="title">MONTH</p>
							<ul class="clearfix">
								<li><a href="" class="current">2017.1</a></li>
								<li><a href="">2017.2</a></li>
								<li><a href="">2017.3</a></li>
							</ul>
						</div>
						<div id="category-list" class="list-container">
							<p class="title">CATEGORY</p>
							<ul class="clearfix">
								<li><a href="">CATEGORY A</a></li>
								<li><a href="">CATEGORY B</a></li>
								<li><a href="">CATEGORY C</a></li>
							</ul>
						</div>
					</nav>

					<div id="events-list" class="clearfix">
						<article>
							<p class="photo"><span class="photo-inner" style="background-image:url('assets/img/index/dummy-events_img.jpg');"></span></p>
							<time class="date"><div class="date-inner">2017.1.15 17:00~</div></time>
							<div class="text-container">
								<p class="title">独立支援ダミーダミーダミーダミーダミーダミーセミナー</p>
								<ul class="category">
									<li>カテゴリA</li>
									<li>カテゴリAカテゴリA</li>
								</ul>
							</div>
						</article>
						<article>
							<p class="photo"><span class="photo-inner" style="background-image:url('assets/img/index/dummy-events_img.jpg');"></span></p>
							<time class="date"><div class="date-inner">2017.1.15 17:00~</div></time>
							<div class="text-container">
								<p class="title">独立支援ダミーダミーダミーダミーダミーダミーセミナー</p>
								<ul class="category">
									<li>カテゴリA</li>
									<li>カテゴリAカテゴリA</li>
									<li>カテゴリA</li>
								</ul>
							</div>
						</article>
						<article>
							<p class="photo"><span class="photo-inner" style="background-image:url('assets/img/index/dummy-events_img.jpg');"></span></p>
							<time class="date"><div class="date-inner">2017.1.15 17:00~</div></time>
							<div class="text-container">
								<p class="title">独立支援ダミーダミーダミーダミーダミーダミーセミナー</p>
								<ul class="category">
									<li>カテゴリA</li>
									<li>カテゴリAカテゴリA</li>
									<li>カテゴリA</li>
								</ul>
							</div>
						</article>
					</div>

					<div class="pagenavi-wrap">
						<div class="wp-pagenavi">
							<a class="previouspostslink" rel="next" href=""><<</a>
							<span class="pages">1 / 6</span>
							<span class="current">1</span>
							<a class="page larger" href="">2</a>
							<a class="page larger" href="">3</a>
							<a class="page larger" href="">4</a>
							<a class="page larger" href="">5</a>
							<span class="extend">...</span>
							<a class="nextpostslink" rel="next" href="">»</a>
							<a class="last" href="">»</a>
						</div>
					</div>

				</div><!-- /.section-contents -->
			</div><!-- /.section-inner -->
		</section><!-- /.section-container -->
<?php include '_footer.php'; ?>