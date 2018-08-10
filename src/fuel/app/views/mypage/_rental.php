<li class="order_block">
  <p class="order_num">予約ID<span><?php echo $order->id ?></span></p>
    <div class="bike_info clearfix">
      <p class="bike_cate"><?php echo $order->bike->category->name ?></p>
      <div class="info_block clearfix">
        <div class="bike_detail_info clearfix">
          <div class="icon">
            <?php if($order->bike->photo_path): ?>
            <span style="background-image: url('<?php echo $order->bike->photo_path; ?>');"></span>
            <?php else: ?>
            <span class="no_image" style="background-image: url(<?php echo Asset::get_file('common/no_image.png', 'img'); ?>);background-size: auto 120%!important;"></span>
            <?php endif; ?>
          </div>
          <ul>
            <li>
              <dl>
                <dt>暗証番号</dt>
                <dd><?php echo $order->bike->pin_code ?></dd>
              </dl>
            </li>
            <li>
              <dl>
                <dt>車両番号</dt>
                <dd><?php echo $order->bike->code ?></dd>
              </dl>
            </li>
            <li>
              <dl>
                <dt>利用料金</dt>
                <dd>
                  <span><?php echo $order->bike->hour_price ?>円/1時間あたり</span>
                  <span><?php echo $order->bike->day_price ?>円/1日あたり</span>
                </dd>
              </dl>
            </li>
          </ul>
        </div>
        <div class="total_area clearfix">
          <div class="total_time">
            <dl>
              <dt>利用時間</dt>
              <dd><?php echo $order->getRentalTimeFormat() ?></dd>
            </dl>
          </div>
          <div class="total_price">
            <dl>
              <dt>利用料金</dt>
              <dd>￥<?= number_format($order->getTotalPrice()); ?></dd>
            </dl>
          </div>
            </div>
      </div>
    </div>
    <div class="total_under clearfix">
      <dl class="total">
        <dt>合計</dt>
        <dd>¥<?php echo number_format($grand_total); ?></dd>
      </dl>
      <dl class="pay">
        <dt>支払</dt>
        <dd>クレジット</dd>
      </dl>
    </div>
