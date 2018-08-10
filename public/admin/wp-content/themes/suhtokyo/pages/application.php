<?php
/* Template Name: APPLICATION */
get_header();
?>

        <h2 id="page-title" class="clearfix">
            <div class="page-title-inner">
                <span class="en">APPLICATION</span>
                <span class="jp">イベント申し込みフォーム</span>
            </div>
        </h2>

        <div id="user-registration" class="section-container bg_02">
            <div class="section-inner">
                <div class="section-contents">

                    <p class="lead center">下記フォームに必須項目をご入力いただき、プライバシーポリシーに同意の上、イベントへの申し込みをお願いいたします。</p>

                    <!-- <ul id="progress-navi">
                        <li class="current"><span><span class="en">STEP.1</span> 入力</span></li>
                        <li><span><span class="en">STEP.2</span> 確認</span></li>
                        <li><span><span class="en">STEP.3</span> 送信完了</span></li>
                    </ul> -->
<?php if (have_posts()) : while ( have_posts() ) : the_post();?>
<?php the_content(); ?>
<?php endwhile; endif; ?>

<div id="event-info-container" style="display:none;">
    <div id="event-title_text"><?php echo $_GET['event_title'] ?></div>
    <div id="event-url_text"><?php echo $_GET['event_url'] ?></div>
</div>

                </div><!-- /.section-contents -->
            </div><!-- /.section-inner -->
        </section><!-- /.section-container -->

<?php get_footer(); ?>
