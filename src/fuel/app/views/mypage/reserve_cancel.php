
<div id="list_wrap">

	<div class="bg_gray_wrap">
		<ul class="tab_list two_colum clearfix">
			<li><a href="reserve.php">予約・利用中</a></li>
			<li class="active"><a href="reserve_cancel.php">キャンセル・返却済み</a></li>
		</ul>
	</div>
	<p class="guide_link"><a href="<?php echo Uri::create("tutorial?start#start01"); ?>">ご予約・ご利用状況について</a></p>
	<div class="used_area">
		<div class="order_list_wrap bg_gray_wrap">
			<p class="status cancel">キャンセル済み</p>
			<?php if (empty($cancel_orders)): ?>
			<p class="no_record_text">キャンセル済みの自転車はありません</p>
			<?php else: ?>
			<ul class="order_list">
				<?php foreach( $cancel_orders as $order ) : ?>
					<?= render('mypage/_cancel',['order'=>$order]) ?>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>
		<div class="order_list_wrap bg_gray_wrap">
			<p class="status return">返却済み</p>
			<?php if (empty($return_orders)): ?>
			<p class="no_record_text">返却済みの自転車はありません</p>
			<?php else: ?>
			<ul class="order_list">
				<?php foreach( $return_orders as $order ) : ?>
					<?= render('mypage/_return',['order'=>$order]) ?>
						<!-- <div class="total_under clearfix">
							<dl class="total">
								<dt>合計</dt>
								<dd>¥<?php echo number_format($grand_total); ?>円</dd>
							</dl>
							<dl class="pay">
								<dt>支払</dt>
								<dd>クレジット</dd>
							</dl>
						</div> -->
					</li><!-- list -->
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>
	</div>
</div>
