<?php if($page_id == "port" || $page_id == "order" || $page_id == "order_confirm"): ?>
<?php if($page_id == "port"): ?>
<div id="port_menu_wrap" class="bg_black_wrap fixed_bottom">
<?php elseif($page_id == "order" || $page_id == "order_confirm"): ?>
<div id="port_menu_wrap" class="bg_black_wrap fixed_bottom min">
<?php endif; ?>
	<?php if($page_id == "port"): ?>
	<div class="menu_wrap">
		<?php echo Form::hidden('port_id', $port->id) ?>
		<!-- <ul>
			<li>
				<a href="spot.php">
					<?php echo Asset::img('common/icon/icon_near_spot.svg'); ?>
					<span>周辺スポット</span>
				</a>
			</li> -->
			<!-- <li>
				<a href="route_list.php">
					<img src="assets/img/common/icon/icon_recommend_route.svg">
					<span>おすすめルート</span>
				</a>
			</li>
		</ul> -->
		<div id="order_submit_btn" class="btn green center disabled">
			<button>
				<span>この<span class="num">0</span>台の自転車を借りる</span>
			</button>
		</div>
		<!-- <ul>
			<li class="btn black">
				<a href="http://maps.google.com/maps?q=<?php echo $port->lat ?>,<?php echo $port->lon ?>">
					<?php echo Asset::img('common/icon/icon_route.svg'); ?>
					<span>ナビ</span>
				</a>
			</li>
			<li class="btn black">
				<a href="<?php echo Uri::create("company/detail/".$port->company_id); ?>">
					<?php echo Asset::img('common/icon/icon_company.svg'); ?>
					<span class="mini">ステーション運営企業情報</span>
				</a>
			</li>
		</ul> -->
	</div>
	<?php endif; ?>
	<?php if($page_id == "order"): ?>
		<?php if(Auth::check()): ?>
		<div class="submit_wrap">
			<div class="btn green center">
				<button>
					<span>予約確認画面へ</span>
				</button>
			</div>
		</div>
		<?php else: ?>
		<div class="submit_wrap">
			<div class="btn green center">
				<a href="login.php?login_alert">
					<span>予約確認画面へ</span>
				</a>
			</div>
		</div>
		<?php endif; ?>
	<?php elseif($page_id == "order_confirm"): ?>
	<div class="submit_wrap">
		<div class="btn green center">
			<?php echo Form::hidden("complete_order", "1") ?>
			<button>
				<span>この内容で予約する</span>
			</button>
		</div>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>
<?php if($page_id == "order_complete"): ?>
<div id="confirm_menu_wrap" class="bg_black_wrap fixed_bottom">
	<form action="">
		<div class="btn black home center">
			<a href="<?= Uri::create('top'); ?>">
				<span>マップへ戻る</span>
			</a>
		</div>
		<!-- <div class="btn black cancel center">
			<a href="">
				<span>ご予約のキャンセル</span>
			</a>
		</div> -->
	</form>
</div>
<?php endif; ?>
