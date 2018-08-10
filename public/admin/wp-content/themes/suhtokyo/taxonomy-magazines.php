<?php
get_header();
?>

        <h2 id="page-title" class="clearfix">
            <div class="page-title-inner">
                <span class="en">MAGAZINE</span>
                <span class="jp">マガジン</span>
            </div>
        </h2>

        <div class="section-container bg_01">
            <div class="section-inner">
                <div class="section-contents">
<!--
                    <p class="text">スタートアップ企業の失敗談や、いま創業段階にある人の生の声などをStartup Hub Tokyoのスタッフやコンシェルジュがマガジンという形でお届けします。<br>創業・起業のための情報を配信していきます。</p>
-->
                    <?php $URL = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>
                    <nav id="month-category-list" class="clearfix pc">
                        <div id="month-list" class="list-container">
                            <p class="title">MONTH</p>
                            <ul class="clearfix">
                                <li<?php echo (!preg_match('/20/',$URL)) ? ' class="current"' : '';?>><a href="<?php echo home_url('/magazine/'); ?>">ALL</a></li>
                                <?php
                                $args = array(
                                    'type'            => 'yearly',
                                    'limit'           => '',
                                    'format'          => 'custum',
                                    'before'          => '<li>',
                                    'after'           => '</li>',
                                    'show_post_count' => false,
                                    'echo'            => 1,
                                    'order'           => 'DESC',
                                    'post_type'       => 'magazine'
                                    );
                                wp_get_archives($args); ?>

                            </ul>
                        </div>
                        <div id="category-list" class="list-container">
                            <p class="title">CATEGORY</p>
                            <ul class="clearfix">
                    <?php
                    $path = $_SERVER["REQUEST_URI"];
                    $keys = parse_url($URL); //パース処理
                    $path = (strpos($path,'/page/') !== false)? str_replace('page/'.end(explode("/", $keys['path'])), '', $path):$path;
                    $term = basename($path);
                    $magazines = get_categories(array('taxonomy'=>'magazines'));//エリア取得
                    ?>

                                <li><a href="<?php echo home_url('/magazine/'); ?>" class="en">ALL</a></li>


                    <?php
                    foreach ($magazines as $key => $magazine):
                    $magazinename = $magazine->name;
                    ?>
                                <li<?php echo ($term==$magazine->slug)?' class="current"':''; ?>><a href="<?php echo home_url('/magazines/'); ?><?php echo $magazine->slug; ?>/" class="en"><?php echo $magazinename; ?></a></li>
                    <?php endforeach; ?>
                            </ul>
                        </div>
                    </nav>

                    <div id="month-category-select" class="clearfix sp">
                        <div id="month-select" class="select-container">
                            <p class="title">MONTH</p>
                            <div class="select">
                                <select>
                                    <option value="<?php echo home_url('/magazine/'); ?>"<?php echo (!preg_match('/20/',$URL)) ? ' selected' : '';?>>ALL</option>

                                <?php
                                $args = array(
                                    'type'            => 'yearly',
                                    'limit'           => '',
                                    'format'          => 'custum',
                                    'before'          => '<option>',
                                    'after'           => '</option>',
                                    'show_post_count' => false,
                                    'echo'            => 1,
                                    'order'           => 'DESC',
                                    'post_type'       => 'magazine'
                                    );
                                wp_get_archives($args); ?>


                                </select>
                            </div>
                        </div>
                        <div id="category-select" class="select-container">
                            <p class="title">CATEGORY</p>
                            <div class="select">
                                <select>
                                <?php
                                    foreach ($magazines as $key => $magazine):
                                    $magazinename = $magazine->name; ?>
                                <option value="<?php echo home_url('/magazines/'); ?><?php echo $magazine->slug; ?>/" <?php echo ($term==$magazine->slug)?'selected':''; ?>><?php echo $magazinename; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div id="magazine-list" class="clearfix">
                        <?php
                            $paged = get_query_var('paged') ? get_query_var('paged') : 1 ;
                            $args = (!preg_match('/20/',$URL))?
                            array(
                                'post_type' => 'magazine',
                                'post_status' => 'publish',
                                'paged' => $paged,
                                'posts_per_page' => 15,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'magazines',
                                        'field' => 'slug',
                                        'terms' => array(
                                            $term,
                                        ),
                                    ),
                                ),
                                'has_password' => false,


                            )
                            : array(
                                'post_type' => 'magazine',
                                'post_status' => 'publish',
                                'paged' => $paged,
                                'posts_per_page' => 15,
                                'year' => basename($URL,"?post_type=magazine"),
                                'has_password' => false,
                            );
                            $the_query = new WP_Query( $args );
                            if ( $the_query->have_posts() ) :
                                while ( $the_query->have_posts() ) : $the_query->the_post() ;
                        ?>

                    <?php include get_template_directory().'/_inc/magazine_list_block.php'; ?>
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