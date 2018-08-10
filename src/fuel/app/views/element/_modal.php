			<div class="modal_wrap">
				<div class="modal_inner">
					<form action="" id="">
						<div class="modal_top">
						</div>
						<div class="modal_middle">
						</div>
						<div class="modal_bottom">
						</div>
					</form>
				</div>
			</div><!--アラート-->

			<div class="image_modal_wrap">
				<div class="modal_inner">
					<p class="sub_title">やまだたろう</p>
					<div class="account_image_wrap">
						<span style="background-image:url();"></span>
					</div>
				</div>
			</div><!--写真-->

			<div class="destination_modal_wrap">
				<div class="modal_inner">
					<form action="" class="destination">
						<?php echo Form::hidden('page_id', $page_id); ?>
						<p class="text">目的地を入力してください</p>
						<input type="text" class="text" name="destination" placeholder="目的地入力">
					</form>
				</div>
				<span class="close_btn"><img src="assets/img/common/icon/close_btn_black.svg"></span>
			</div>
			<div class="add_destination_modal_wrap">
				<div class="modal_inner">
					<form action="http://maps.google.com/maps?q=35.658581,139.745433" class="add_destination">
						<?php if($page_id == "ride"): //ライド?>
<!-- 						<div class="modal_bottom">
							<button><span>目的地に設定</span></button>
						</div>
 -->						<?php else: //ツーリング?>
<!-- 						<div class="modal_bottom">
							<button><span>目的地に設定し共有</span></button>
						</div>
 -->						<?php endif; ?>
					</form>
				</div>
			</div><!--目的地-->

			<div class="stopover_modal_wrap">
				<div class="modal_inner">
					<form action="route.php" class="add_stopover">
						<input type="hidden" name="route" value="stopover">
						<div class="modal_top">
							<a href="destination.php?stopover" data-image="assets/img/common/img_tokyotower.jpg" data-name="浅草寺" data-distance="5km" data-time="40min">
								<span class="image">
									<span style="background-image:url(assets/img/common/img_tokyotower.jpg);"></span>
								</span>
								<span class="text">
									<span class="name">浅草寺</span>
									<span class="number">
										<span class="distance">5km</span>
										<span class="time">40min</span>
									</span>
								</span>
							</a>
						</div>
						<div class="modal_bottom">
							<button><span>経由地に設定</span></button>
						</div>
					</form>
				</div>
			</div><!--経由地-->

			<div class="stopover_remove_modal_wrap">
				<div class="modal_inner">
					<form action="route.php" class="remove_stopover">
						<input type="hidden" name="route" value="">
						<div class="modal_top">
							<a href="destination.php?stopover" data-image="assets/img/common/img_tokyotower.jpg" data-name="浅草寺" data-distance="5km" data-time="40min">
								<span class="image">
									<span style="background-image:url(assets/img/common/img_tokyotower.jpg);"></span>
								</span>
								<span class="text">
									<span class="name">浅草寺</span>
									<span class="number">
										<span class="distance">5km</span>
										<span class="time">40min</span>
									</span>
								</span>
							</a>
						</div>
						<div class="modal_bottom">
							<button><span>経由地を削除</span></button>
						</div>
					</form>
				</div>
			</div><!--経由地削除-->

			<div class="routing_assistance_wrap">
				<form action="" class="routing_assistance">
					<div class="modal_inner">
						<span class="text">
							<span class="name">東京タワー</span>
							<span class="number">
								<strong>5</strong>km <strong>40</strong>min
							</span>
						</span>
						<span class="icon">
							<button></button>
						</span>
					</div>
				</form>
			</div><!--目的地案内-->

			<div class="modal_wrap pin_modal_wrap">
				<div class="modal_inner">
					<p class="title">ステーションの種類</p>
					<ul>
						<li>
							<span class="pin">
								<?php echo Asset::img('map/icon_port_modal.png'); ?>
							</span>
							<dl>
								<dt>貸出・返却ステーション</dt>
								<dd>自転車の貸出・返却が可能なステーション</dd>
							</dl>
						</li>
						<li>
							<span class="pin">
								<?php echo Asset::img('map/icon_battery_modal.png'); ?>
							</span>
							<dl>
								<dt>充電ステーション</dt>
								<dd>電動アシスト自転車の充電が可能なステーション</dd>
							</dl>
						</li>
						<li>
							<span class="pin">
								<?php echo Asset::img('map/icon_port_battery_modal.png'); ?>
							</span>
							<dl>
								<dt>充電・貸出・返却ステーション</dt>
								<dd>電動アシスト自転車の充電と、自転車の貸出・返却が可能なステーション</dd>
							</dl>
						</li>
					</ul>
					<span class="close_btn"></span>
				</div>
			</div><!--ピンの説明-->

			<div class="modal_wrap logon_modal_wrap">
				<div class="modal_inner">
					<form action="" id="">
						<div class="modal_top">
						</div>
						<div class="modal_bottom">
						</div>
					</form>
				</div>
			</div><!--アラート-->
