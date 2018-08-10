<?php
/* Template Name: HOW TO JOIN */
get_header();
?>

    <h2 id="page-title" class="clearfix">
      <div class="page-title-inner">
        <span class="en">HOW TO JOIN</span>
        <span class="jp">参加方法</span>
      </div>
    </h2>

  <div id="how_to_use" class="section-container bg_01">
    <div class="section-inner">
      <div class="section-contents">

        <ul id="how_to_use-list">
          <li class="no1 js__mark js__horizontal-box_st">
            <div class="list-inner clearfix">
              <p class="no js__st" data-width="45">01</p>
              <p class="illust">
                <span class="js__mark js__rotate">
                  <img src="<?php echo home_url('/'); ?>assets/img/index/how_to_join1.png" alt="まずはネットからメンバー申し込み" width="252" height="160">
                </span>
              </p>
              <div class="text-container js__vertical-middle">
                <div class="text-inner">
                  <h3 class="title">
                    <div class="js__simple">まずはネットから<br class="sp">メンバー申し込み</div>
                  </h3>
                  <p class="text">
                    <span class="js__simple">
                      Startup Hub Tokyoへの参加は、サイトのフォーム入力から始まります。必要な情報を入力すると、登録したメールアドレスに登録確認が届きます。
                    </span>
                  </p>
                </div>
              </div>
            </div>
            <div class="list-bg js__st" data-width="1080"><div class="bg"></div></div>
          </li>

          <li class="no2 js__mark js__horizontal-box_st">
            <div class="list-inner clearfix">
              <p class="no js__st" data-width="45">02</p>
              <p class="illust">
                <span class="js__mark js__rotate">
                  <img src="<?php echo home_url('/'); ?>assets/img/index/how_to_join2.png" alt="確認メールに記載されたURLで認証" width="252" height="160">
                </span>
              </p>
              <div class="text-container js__vertical-middle">
                <div class="text-inner">
                  <h3 class="title">
                    <div class="js__simple">確認メールに記載された<br class="sp">URLで認証</div>
                  </h3>
                  <p class="text">
                    <span class="js__simple">
                      登録確認メール内に記載された、認証用URLをクリックして、メールアドレスの確認を行ってください。確認が済むと登録完了メールが届きます。
                    </span>
                  </p>
                </div>
              </div>
            </div>
            <div class="list-bg js__st" data-width="1080"><div class="bg"></div></div>
          </li>

          <li class="no3 js__mark js__horizontal-box_st">
            <div class="list-inner clearfix">
              <p class="no js__st" data-width="45">03</p>
              <p class="illust">
                <span class="js__mark js__rotate">
                  <img src="<?php echo home_url('/'); ?>assets/img/index/how_to_join3.png" alt="メールをプリントアウト" width="252" height="122">
                </span>
              </p>
              <div class="text-container js__vertical-middle">
                <div class="text-inner">
                  <h3 class="title">
                    <div class="js__simple">メールをプリントアウト or 画面提示してご来館ください</div>
                  </h3>
                  <p class="text">
                    <span class="js__simple">
                      登録完了メールをプリントアウトするか、画面表示できる状態にしてStartup Hub Tokyoへお越しください。その日から施設の利用が可能です！
                    </span>
                  </p>
                </div>
              </div>
            </div>
            <div class="list-bg js__st" data-width="1080"><div class="bg"></div></div>
          </li>
        </ul>

        <div class="btn center js__mark mb20">
          <div class="btn-inner">
            <a href="<?php echo $USER_SITE_URL; ?>users/registration.php">
              <span class="text">メンバーに申し込む</span>
            </a>
            <div class="line"></div>
            <div class="line2"></div>
          </div>
        </div>

        <div class="btn center js__mark">
          <div class="btn-inner">
            <a href="<?php echo home_url('/pre-entre/'); ?>">
              <span class="text">プレアントレについて</span>
            </a>
            <div class="line"></div>
            <div class="line2"></div>
          </div>
        </div>


      </div><!-- /.section-contents -->
      <div class="bg-color js__mark js__horizontal-box" data-width="1320"></div>
    </div><!-- /.section-inner -->
    <?php include 'assets/_inc/_bg_icon.php'; ?>
  </div><!-- /.section-container -->

<?php get_footer(); ?>
