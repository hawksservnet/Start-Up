<div id="complete_wrap">

  <p class="text">
    ご登録いただきましたメールアドレス宛に登録用のURLを記載したメールをお送りしました。<br>
    メールに記載されたURLよりアクセスいただき、会員登録をお済ませください。<br>
    ※会員のご登録にはクレジットカード情報の登録が必要です。
  </p>

  <?php if (Agent::is_mobiledevice()): ?>
  <div class="btn center black w200"><a href="<?= Uri::create('top'); ?>"><span>TOPへ戻る</span></a></div>
  <?php else: ?>
  <div class="btn center black w200"><a href="<?= Config::get('master.HELLOCYCLING_URL'); ?>"><span>TOPへ戻る</span></a></div>
  <?php endif; ?>

</div>
