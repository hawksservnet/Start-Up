<div id="list_wrap">

	<div class="bg_gray_wrap">
		<ul class="tab_list clearfix">
			<li class="active"><a href="<?php echo Uri::create('mypage/history') ?>">ご利用履歴</a></li>
			<li><a href="<?php echo Uri::create('mypage/reserve') ?>">予約一覧</a></li>
		</ul>
	</div>
	<div id="sort_wrap">
		<?php echo Form::open(array("method"=>"GET")) ?>
			<ul>
				<li>
					<?php echo Form::input('id', Input::get('id'), array("type"=>"text", "class"=>"text", "placeholder"=>"予約IDを入力してください") ) ?>
				</li>
				<li>
					<?= Form::input('start_time' ,Input::get('start_time'),array('class'=>'text white','id' => 'date_start', 'placeholder'=>'利用日')); ?>
				</li>
			</ul>
			<div class="btn green"><button>検索する</button></div>
		<?php echo Form::close() ?>
	</div>
	<div id="order_list_wrap" class="bg_gray_wrap">
		<p>表示件数<?php echo count($orders) ?>件</p>
		<ul>
			<?php foreach( $orders as $order ) : ?>
				<li>
					<?php if( $order->status ==2  ) : ?>
						<span class="icon cancel">キャンセル済</span>
					<?php else : ?>
						<span class="icon used">利用済</span>
					<?php endif ?>
					<ul class="info_list">
						<li>
							<dl class="clearfix">
								<dt>予約日</dt>
								<dd><?php echo date('Y/m/d', $order->created_at) ?></dd>
							</dl>
						</li>
						<li>
							<dl class="clearfix">
								<dt>予約ID</dt>
								<dd><?php echo $order->id ?></dd>
							</dl>
						</li>
						<li>
							<dl class="clearfix">
								<dt>貸出ステーション</dt>
								<dd><?php echo $order->start_port->name ?><a href="http://maps.google.com/maps?q=<?php echo $order->start_port->lat ?>,<?php echo $order->start_port->lon ?>">ナビ</a></dd>
							</dl>
						</li>
						<?php if( $order->return_port ) : ?>
							<li>
								<dl class="clearfix">
									<dt>返却ステーション</dt>
									<dd><?php echo $order->return_port->name ?><a href="http://maps.google.com/maps?q=<?php echo $order->return_port->lat ?>,<?php echo $order->return_port->lon ?>">ナビ</a></dd>
								</dl>
							</li>
						<?php endif; ?>
					</ul>
					<div class="bike_info clearfix">
						<div class="icon">
							<span style="background-image: url('<?php echo $order->bike->photo_path ?>');"></span>
						</div>
						<ul>
							<li>
								<dl>
									<dt>自転車情報</dt>
									<dd><?php echo $order->bike->code ?></dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt>プラン</dt>
									<dd><?php echo $order->getPlan() ?></dd>
								</dl>
							</li>
							<li>
								<dl>
									<dt>決済方法</dt>
									<dd><?php echo $order->getPaymentMethod() ?></dd>
								</dl>
							</li>
							<li class="total">
								<dl>
									<dt>合計</dt>
									<dd><?php echo number_format($order->total_price) ?>円</dd>
								</dl>
							</li>
						</ul>
					</div>
				</li><!-- list -->
			<?php endforeach; ?>
		</ul>
	</div>
</div>
