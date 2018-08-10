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

				<div id="top_menu">
					<ul>
						<li class="status">
							<span>ご利用中</span>
						</li>
						<li class="reserve">
							<span>ご予約確認</span>
							<div id="reserve_wrap">
								<div class="reserve_carousel_wrap">
									<div class="reserve_carousel_inner">
										<ul class="slide_list">
											<li>
												<ul>
													<li>
														<dl>
															<dt>ステーション</dt>
															<dd>
																<span>
																SB サイクル
																新橋第2ステーション
																</span>
																<a href="http://maps.google.com/maps?q=35.684602,139.777003">ナビ</a>
															</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>自転車情報</dt>
															<dd>SB-DA001</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>PINコード</dt>
															<dd>1234</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>プラン</dt>
															<dd>300/1h</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>決済方法</dt>
															<dd>クレジットカード決済</dd>
														</dl>
													</li>
													<li class="btn_wrap">
														<div class="btn black cancel center">
															<a href="">予約をキャンセルする</a>
														</div>
													</li>
												</ul>
											</li><!-- /list -->
											<li>
												<ul>
													<li>
														<dl>
															<dt>ステーション</dt>
															<dd>
																<span>
																SB サイクル
																新橋第2ステーション
																</span>
																<a href="http://maps.google.com/maps?q=35.684602,139.777003">ナビ</a>
															</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>自転車情報</dt>
															<dd>SB-DA001</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>PINコード</dt>
															<dd>1234</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>プラン</dt>
															<dd>300/1h</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>決済方法</dt>
															<dd>クレジットカード決済</dd>
														</dl>
													</li>
													<li class="btn_wrap">
														<div class="btn black cancel center">
															<a href="">予約をキャンセルする</a>
														</div>
													</li>
												</ul>
											</li><!-- /list -->
											<li>
												<ul>
													<li>
														<dl>
															<dt>ステーション</dt>
															<dd>
																<span>
																SB サイクル
																新橋第2ステーション
																</span>
																<a href="http://maps.google.com/maps?q=35.684602,139.777003">ナビ</a>
															</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>自転車情報</dt>
															<dd>SB-DA001</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>PINコード</dt>
															<dd>1234</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>プラン</dt>
															<dd>300/1h</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>決済方法</dt>
															<dd>クレジットカード決済</dd>
														</dl>
													</li>
													<li class="btn_wrap">
														<div class="btn black cancel center">
															<a href="">予約をキャンセルする</a>
														</div>
													</li>
												</ul>
											</li><!-- /list -->
											<li>
												<ul>
													<li>
														<dl>
															<dt>ステーション</dt>
															<dd>
																<span>
																SB サイクル
																新橋第2ステーション
																</span>
																<a href="http://maps.google.com/maps?q=35.684602,139.777003">ナビ</a>
															</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>自転車情報</dt>
															<dd>SB-DA001</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>PINコード</dt>
															<dd>1234</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>プラン</dt>
															<dd>300/1h</dd>
														</dl>
													</li>
													<li>
														<dl>
															<dt>決済方法</dt>
															<dd>クレジットカード決済</dd>
														</dl>
													</li>
													<li class="btn_wrap">
														<div class="btn black cancel center">
															<a href="">予約をキャンセルする</a>
														</div>
													</li>
												</ul>
											</li><!-- /list -->
										</ul>
										<span class="ctr prev"></span>
										<span class="ctr next"></span>
										<div class="pager"></div>
									</div>
								</div>
								<div class="bg_black_wrap">
									<div class="btn black rent center"><a href="port.php"><span>更に自転車を借りる</span></a></div>
								</div>
							</div>
						</li>
					</ul>
				</div><!-- /.top_menu -->

				<?php if($page_id != "reserve_open"):?>
				<?php if($page_id != "reserve_map"):?>
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
						<input type="text" class="text" name="destination" placeholder="目的地入力">
						<ul class="tab_list status_list clearfix">
							<li class="loan"><span>貸出可能</span></li>
							<li class="parking"><span>返却可能</span></li>
						</ul>
					</form>
				</div><!-- /.top_bar -->
				<?php endif; ?>

				<?php if($page_id != "reserve_map"):?>
				<aside id="side_menu">
					<span class="trigger"><span></span></span>
					<div class="side_list">
						<form>
							<div class="trader_search_wrap">
								<input id="trader_search" type="text" class="clear text" name="trader_search" placeholder="Search">
							</div>
							<ul>
								<li>
									<label class="checkbox">
										<input type="checkbox" name="trader" class="trader" value="SBサイクリング">
										<span class="icon">
											<span style="background-image: url(assets/img/trader/icon_softbank.png)"></span>
										</span>
										<span class="text">SBサイクリング</span>
									</label>
								</li>
								<li>
									<label class="checkbox">
										<input type="checkbox" name="trader" class="trader" value="ダミーダミー">
										<span class="icon">
											<span style="background-image: url(assets/img/trader/icon_sepika.png)"></span>
										</span>
										<span class="text">ダミーダミー</span>
									</label>
								</li>
								<li>
									<label class="checkbox">
										<input type="checkbox" name="trader" class="trader" value="ダミーダミー">
										<span class="icon">
											<span style="background-image: url(assets/img/trader/icon_horsepower.png)"></span>
										</span>
										<span class="text">ダミーダミー</span>
									</label>
								</li>
								<li>
									<label class="checkbox">
										<input type="checkbox" name="trader" class="trader" value="ダミーダミー">
										<span class="icon">
											<span style="background-image: url(assets/img/trader/icon_lionlink.png)"></span>
										</span>
										<span class="text">ダミーダミー</span>
									</label>
								</li>
							</ul>
							<div id="search_btn" class="btn black">
								<button><span>絞り込む</span></button>
							</div>
						</form>
					</div>
				</aside><!-- /.side_menu -->
				<?php endif; ?>

				<?php if($page_id == "ride" || $page_id == "reserve"):?>
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
					<?php if($page_id == "ride" || $page_id == "reserve"):?>
					<!-- <div class="bg_black_wrap fixed_bottom">
						<div class="btn black touring center"><a href="link_choice_list.php"><span>ツーリングモード</span></a></div>
					</div> -->
					<?php elseif($page_id == "reserve_map"):?>
					<div class="bg_black_wrap fixed_bottom">
						<div class="btn black route center"><a href="http://maps.google.com/maps?q=35.684602,139.777003"><span>経路案内</span></a></div>
					</div>
					<?php endif; ?>
					<?php if($page_id != "reserve_map"):?>
					<div id="spot_wrap">
						<span class="trigger">現在地周辺のスポット</span>
					</div>
					<div class="spot_list_wrap">
						<div class="bg_black_wrap category_list">
							<ul class="clearfix">
								<li><a data-category="駅">駅</a></li>
								<li class="active"><a data-category="カフェ">カフェ</a></li>
								<li><a data-category="コンビニ">コンビニ</a></li>
								<li><a data-category="レストラン">レストラン</a></li>
								<li><a data-category="ATM">ATM</a></li>
							</ul>
						</div>
						<div class="shop_list">
							<ul>
								<li>
									<span class="icon">
										<span style="background-image:url(assets/img/common/img_store.png);"></span>
									</span>
									<p class="text">
										<span class="main">スポット名01</span>
										<span class="sub">カテゴリA / 000m</span>
									</p>
								</li>
								<li>
									<span class="icon">
										<span style="background-image:url(assets/img/common/img_store.png);"></span>
									</span>
									<p class="text">
										<span class="main">スポット名01</span>
										<span class="sub">カテゴリA / 000m</span>
									</p>
								</li>
								<li>
									<span class="icon">
										<span style="background-image:url(assets/img/common/img_store.png);"></span>
									</span>
									<p class="text">
										<span class="main">スポット名01</span>
										<span class="sub">カテゴリA / 000m</span>
									</p>
								</li>
								<li>
									<span class="icon">
										<span style="background-image:url(assets/img/common/img_store.png);"></span>
									</span>
									<p class="text">
										<span class="main">スポット名01</span>
										<span class="sub">カテゴリA / 000m</span>
									</p>
								</li>
								<li>
									<span class="icon">
										<span style="background-image:url(assets/img/common/img_store.png);"></span>
									</span>
									<p class="text">
										<span class="main">スポット名01</span>
										<span class="sub">カテゴリA / 000m</span>
									</p>
								</li>
								<li>
									<span class="icon">
										<span style="background-image:url(assets/img/common/img_store.png);"></span>
									</span>
									<p class="text">
										<span class="main">スポット名01</span>
										<span class="sub">カテゴリA / 000m</span>
									</p>
								</li>
							</ul>
						</div>
					</div>
					<?php endif; ?>
				</div><!-- /.bottom_menu -->
				<?php endif; ?>
