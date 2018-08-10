<?php if($page_id != "splash"):?>
<?php if($page_id == "account" || $page_id == "card_scan"): ?>
	<header id="header">
		<div class="link left"><a onClick='history.back();'><?php echo Asset::img('common/icon/icon_arrow_left_black.svg'); ?></a></div>
		<h1 id="logo"><?php echo Asset::img('common/logo.svg'); ?></h1>
	</header>

<?php else: ?>
	<header id="header">

		<!--戻るボタン-->
		<?php if($back_link == "back"): ?>
		<div class="link left"><a onClick="history.back();"><?php echo Asset::img('common/icon/icon_arrow_left_black.svg'); ?></a></div>
		<?php elseif(!empty($back_link)): ?>
		<div class="link left"><a href="<?php echo $back_link; ?>"><?php echo Asset::img('common/icon/icon_arrow_left_black.svg'); ?></a></div>
		<?php endif; ?>

		<!--タイトル-->
		<?php if($is_pc): ?>
			<h1 id="logo"><a href="https://hellocycling.jp"><?php echo Asset::img('common/logo.svg'); ?></a></h1>
		<?php else: ?>
			<h1 id="logo"><a href="<?php echo Uri::create("top"); ?>"><?php echo Asset::img('common/logo.svg'); ?></a></h1>
		<?php endif; ?>
		<!--ログイン、マイページボタン-->
		<div class="menu right"><a href=""><?php echo Asset::img('common/icon/icon_headmenu.png'); ?></a></div>
		<?php if(Auth::check()): ?>
		<div class="account right ua-sp"><a href='<?php echo Uri::create("mypage") ?>'><?php echo Asset::img('common/icon/profile_black.svg'); ?></a></div>
		<?php else: ?>
		<div class="account right ua-sp"><a href='<?php echo Uri::create("login") ?>'><?php echo Asset::img('common/icon/icon_login.svg'); ?></a></div>
		<?php endif; ?>
	</header>

	<aside id="g_menu" class="">
		<div class="bg"></div>
		<div class="side_list">
			<ul>
				<?php if(Auth::check()): ?>
				<li class="user">
					<?php if(isset($user)): ?>
					<div class="name"><?php echo $user->name ?>様</div>
					<?php elseif(isset($current_user)): ?>
					<div class="name"><?php echo $current_user->name ?>様</div>
					<?php endif; ?>
				</li>
				<li class="menu_link link01 ua-sp"><a href="<?php echo Uri::create("mypage") ?>">マイページ</a></li>
				<li class="menu_link link02 ua-sp"><a href="<?php echo Uri::create("mypage/reserve") ?>">予約・利用履歴</a></li>
				<li class="menu_link link03"><a href="<?php echo Uri::create("top") ?>">マップ</a></li>
				<li class="menu_link link09"><a href="<?php echo Uri::create("tutorial?add#add01") ?>">会員登録について</a></li>
				<li class="menu_link link10"><a href="<?php echo Uri::create("tutorial?start#start01") ?>">利用開始時の手順</a></li>
				<li class="menu_link link11"><a href="<?php echo Uri::create("tutorial?return#return01") ?>">返却方法</a></li>
				<li class="menu_link link12"><a href="<?php echo Uri::create("tutorial?ic#ic01") ?>">ICカード登録</a></li>
				<li class="menu_link link04"><a href="<?php echo Uri::create("login/logout") ?>">ログアウト</a></li>
				<?php else: ?>
				<li class="menu_link link05 ua-sp"><a href="<?php echo Uri::create("login") ?>">ログイン</a></li>
				<li class="menu_link link09"><a href="<?php echo Uri::create("tutorial?add#add01") ?>">会員登録について</a></li>
				<li class="menu_link link10"><a href="<?php echo Uri::create("tutorial?start#start01") ?>">利用開始時の手順</a></li>
				<li class="menu_link link11"><a href="<?php echo Uri::create("tutorial?return#return01") ?>">返却方法</a></li>
				<li class="menu_link link12"><a href="<?php echo Uri::create("tutorial?ic#ic01") ?>">ICカード登録</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</aside>


<?php endif; ?>
<?php endif; ?>
