    </main><!-- /#body -->
<?php
    //ページによる分岐
    if(is_home() || is_front_page()){
        $pageID = "top";
        $pageTitle = "";
    }elseif(is_post_type_archive( 'event' ) || is_singular( 'event' )){
        $pageID = "event";
        if(is_single()){
            $pageTitle = get_the_title()." | イベント情報";
        }else{
            $pageTitle = "イベント情報";
        }
    }elseif(is_archive() || is_single()){
        $pageID = "news";
        if(is_single()){
            $pageTitle = get_the_title()." | お知らせ";
        }else{
            $pageTitle = "お知らせ";
        }
    }elseif(is_404()){
        $pageID = "notfound";
        $pageTitle = "PAGE NOT FOUND";
    }else{
        $pageID = get_page($page_id)->post_name;
        $pageTitle = get_the_title();
    }
?>
    <div id="modal-container" class="sp">
        <div id="modal-inner">
            <div id="modal-contents">
                <div id="modal-content">
                    <div class="title"></div>
                    <div class="text"></div>
                </div>
                <div id="modal-close">
                    <div class="icon"></div>
                    <p class="text">CLOSE</p>
                </div>
            </div>
        </div>
    </div><!-- /#modal-container -->

    <div id="page-top">
        <div class="arrow">
            <svg x="0px"
                 y="0px" width="40px" height="21px" viewBox="0 0 40 21" enable-background="new 0 0 40 21" xml:space="preserve">
            <path fill-rule="evenodd" clip-rule="evenodd" fill="none" stroke="#272A2F" stroke-width="2" stroke-miterlimit="10" d="
                M0.992,20.223L20,1.32l19.008,18.903"/>
            </svg>
        </div>
        <p class="text">PAGE TOP</p>
    </div>

    <div id="footer-container">
        <div id="footer-inner" class="clearfix">
            <ul class="footer-link clearfix">
                <li><a href="<?php echo home_url('/terms/'); ?>">利用規約</a></li>
                <li><a href="<?php echo home_url('/privacy-policy/'); ?>">プライバシーポリシー</a></li>
                <li><a href="<?php echo home_url('/site-policy/'); ?>">サイトポリシー</a></li>
                <li><a href="<?php echo home_url('/access/'); ?>">アクセス</a></li>
            </ul>
            <div class="text-wrap clearfix">

                <div class="fb-page-container sp">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fstartuphub.tokyo%2F&tabs&width=290&height=154&small_header=true&adapt_container_width=false&hide_cover=false&show_facepile=true&appId=715556871806720" width="290" height="154" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                </div>


                <ul class="logo-container clearfix">
                    <li class="tokyoto-logo"><a href="http://www.metro.tokyo.jp/" target="_blank"><img src="<?php echo home_url('/'); ?>assets/img/common/tokyoto-logo.svg" alt="東京都"></a></li>
                    <li class="tokyoto-logo"><a href="http://www.tokyo-sogyo-net.jp/" target="_blank"><img src="<?php echo home_url('/'); ?>assets/img/common/tokyo_net_icon.svg" alt="東京創業NET"></a></li>
                </ul>

                <div class="text clearfix">
                    <dl class="clearfix">
                        <dt>運営元 : </dt>
                        <dd>東京都産業労働局 商工部 創業支援課</dd>
                    </dl>
                    <!-- <dl class="clearfix">
                        <dt>TEL : </dt>
                        <dd>03-5320-4763</dd>
                        <dt>FAX : </dt>
                        <dd>03-5388-1462</dd>
                    </dl> -->
                    <dl class="clearfix">
                        <dt>運営会社 : </dt>
                        <dd>株式会社ツクリエ</dd>
                    </dl>
                    <p>Startup Hub Tokyoは東京都からの委託を受けて株式会社ツクリエが運営しています。</p>
                </div>
            </div>

            <div class="fb-page-container pc">
                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fstartuphub.tokyo%2F&tabs&width=340&height=154&small_header=true&adapt_container_width=false&hide_cover=false&show_facepile=true&appId=715556871806720" width="340" height="154" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
            </div>


        </div>
        <p class="copy-right">Copyright (c) Startup Hub Tokyo All Rights Reserved.</p>
    </div>

    </div><!-- /#scroll-body -->

    <?php include get_template_directory().'/_inc/fixbtn.php'; ?>


    </div><!-- /#document-inner -->
</div><!-- /#document -->
<script src="<?php echo home_url('/'); ?>assets/js/lib.js"></script>
<script src="<?php echo home_url('/'); ?>assets/js/app.js?<?php echo date('mdyGi');  ?>"></script>
<?php if($pageID == "event" || $pageID == "access"): ?>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyAllctTKw_W7c83w1imUFoJQR8CMuiACrw"></script>
<script src="<?php echo home_url('/'); ?>assets/js/events.js?<?php echo date('mdyGi');  ?>"></script>
<?php endif; ?>
<?php echo $extra_js; ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  // ga('create', 'UA-89041948-1', 'auto');
    ga('create', 'UA-89041948-1', 'startuphub.tokyo');
    ga('create', 'UA-89041948-1', 'auto', {'allowLinker': true});
    ga('require', 'linker');
    ga('linker:autoLink', ['mp.startuphub.tokyo'] );
    ga('send', 'pageview');

</script>
<?php wp_footer(); ?>
</body>
</html>