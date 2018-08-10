<!DOCTYPE html>
<html lang="ja">
<head>
	<meta name="globalsign-domain-verification" content="LzjEIzJIk7b4ZVs10A9kxqG4wzy0XeNEknEZcYE498" />
	<meta charset="utf-8">
	<?php echo Asset::js('common/head.js'); ?>
	<script>
	if (Useragnt.mobile) {
	    document.write('<meta name="viewport" content="width=device-width,user-scalable=yes,initial-scale=1, maximum-scale=1, minimum-scale=1">');
	} else if (Useragnt.tablet) {
	    document.write('<meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=1280">');
	} else {
	    document.write('<meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=1280">');
	}
	</script>
	<meta name="format-detection" content="telephone=no">
	<title><?php echo $page_title; ?></title>
	<meta name="description" itemprop="description" content="<?php echo $page_discription; ?>" />
	<meta name="keywords" itemprop="keywords" content="" />
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo Asset::get_file('apple-touch-icon-57x57.png','img'); ?>">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo Asset::get_file('apple-touch-icon-60x60.png','img'); ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo Asset::get_file('apple-touch-icon-72x72.png','img'); ?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo Asset::get_file('apple-touch-icon-76x76.png','img'); ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo Asset::get_file('apple-touch-icon-114x114.png','img'); ?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo Asset::get_file('apple-touch-icon-120x120.png','img'); ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo Asset::get_file('apple-touch-icon-144x144.png','img'); ?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo Asset::get_file('apple-touch-icon-152x152.png','img'); ?>">
	<link rel="icon" type="image/png" href="<?php echo Asset::get_file('favicon-16x16.png','img'); ?>" sizes="16x16">
	<link rel="icon" type="image/png" href="<?php echo Asset::get_file('favicon-32x32.png','img'); ?>" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo Asset::get_file('favicon-96x96.png','img'); ?>" sizes="96x96">
	<link rel="icon" type="image/png" href="<?php echo Asset::get_file('favicon-196x196.png','img'); ?>" sizes="196x196">
	<meta name="msapplication-TileImage" content="<?php echo Asset::get_file('mstile-144x144.png','img'); ?>">
	<meta name="theme-color" content="#fabe00">
	<meta name="apple-mobile-web-app-title" content="HELLO CYCLING">
	<meta property="og:title" content="<?php echo $page_title; ?>" />
	<meta property="og:type" content="article">
	<meta property="og:url" content="<?php echo $URL; ?>" />
	<meta property="og:image" content="https://www.hellocycling.jp/app/front/assets/hello-cycling/images/common/meta/ogp.jpg" />
	<meta property="og:site_name" content="HELLO CYCLING" />
	<meta property="og:description" content="HELLO CYCLING（ハローサイクリング）は無料会員登録後直ぐに使えるシェアサイクリングサービスです。ICカードをご登録いただくと予約不要でご利用いただけます。" />
	<meta property="fb:app_id" content="243256019426101" />

	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="<?php echo $page_title; ?>">
	<meta name="twitter:title" content="<?php echo $page_title; ?>">
	<meta name="twitter:url" content="<?php echo $URL; ?>">
	<meta name="twitter:image" content="https://www.hellocycling.jp/app/front/assets/hello-cycling/images/common/meta/ogp.jpg" />
	<meta name="twitter:description" content="HELLO CYCLING（ハローサイクリング）は無料会員登録後直ぐに使えるシェアサイクリングサービスです。ICカードをご登録いただくと予約不要でご利用いただけます。"

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">
<?php echo Asset::css('common/normalize.css'); ?>
<?php echo Asset::css('common/jquery.mCustomScrollbar.css'); ?>
<?php echo Asset::css('common/styles.css'); ?>
<?php echo Asset::add_path('front/assets/'); ?>
<?php echo Asset::css('pc.css'); ?>

<link href="assets/img/common/apple-touch-icon.png" rel="apple-touch-icon">
<meta name="apple-mobile-web-app-title" content="">

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<?php echo Asset::js('_min/common/_lib/jquery.mCustomScrollbar.js'); ?>
<?php echo Asset::js('_min/common/validation.js'); ?>
<?php echo Asset::js('_min/common/script.js'); ?>
<!-- <script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=true&key=AIzaSyDZwcOzQKqqKBM7ZGPQ-d2imCeuqzE6rYo&libraries=geometry"></script> -->
<?php echo Asset::js('common/_lib/jquery.easing.v1.3.js'); ?>
<?php echo Asset::js('common/_lib/flipsnap.min.js'); ?>
<?php echo Asset::js('common/_lib/pace.min.js'); ?>
<?php echo Asset::js('common/_lib/jquery.cookie.js'); ?>
<?php echo Asset::js('common/_lib/jquery.customSelect.min.js'); ?>

<?php echo Asset::add_path('front/assets/'); ?>
<?php echo Asset::render('extra_css');?>
<?php echo Asset::render('extra_js');?>
<?php if(Auth::check()): ?>
<?php echo Asset::js('map_login_pc.js'); ?>
<?php endif; ?>
</head>
<body>
<div id="document">
	<header class="header">
      <div class="inner">
        <h1 class="logo"><a href="https://www.hellocycling.jp">HELLO CYCLING</a></h1>
        <div class="sp gnav-switch"></div>
        <nav class="gnav">
			<?php if(!Auth::check()): ?>
			<div class="btn-contact"><a href="<?= Uri::create('login'); ?>">ログイン／会員登録</a></div>
			<?php else: ?>
			<div class="btn-contact"><a href="<?php echo Uri::create("login/logout") ?>">ログアウト</a></div>
			<?php endif; ?>
          <ul>
            <li><a href="https://www.hellocycling.jp/#service" class="exlink" onClick="ga('send', 'event', 'SERVICE遷移', 'クリック', 'ヘッダ', 1);">SERVICE</a></li>
            <li><a href="https://www.hellocycling.jp/#howtouse" class="exlink" onClick="ga('send', 'event', 'HOW TO USE遷移', 'クリック', 'ヘッダ', 1);">HOW TO USE</a></li>
            <li><a href="https://www.hellocycling.jp/#howitworks" class="exlink" onClick="ga('send', 'event', 'HOW IT WORKS遷移', 'クリック', 'ヘッダ', 1);">HOW IT WORKS</a></li>
            <li><a href="../faq" class="exlink">FAQ</a></li>
            <!-- <li><span>FAQ</span></li> -->
            <li class="sub sp"><a href="https://www.hellocycling.jp/app/terms" class="exlink">TERMS OF USE</a></li>
            <li class="sub sp"><a href="https://www.hellocycling.jp/company" class="exlink">COMPANY</a></li>
            <li class="sub sp"><a href="https://www.hellocycling.jp/privacypolicy/" class="exlink">PRIVACY POLICY</a></li>
          </ul>
<!--
                    <div class="social sp">
                        <div class="facebook"><a href="#" class="exlink">Facebook</a></div>
                        <div class="twitter"><a href="#" class="exlink">Twitter</a></div>
                    </div>
-->
          <div class="gnav-close sp">×</div>
        </nav>
      </div>
    </header>
	<!-- <header id="header">
		<div class="top_wrap clearfix">
			<h1 id="system_name"><a href="https://hellocycling.jp" class="op_hover"><img src="assets/img/common/logo.svg" alt="HELLO CYCLING"></a></h1>
			<div class="login_info clearfix">
				<p class="user_name">ユーザー</p>
				<div class="logout_btn"><a href="<?= Uri::create('login'); ?>">新規登録</a></div>
			</div>
		</div>
	</header> -->
	<main id="main_wrap" class="clearfix">
    <?php echo $content; ?>
  </main><!-- /#main_wrap -->

  <!-- フッター -->
  <?php echo $footer; ?>
</div><!-- /#document_wrap -->
<div id="dialog_wrap">
	<div class="text_wrap center">
		<p>すでにログインしています</p>
	</div>
	<div class="btn_wrap">
		<div class="add_btn center close_btn"><span>OK</span></div>
	</div>
</div><!-- /#dialog_wrap -->
</body>
</html>

