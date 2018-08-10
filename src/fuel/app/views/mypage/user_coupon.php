<div id="list_wrap">
    <div class="bg_black_wrap">
    <div class="btn green">
      <a href="<?php echo Uri::create("mypage/user_coupon_add") ?>">クーポンを新規登録する</a>
    </div>
  </div>
  <?php if (!empty($user_coupons)): ?>
  <div id="coupon_list_wrap">
    <ul>
      <?php foreach( $user_coupons as $user_coupon ) : ?>
      <li>
        <ul class="coupon_list">
          <li class="name">
            <strong><?php echo $user_coupon->coupon->name; // クーポン名 ?></strong>
          </li>
          <li>
            <dl>
              <dt>クーポンコード</dt>
              <dd><?php echo $user_coupon->coupon->code; // クーポンコード ?></dd>
            </dl>
            <dl>
              <dt>有効期限</dt>
              <dd>
                <?php // クーポンの有効（期限）／無効
                  if ($user_coupon->coupon->isValid()) {
                      if (!empty($user_coupon->coupon->end_time)) {
                          echo Date::forge($user_coupon->coupon->start_time)->format("%Y/%m/%d", true).'～'.Date::forge($user_coupon->coupon->end_time)->format("%Y/%m/%d", true);
                      }
                  } else {
                      echo '無効';
                  } ?>
              </dd>
            </dl>
          </li>
          <li>
            <?php if (!empty($user_coupon->coupon->discount) || !empty($user_coupon->coupon->discount_hour_price) || !empty($user_coupon->coupon->discount_day_price)):// 割引額 ?>
            <div class="discount_wrap">
              <dl>
                <dt>割引額</dt>
                <dd>
                  <?php if (!empty($user_coupon->coupon->discount)):// 固定額 ?>
                  <p><strong><?php echo number_format($user_coupon->coupon->discount); ?></strong>円</p>
                  <?php elseif (!empty($user_coupon->coupon->discount_day_price)):// 一日あたり ?>
                  <p>1日あたり<strong><?php echo number_format($user_coupon->coupon->discount_day_price); ?></strong>円</p>
                  <?php elseif (!empty($user_coupon->coupon->discount_hour_price)):// 1時間あたり ?>
                  <p>1時間あたり<strong><?php echo number_format($user_coupon->coupon->discount_hour_price); ?></strong>円</p>
                  <?php endif; ?>
                </dd>
              </dl>
              <?php //if (!empty($user_coupon->coupon->discount_hour_price)): ?>
              <!-- <div class="more_wrap">
                <p>さらに</p>
                <div class="more_wrap_inner">
                  <dl>
                    <dt>１時間あたり</dt>
                    <dd><?php echo number_format($user_coupon->coupon->discount_hour_price); ?>円引き</dd>
                  </dl>
                  <dl>
                    <dt>１日あたり</dt>
                    <dd><?php echo number_format($user_coupon->coupon->discount_day_price); ?>円引き</dd>
                  </dl>
                </div>
              </div> -->
              <?php //endif ?>
            </div>
            <?php endif; ?>
          </li>
          <li>
            <dl>
              <dt>残り回数</dt>
              <dd><?php echo $user_coupon->quantity .'回'; // クーポン残り回数 ?></dd>
            </dl>
          </li>
        </ul>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endif; ?>
</div>
