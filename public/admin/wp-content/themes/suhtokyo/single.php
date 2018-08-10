<?php get_header(); ?>

        <h2 id="page-title" class="clearfix">
            <div class="page-title-inner">
                <span class="en">INFORMATION</span>
                <span class="jp">お知らせ</span>
            </div>
        </h2>

        <div class="section-container">
            <div class="section-inner">
                <div class="section-contents bg_01">

                    <?php while (have_posts()) : the_post(); ?>
                    <article id="information-detail-container">

                        <section id="information-main" class="detail-section-container">
                            <div class="information-title-container">
                                <div class="information-title-inner">
                                    <time class="date"><div class="date-inner"><?php echo get_post_time('Y.m.j') ?></div></time>
                                    <h3 class="title"><?php the_title(); ?></h3>
<!--
                                    <p class="category">カテゴリA</p>
 -->
                                </div>
                            </div><!-- /.information-title-container -->

                            <?php the_content(); ?>

                        </section><!-- /.detail-section-container -->

                    </article>

                    <div class="pagenation clarfix">
                        <div class="pagenation-inner">
                            <div class="prev"><?php previous_post_link('%link', '<span><span>PREV</span></span>', FALSE); ?></div>
                            <div class="next"><?php next_post_link('%link', '<span><span>NEXT</span></span>', FALSE); ?></div>
                        </div>
                    </div>

                    <div class="btn center min js__mark detail-back-btn">
                        <div class="btn-inner clear">
                            <a href="<?php echo home_url('/information/'); ?>">
                                <span class="text en">BACK TO LIST</span>
                            </a>
                            <div class="line"></div>
                            <div class="line2"></div>
                        </div>
                    </div>


                    <?php endwhile;?>

                </div><!-- /.section-contents -->
            </div><!-- /.section-inner -->
        </section><!-- /.section-container -->


<?php get_footer(); ?>
