<?php
get_header();
?>

        <h2 id="page-title" class="clearfix">
            <div class="page-title-inner">
                <span class="en">COLUMN</span>
                <span class="jp">コラム</span>
            </div>
        </h2>

        <div class="section-container">
            <div class="section-inner">
                <div class="section-contents">

                    <p class="text">スタートアップ企業の失敗談や、いま創業段階にある人の生の声などをStartup Hub Tokyoのスタッフやコンシェルジュがコラムという形でお届けします。<br>創業・起業のための情報を配信していきます。</p>

                    <?php $URL = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>
                    <nav id="month-category-list" class="clearfix pc">
                        <div id="month-list" class="list-container">
                            <p class="title">MONTH</p>
                            <ul class="clearfix">
                                <li<?php echo (!preg_match('/20/',$URL)) ? ' class="current"' : '';?>><a href="<?php echo home_url('/column/'); ?>">ALL</a></li>
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
                                    'post_type'       => 'column'
                                    );
                                wp_get_archives($args); ?>

                            </ul>
                        </div>
                        <div id="category-list" class="list-container">
                            <p class="title">CATEGORY</p>
                            <ul class="clearfix">
                    <?php
                    $path = $_SERVER["REQUEST_URI"];
                    $term = basename($path);

                    $columns = get_categories(array('taxonomy'=>'columns'));//エリア取得
                    foreach ($columns as $key => $column):
                    $columnname = $column->name; ?>
                                <li><a href="<?php echo home_url('/columns/'); ?><?php echo $column->slug; ?>/" <?php echo ($term==$column->slug)?'class="current jp"':'class="jp"'; ?> ><?php echo $columnname; ?></a></li>
                    <?php endforeach; ?>
                            </ul>
                        </div>
                    </nav>

                    <div id="month-category-select" class="clearfix sp">
                        <div id="month-select" class="select-container">
                            <p class="title">MONTH</p>
                            <div class="select">
                                <select>
                                <option value="<?php echo home_url('/column/'); ?>"<?php echo (!preg_match('/20/',$URL)) ? ' selected' : '';?>>ALL</option>

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
                                    'post_type'       => 'column'
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
                                    foreach ($columns as $key => $column):
                                    $columnname = $column->name; ?>
                                <option value="<?php echo home_url('/columns/'); ?><?php echo $column->slug; ?>/" <?php echo ($term==$column->slug)?'selected':''; ?>><?php echo $columnname; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div id="column-list" class="clearfix">
                        <?php
                            $args = (!preg_match('/20/',$URL))?
                            array(
                                'post_type' => 'column',
                                'post_status' => 'publish',
                                'paged' => $paged,
                                'posts_per_page' => -1,
                                'has_password' => false,
                            )
                            : array(
                                'post_type' => 'column',
                                'post_status' => 'publish',
                                'paged' => $paged,
                                'posts_per_page' => -1,
                                'year' => basename($URL,"?post_type=column"),
                                'has_password' => false,
                        );
                            $the_query = new WP_Query( $args );
                            if ( $the_query->have_posts() ) :
                                while ( $the_query->have_posts() ) : $the_query->the_post() ;
                        ?>

                    <?php include get_template_directory().'/_inc/column_list_block.php'; ?>
                        <?php
                            endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>

                    </div>

                    <div class="pagenavi-wrap">
                        <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
                    </div>

                </div><!-- /.section-contents -->
            </div><!-- /.section-inner -->
        </section><!-- /.section-container -->

    <?php include get_template_directory().'/_inc/fixbtn.php'; ?>


<?php get_footer(); ?>
