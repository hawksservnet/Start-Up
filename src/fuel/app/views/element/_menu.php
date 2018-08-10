<div id="start_goal_wrap">
	<a onClick='history.back();'><</a>
	<ul class="clearfix">
		<li>
			<input type="text" class="text gray" name="start" value="現在地">
		</li>
		<li>
			<input type="text" class="text gray" name="goal" value="東京タワー">
		</li>
	</ul>
</div><!-- /.start_goal_wrap-->
<?php if($orders):?>
<div id="top_menu">
	<ul>
		<!-- <li class="status">
			<span>ご利用中</span>
		</li> -->
		<li class="fee">
			<span>予約・利用状況確認</span>
			<div id="fee_wrap">
				<div class="reserve_carousel_wrap">
					<div class="reserve_carousel_inner">
						<ul class="slide_list">
							<?php $orders = array_reverse($orders); ?>
							<?php foreach( $orders as $order ) : ?>
								<?php if($order->status==Model_Order::status_reserve): //予約中?>
								<li class="reserve">
									<div class="title">
										<a href="<?php echo Uri::create("company/detail/".$order->start_port->company_id); ?>">
											<span class="image_wrap">
												<?php if($order->start_port->company->photo_path): ?>
												<span style="background-image: url(<?php echo $order->start_port->company->photo_path; ?>);"></span>
												<?php else: ?>
												<span class="no_image" style="background-image: url(<?php echo Asset::get_file('common/no_image.png', 'img'); ?>);background-size: auto 120%!important;"></span>
												<?php endif; ?>
											</span>
											<span class="text">
												<?php echo $order->start_port->company->short_name ?><br>
												<?php echo $order->start_port->name ?>
											</span>
										</a>
									</div>
									<div class="content">
										<div class="reserve_text">
											予約の有効時間　
											<?php if(1800+$order->created_at-time()>0): ?>
												<span class='timer' data-end="<?= 1800+$order->created_at ?>"></span>
											<?php else: ?>
												期限切れ
											<?php endif; ?>
										</div>
										<div>
											<dl class="clearfix">
												<dt>車両番号</dt>
												<dd><?php echo $order->bike->code ?></dd>
											</dl>
											<dl>
												<dt>暗証番号</dt>
												<dd><strong><?php echo $order->pin_code ?></strong></dd>
											</dl>
										</div>
									</div>
								</li>
								<?php elseif($order->status==Model_Order::status_now_rental): //レンタル中?>
								<li class="rental">
									<div class="title">
										<div>
											<span class="image_wrap">
												<img src="<?php echo Asset::get_file('common/icon/icon_bicycle.svg', 'img'); ?>">
											</span>
											<span class="text">
												<?php echo $order->bike->code ?>
											</span>
										</div>
									</div>
									<div class="content">
										<dl>
											<dt>暗証番号</dt>
											<dd><?php echo $order->pin_code ?></dd>
										</dl>
										<div class="time_price_wrap clearfix">
											<dl>
												<dt>利用時間</dt>
												<dd><?php echo $order->getRentalTimeFormat() ?></dd>
											</dl>
											<dl>
												<dt>現在の利用料金</dt>
												<dd>￥<?= number_format($order->getTotalPrice()); ?></dd>
											</dl>
										</div>
									</div>
								</li><!-- /list -->
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
						<span class="ctr prev"></span>
						<span class="ctr next"></span>
						<div class="pager"></div>
					</div>
					<div class="btn black center"><a href="<?php echo Uri::create("mypage/reserve") ?>"><span>予約・ご利用の一覧へ</span></a></div>
				</div>
			</div>
		</li>
	</ul>
</div><!-- /.top_menu -->
<?php endif; ?>

<!-- <div class="guide_wrap">
	<div class="mark">
		<span class="icon"><img src="assets/img/common/guide/icon_guide_right.svg"></span>
		<span class="text">500m</span>
	</div>
	<p class="text">
		<span class="main">若宮大通久屋</span>
		<span class="sub">久屋大通に入る</span>
	</p>
</div> --><!-- /.guide_wrap -->

<div id="top_bar">
	<form action="" class="destination">
		<!-- <input type="text" class="text" name="destination" placeholder="目的地入力"> -->
		<ul class="tab_list status_list clearfix">
			<li class="loan"><span>貸出可能</span></li>
			<li class="parking"><span>返却可能</span></li>
			<li class="charge"><span>充電可能</span></li>
		</ul>
	</form>
</div><!-- /.top_bar -->

<aside id="side_menu">
	<!-- <span class="trigger"><span></span></span> -->
	<div class="side_list">
		<div class="close_btn"><span></span></div>
		<!-----------最近の履歴---------->
		<div id="peripheral_wrap" class="side_list_inner show">
			<form action="index.php">
				<div class="search_input_wrap">
					<input id="port_search" type="text" class="clear text" name="port_search" placeholder="検索">
				</div>
				<div class="search_list_wrap clearfix">
					<ul>
						<li>
							<a href="#">
								<strong>新橋第3ステーション</strong>
								東京都港区 東新橋1-9-1東京汐留ビルディング
							</a>
						</li>
						<li>
							<a href="#">
								<strong>新橋第3ステーション</strong>
								東京都港区 東新橋1-9-1東京汐留ビルディング
							</a>
						</li>
						<li>
							<a href="#">
								<strong>新橋第3ステーション</strong>
								東京都港区 東新橋1-9-1東京汐留ビルディング
							</a>
						</li>
						<li class="history_wrap">
							<span>最近の履歴をもっと見る</span>
						</li>
					</ul>
				</div><!-- /.search_list_wrap  -->
				<div class="search_btn">
					<div class="btn black">
						<a href="#" data-transition="network"><span>周辺のネットワーク企業</span></a>
					</div>
					<div class="btn black">
						<a href="#" data-transition="area"><span>エリアから探す</span></a>
					</div>
				</div>
			</form>
		</div><!-- /.side_list_inner -->
		<!-----------エリア画面---------->
		<div id="area_wrap" class="side_list_inner next">
			<form action="index.php">
				<div class="search_input_wrap">
					<input id="port_search" type="text" class="clear text" name="port_search" placeholder="エリア">
				</div>
				<div class="search_list_wrap clearfix">
					<ul>
						<li class="dd_list_wrap">
							<dl>
								<dt>北海道・東北</dt>
								<dd>
									<ul class="link_list_wrap">
										<li>北海道</li>
										<li>青森</li>
										<li>秋田</li>
										<li>岩手</li>
										<li>山形</li>
										<li>福島</li>
										<li>宮城</li>
										<li>新潟</li>
									</ul>
								</dd>
							</dl>
						</li>
						<li class="dd_list_wrap">
							<dl>
								<dt>関東</dt>
								<dd>
									<ul class="link_list_wrap">
										<li>東京</li>
										<li>千葉</li>
										<li>神奈川</li>
									</ul>
								</dd>
							</dl>
						</li>
					</ul>
				</div><!-- /.search_list_wrap  -->
				<div class="search_btn">
					<div class="btn black">
						<a href="#" data-transition="back"><span>戻る</span></a>
					</div>
				</div>
			</form>
		</div><!-- /.side_list_inner -->
		<!-----------エリア画面詳細---------->
		<div id="area_detail_wrap" class="side_list_inner next">
			<form action="index.php">
				<div class="search_input_wrap">
					<input id="port_search" type="text" class="clear text" name="port_search" placeholder="エリア">
				</div>
				<div class="search_list_wrap link_list_wrap clearfix">
					<ul>
						<li>
							<a href="#">
								銀座・新橋・有楽町
							</a>
						</li>
						<li>
							<a href="#">
								お台場・浅草
							</a>
						</li>
						<li>
							<a href="#">
								六本木・中目黒
							</a>
						</li>
						<li>
							<a href="#">
								渋谷・新宿
							</a>
						</li>
						<li>
							<a href="#">
								新宿・品川
							</a>
						</li>
					</ul>
				</div><!-- /.search_list_wrap  -->
				<div class="search_btn">
					<div class="btn black">
						<a href="#" data-transition="back"><span>戻る</span></a>
					</div>
				</div>
			</form>
		</div><!-- /.side_list_inner -->
		<!-----------ネットワーク企業---------->
		<div id="network_company_wrap" class="side_list_inner next">
			<form action="index.php">
				<div class="search_input_wrap">
					<input id="port_search" type="text" class="clear text" name="port_search" placeholder="ネットワーク企業">
				</div>
				<div class="search_list_wrap clearfix">
					<ul>
						<li>
							<label class="checkbox">
								<input type="checkbox" name="trader" class="trader" value="水戸 スマート">
								<span class="text">水戸 スマート</span>
							</label>
						</li>
						<li>
							<label class="checkbox">
								<input type="checkbox" name="trader" class="trader" value="シーサイドバイク">
								<span class="text">シーサイドバイク</span>
							</label>
						</li>
						<li>
							<label class="checkbox">
								<input type="checkbox" name="trader" class="trader" value="RTSグループ">
								<span class="text">RTSグループ</span>
							</label>
						</li>
						<li>
							<label class="checkbox">
								<input type="checkbox" name="trader" class="trader" value="シェアリングサービス">
								<span class="text">シェアリングサービス</span>
							</label>
						</li>
						<li>
							<label class="checkbox">
								<input type="checkbox" name="trader" class="trader" value="シェアリングサービス2">
								<span class="text">シェアリングサービス2</span>
							</label>
						</li>
						<li>
							<label class="checkbox">
								<input type="checkbox" name="trader" class="trader" value="NPC">
								<span class="text">NPC</span>
							</label>
						</li>
					</ul>
				</div><!-- /.search_list_wrap  -->
				<div class="search_btn">
					<div class="btn black">
						<button><span>検索</span></button>
					</div>
					<div class="btn black">
						<a href="#" data-transition="peripheral"><span>戻る</span></a>
					</div>
				</div>
			</form>
		</div><!-- /.side_list_inner -->
	</div>
</aside><!-- /.side_menu -->

<?php if(!Auth::check()): ?>
<div id="registration_btn" class="bg_black_wrap">
	<div id="order_submit_btn" class="btn green center">
		<a href="<?php echo Uri::create("users/add_account"); ?>">
			<span>会員登録はこちら</span>
		</a>
	</div>
</div>
<?php endif; ?>

<?php if($page_id == "ride"):?>
<div id="bottom_menu" class="ride">
<?php else: ?>
<div id="bottom_menu">
<?php endif; ?>
	<?php if($page_id == "touring"):?>
	<ul id="icon_menu_wrap">
		<li class="call"></li>
		<li class="gesture"></li>
		<li class="link"><a href="link_list.php"></a></li>
		<li class="destination"></li>
	</ul>
	<?php endif; ?>
	<span id="here_btn"></span>
	<?php if($page_id == "ride"):?>
	<!-- <div class="bg_black_wrap fixed_bottom">
		<div class="btn black touring center"><a href="link_choice_list.php"><span>ツーリングモード</span></a></div>
	</div> -->
	<?php endif; ?>
	<!-- <div id="spot_wrap">
		<span class="trigger">現在地周辺のスポット</span>
	</div> -->
	<div class="spot_list_wrap">
		<div class="bg_black_wrap category_list">
			<ul class="clearfix">
				<li><span data-category="駅">駅</span></li>
				<li><span data-category="cafe">カフェ</span></li>
				<li><span data-category="convenience">コンビニ</span></li>
				<li><span data-category="restaurant">レストラン</span></li>
				<li><span data-category="atm">ATM</span></li>
			</ul>
		</div>
		<div class="shop_list">
			<ul>
				<li class="cafe">
					<span class="icon">
						<span style="background-image:url(assets/img/common/img_store.png);"></span>
					</span>
					<p class="text">
						<span class="main">スポット名01</span>
						<span class="sub">カフェ / 000m</span>
					</p>
				</li>
				<li class="convenience">
					<span class="icon">
						<span style="background-image:url(assets/img/common/img_store.png);"></span>
					</span>
					<p class="text">
						<span class="main">スポット名01</span>
						<span class="sub">コンビニ / 000m</span>
					</p>
				</li>
				<li class="restaurant">
					<span class="icon">
						<span style="background-image:url(assets/img/common/img_store.png);"></span>
					</span>
					<p class="text">
						<span class="main">スポット名01</span>
						<span class="sub">レストラン / 000m</span>
					</p>
				</li>
				<li class="atm">
					<span class="icon">
						<span style="background-image:url(assets/img/common/img_store.png);"></span>
					</span>
					<p class="text">
						<span class="main">スポット名01</span>
						<span class="sub">ATM / 000m</span>
					</p>
				</li>
				<li class="cafe">
					<span class="icon">
						<span style="background-image:url(assets/img/common/img_store.png);"></span>
					</span>
					<p class="text">
						<span class="main">スポット名01</span>
						<span class="sub">カフェ / 000m</span>
					</p>
				</li>
				<li class="convenience">
					<span class="icon">
						<span style="background-image:url(assets/img/common/img_store.png);"></span>
					</span>
					<p class="text">
						<span class="main">スポット名01</span>
						<span class="sub">コンビニ / 000m</span>
					</p>
				</li>
				<li class="restaurant">
					<span class="icon">
						<span style="background-image:url(assets/img/common/img_store.png);"></span>
					</span>
					<p class="text">
						<span class="main">スポット名01</span>
						<span class="sub">レストラン / 000m</span>
					</p>
				</li>
				<li class="atm">
					<span class="icon">
						<span style="background-image:url(assets/img/common/img_store.png);"></span>
					</span>
					<p class="text">
						<span class="main">スポット名01</span>
						<span class="sub">ATM / 000m</span>
					</p>
				</li>
				<li class="cafe">
					<span class="icon">
						<span style="background-image:url(assets/img/common/img_store.png);"></span>
					</span>
					<p class="text">
						<span class="main">スポット名01</span>
						<span class="sub">カフェ / 000m</span>
					</p>
				</li>
				<li class="convenience">
					<span class="icon">
						<span style="background-image:url(assets/img/common/img_store.png);"></span>
					</span>
					<p class="text">
						<span class="main">スポット名01</span>
						<span class="sub">コンビニ / 000m</span>
					</p>
				</li>
				<li class="restaurant">
					<span class="icon">
						<span style="background-image:url(assets/img/common/img_store.png);"></span>
					</span>
					<p class="text">
						<span class="main">スポット名01</span>
						<span class="sub">レストラン / 000m</span>
					</p>
				</li>
				<li class="atm">
					<span class="icon">
						<span style="background-image:url(assets/img/common/img_store.png);"></span>
					</span>
					<p class="text">
						<span class="main">スポット名01</span>
						<span class="sub">ATM / 000m</span>
					</p>
				</li>
			</ul>
		</div>
	</div>
</div><!-- /.bottom_menu -->
