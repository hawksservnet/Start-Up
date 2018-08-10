
<div id="list_wrap">

	<div class="bg_gray_wrap">
		<ul class="tab_list two_colum clearfix">
			<li class="active"><a href="<?= Uri::create('mypage/reserve'); ?>">予約・利用中</a></li>
			<li><a href="<?= Uri::create('mypage/reserve_cancel'); ?>">キャンセル・返却済み</a></li>
		</ul>
	</div>
	<p class="guide_link"><a href="<?php echo Uri::create("tutorial?start#start01"); ?>">ご予約・ご利用状況について</a></p>
	<div class="using_area">
		<h4 class="sub_title top_title">予約済みの自転車</h4>
		<?php if (empty($reserve_orders)): ?>
		<p class="no_record_text">現在予約済みの自転車はありません</p>
		<?php else: ?>
		<div class="order_list_wrap bg_gray_wrap">
			<ul class="order_list">
				<?php foreach( $reserve_orders as $order ) : ?>
					<?= render('mypage/_reserve',['order'=>$order]) ?>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
		<h4 class="sub_title second_title">ご利用中の自転車</h4>
		<?php if (empty($rental_orders)): ?>
		<p class="no_record_text border">現在ご利用中の自転車はありません</p>
		<?php else: ?>
		<div class="order_list_wrap bg_gray_wrap">
			<ul class="order_list">
				<?php foreach( $rental_orders as $order ) : ?>
					<?= render('mypage/_rental',['order'=>$order]) ?>
						<!-- <div class="total_under clearfix">
							<dl class="total">
								<dt>合計</dt>
								<dd>1000</dd>
							</dl>
							<dl class="pay">
								<dt>支払</dt>
								<dd>1000</dd>
							</dl>
						</div> -->
					</li><!-- list -->
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
		<div class="use_guide inner">
			<h4>予約・ご利用状況について</h4>
			<div class="use_guide-text">
				<dl>
					<dt>予約済み</dt>
					<dd>
						自転車をご予約いただいた段階です。<span>30分以内に</span>
						スマートロックを開錠してご利用を開始してください。
						<span>※30分を過ぎると自動でキャンセルされます。</span>
					</dd>
				</dl>
				<dl>
					<dt>ご利用中</dt>
					<dd>
						自転車の利用が開始されている段階です。<br>
						利用時間に合わせて料金が追加されます。
						<a href="<?php echo Uri::create("tutorial?start#start01-03"); ?>">> 詳しい内容はこちら</a>
					</dd>
				</dl>
			</div>
		</div>
	</div>
</div>
