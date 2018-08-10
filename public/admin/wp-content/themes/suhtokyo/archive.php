<?php
get_header();
?>
		<h2 id="page-title" class="clearfix">
            <div class="page-title-inner">
                <span class="en">INFORMATION</span>
                <span class="jp">お知らせ</span>
            </div>
        </h2>

        <div class="section-container mb bg_01">
            <div class="section-inner">
                <div class="section-contents">

                    <!-- <p class="text">StartUpHUB TOKYOでは、会員の皆様の取り組みをサポートすべく、様々なイベントを開催しています。<br class="pc">
                    文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります<br class="pc">
                    文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります<br class="pc">
                    文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります</p> -->

                    <div id="infomation-list" class="js__mark pt mb">
                        <?php
                        $url = $_SERVER["REQUEST_URI"];
                        $keys = parse_url($url); //パース処理
                        $path = explode("/", $keys['path']); //分割処理
                        $no = end($path);
                         $page = (strpos($url,'/page/') !== false)?$no:"1";
                         ?>
                        <?php if(have_posts()): query_posts('posts_per_page=10&&paged='.$page); while(have_posts()):the_post(); ?>
                        <article class="js__link-box">
                            <div class="">
                                <div class="list-inner clearfix">
                                    <time class="date"><?php echo get_post_time('Y/m/j') ?></time>
                                    <p class="text"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                </div>
                            </div>
                        </article>
                        <?php endwhile; endif; ?>
                        <div class="bg-color js__mark bg_01" data-width="1320"></div>
                    </div>

                    <div class="pagenavi-wrap">
                         <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
                    </div>

                </div><!-- /.section-contents -->
            </div><!-- /.section-inner -->
        </section><!-- /.section-container -->


<?php get_footer(); ?>
