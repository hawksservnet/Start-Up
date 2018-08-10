<?php
/* Template Name: PRE ENTRE */
get_header();
?>

        <h2 id="page-title" class="clearfix">
            <div class="page-title-inner">
                <span class="en">PRE ENTRE</span>
                <span class="jp">プレアントレメンバー申込</span>
            </div>
        </h2>

        <div id="pre-entre-container" class="bg_01">
            <div id="pre-entre-inner">
                <div class="info-container">
                    <div class="info-inner clearfix">

                        <p class="img"><img src="<?php echo home_url('/'); ?>assets/img/pre-entre/img.png" alt=""></p>
                        <div class="text-container">
                            <div class="text-container-inner">
                                <h3 class="title">
                                    プレアントレメンバー制度とは
                                </h3>
                                <p class="text">
                                    Startup Hub Tokyoのメンバーになられた方で、起業に向けたアイデアがあり、自ら起業や事業化に向けた取り組みをおこなう意思のある方を応援するためのメンバー制度です。プレアントレメンバーへの登録は無料です。
                                </p>
                                <div class="special-container">
                                    <h4 class="title-min">メンバー特典</h4>
                                    <ul class="list">
                                        <li>・メンバーサロンの利用</li>
                                        <li>・プレアントレメンバー限定イベントの参加</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="btn-contaner clearfix">
                    <div class="btn-box">
                        <div class="btn-box-inner">
                            <h4 class="title">メンバー登録がまだの方はこちら</h4>

                            <div class="btn center">
                                <div class="btn-inner">
                                    <a href="<?php echo $USER_SITE_URL; ?>users/registration.php">
                                        <span class="text">メンバーに申し込む</span>
                                    </a>
                                    <div class="line"></div>
                                    <div class="line2"></div>
                                </div>
                            </div>

                            <p class="note">※プレアントレメンバーへのお申し込みには<br>
                                弊施設のメンバーへあらかじめご登録いただく必要がございます。</p>
                        </div>
                    </div>

                    <div class="btn-box">
                        <div class="btn-box-inner">
                            <h4 class="title">プレアントレメンバーへお申し込み</h4>

                            <div class="btn center">
                                <div class="btn-inner">
                                    <a href="<?php echo $USER_SITE_URL; ?>users/login">
                                        <span class="text">マイページから申し込む</span>
                                    </a>
                                    <div class="line"></div>
                                    <div class="line2"></div>
                                </div>
                            </div>

                            <p class="note">※マイページへログイン後に「登録情報」ページ下部<br>
                                に表示される「プレアントレメンバーになる」より申請いただけます。</p>
                        </div>
                    </div>

                </div><!-- /.btn-contaner -->


            </div>

            <div class="caution-container">
                <h3 class="title">プレアントレ申し込みのご注意</h3>
                <ul>
                    <li>プレアントレメンバーは起業準備期間に入っている方もしくは起業準備に入ろうとしている方を対象とさせていただいております。</li>
                    <li>プレアントレメンバーはお申し込みから三か月間とさせていただいております。<br>
                    ※承認された月の翌月から「三か月間」（例：3/1承認された場合、6月末までが有効期間となります）<br>
                    継続してプレアントレメンバーをご希望される場合は、コンシェルジュとの面談にて起業の意思、進捗の状況を確認させていただいております。</li>
                    <li>プレアントレメンバーの期間満了後も、メンバーとしてラウンジの利用、セミナーへの参加などが可能です。</li>
                </ul>
            </div>

        </div><!-- /.pre-entre-container -->

<?php get_footer(); ?>
