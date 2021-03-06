<li class="order_block">
  <p class="order_num">予約ID<span><?php echo $order->id ?></span></p>
  <ul class="info_list">
    <li class="time_area">
      <dl class="clearfix">
        <dt>貸出ステーション</dt>
        <dd>
          <?php if($order->start_port): ?>
            <?php echo $order->start_port->name ?>
            <a href="http://maps.google.com/maps?q=<?php echo $order->start_port->lat ?>,<?php echo $order->start_port->lon ?>">ナビ</a>
          <?php endif; ?>
        </dd>
      </dl>
    </li>
    <?php if( $order->return_port ) : ?>
    <li>
      <dl class="clearfix">
        <dt>返却ステーション</dt>
        <dd><?php echo $order->return_port?$order->return_port->name:'' ?><a href="http://maps.google.com/maps?q=<?php echo $order->return_port?$order->return_port->lat:'' ?>,<?php echo $order->return_port?$order->return_port->lon:'' ?>">ナビ</a></dd>
      </dl>
    </li>
    <?php endif; ?>
  </ul>
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
              <dd><span><?php echo $order->getPlan() ?></dd>
            </dl>
          </li>
        </ul>
      </div>
      
    </div>
  </div>