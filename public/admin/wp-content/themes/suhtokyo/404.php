<?php get_header(); ?>

        <h2 id="page-title" class="clearfix">
            <div class="page-title-inner">
                <span class="en">PAGE NOT FOUND</span>
                <span class="jp">404ページ</span>
            </div>
        </h2>

        <div class="section-container mb bg_01">
            <div class="section-inner">
                <div id="not-found-cont" class="section-contents">

                    <h3 class="title">リクエストされたページが<br class="sp">見つかりません。</h3>
                    <p class="text">リクエストされたページは一時的にアクセスできないか、移動または削除された可能性があります。<br class="pc">URLに間違いがないかご確認をお願いいたします。</p>

                    <div class="btn center">
                        <div class="btn-inner clear">
                            <a href="<?php echo home_url('/'); ?>">
                                <span class="text en">BACK TO TOP</span>
                            </a>
                            <div class="line"></div>
                            <div class="line2"></div>
                        </div>
                    </div>

                </div><!-- /.section-contents -->
            </div><!-- /.section-inner -->
        </section><!-- /.section-container -->

    <?php include get_template_directory().'/_inc/fixbtn.php'; ?>


<?php get_footer(); ?>