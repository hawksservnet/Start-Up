<div id="add_account_wrap">
  <div class="modal_wrap show">
    <div class="modal_inner">
      <div class="modal_top">
        <p class="text">メールアドレス宛に<br>新しいパスワードを送付しました</p>
      </div>
      <div class="modal_bottom">
        <?php if(isset($_SESSION["order"]) && $_SESSION["order"] == true): ?>
        <a href="order_confirm.php">閉じる</a>
        <?php else: ?>
        <a href="<?= Uri::create('top'); ?>">閉じる</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
