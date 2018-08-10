<?php
get_header();
?>

        <h2 id="page-title" class="clearfix">
            <div class="page-title-inner">
                <span class="en">EVENTS</span>
                <span class="jp">イベント</span>
            </div>
        </h2>

        <div class="section-container">
            <div class="section-inner">
                <div class="section-contents bg_02">

<!--
                    <p class="text">StartUpHUB TOKYOでは、会員の皆様の取り組みをサポートすべく、様々なイベントを開催しています。<br class="pc">
文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります<br class="pc">
文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります<br class="pc">
文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります</p>
-->
                    <?php
                    $URL = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
                    $path = $_SERVER["REQUEST_URI"];
                    $keys = parse_url($URL); //パース処理
                    $path = (strpos($path,'/page/') !== false)? str_replace('page/'.end(explode("/", $keys['path'])), '', $path):$path;
                    $term = basename($path);
                    $events = get_categories(array('taxonomy'=>'events'));//エリア取得
                    ?>
                    <nav id="month-category-list" class="clearfix pc">
                        <div id="month-list" class="list-container">
                            <p class="title">MONTH</p>
                            <ul class="clearfix">
                                <li class="current"><a href="<?php echo home_url('/event/'); ?>">ALL</a></li>
                    <?php
                    foreach ($events as $key => $event):
                        if($event->category_parent!=0 && get_term($event->category_parent,'events')->slug == "month"):
                    $eventname = $event->name; ?>
                                <li <?php echo ($term==$event->slug)?'class="current"':''; ?>><a href="<?php echo home_url('/events/'); ?><?php echo $event->slug; ?>/" ><?php echo $eventname; ?></a></li>
                    <?php endif; endforeach; ?>
                            </ul>
                        </div>
                        <div id="category-list" class="list-container">
                            <p class="title">CATEGORY</p>
                            <ul class="clearfix">
                                <li class="current"><a href="<?php echo home_url('/event/'); ?>">ALL</a></li>
                    <?php
                    foreach ($events as $key => $event):
                        if($event->category_parent!=0 && get_term($event->category_parent,'events')->slug == "type"):
                    $eventname = $event->name; ?>
                                <li <?php echo ($term==$event->slug)?'class="current"':''; ?>><a href="<?php echo home_url('/events/'); ?><?php echo $event->slug; ?>/" class="jp"><?php echo $eventname; ?></a></li>
                    <?php endif; endforeach; ?>
                            </ul>
                        </div>
                    </nav>

                    <div id="month-category-select" class="clearfix sp">
                        <div id="month-select" class="select-container">
                            <p class="title">MONTH</p>
                            <div class="select">
                                <select>
                                    <option value="<?php echo home_url('/event/'); ?>" selected>ALL</option>
                    <?php
                    foreach ($events as $key => $event):
                        if($event->category_parent!=0 && get_term($event->category_parent,'events')->slug == "month"):
                    $eventname = $event->name; ?>
                                <option value="<?php echo home_url('/events/'); ?><?php echo $event->slug; ?>/"  <?php echo ($term==$event->slug)?'selected':''; ?>><?php echo $eventname; ?></option>
                    <?php endif; endforeach; ?>

                                </select>
                            </div>
                        </div>
                        <div id="category-select" class="select-container">
                            <p class="title">CATEGORY</p>
                            <div class="select">
                                <select>
                                    <option value="<?php echo home_url('/event/'); ?>" selected>ALL</option>
                                <?php
                                    foreach ($events as $key => $event):
                                    if($event->category_parent!=0 && $event->category_parent==13):
                                    $eventname = $event->name; ?>
                                <option value="<?php echo home_url('/events/'); ?><?php echo $event->slug; ?>/" <?php echo ($term==$event->slug)?'selected':''; ?>><?php echo $eventname; ?></option>
                                <?php  endif; endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="events-list" class="clearfix">
                        <?php
                            $paged = get_query_var('paged') ? get_query_var('paged') : 1 ;
                            $args = (!preg_match('/20/',$URL))?
                            array(
                                'post_type' => 'event',
                                'post_status' => 'publish',
                                'paged' => $paged,
                                'posts_per_page' => 15,
                                'order'     => 'ASC',
                                'has_password' => false,
                            )
                            : array(
                                'post_type' => 'event',
                                'post_status' => 'publish',
                                'paged' => $paged,
                                'posts_per_page' => 15,
                                'order'     => 'ASC',
                                'year' => basename($URL,"?post_type=event"),
                                'has_password' => false,
                        );

                            $the_query = new WP_Query( $args );
                            if ( $the_query->have_posts() ) :
                            while ( $the_query->have_posts() ) : $the_query->the_post() ;
                        ?>
                        <?php include get_template_directory().'/_inc/event_list_block.php'; ?>

                        <?php
                        endwhile;
                        endif;
                        // wp_reset_postdata();
                    ?>
                    </div>

                    <div class="pagenavi-wrap">
                        <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(array('query'=>$the_query)); } ?>
                    </div>
                    <?php wp_reset_postdata(); ?>

                </div><!-- /.section-contents -->
            </div><!-- /.section-inner -->
        </section><!-- /.section-container -->


<?php get_footer(); ?>
