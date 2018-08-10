<?php
get_header();
?>

        <h2 id="page-title" class="clearfix">
            <div class="page-title-inner">
                <span class="en">EVENTS</span>
                <span class="jp">イベント</span>
            </div>
        </h2>

        <div class="section-container bg_02">
            <div class="section-inner">
                <div class="section-contents">

<!--
                    <p class="text">StartUpHUB TOKYOでは、会員の皆様の取り組みをサポートすべく、様々なイベントを開催しています。<br class="pc">
文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります<br class="pc">
文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります<br class="pc">
文章がここに入ります文章がここに入ります文章がここに入ります文章がここに入ります</p>
-->
<?php
    $path = $_SERVER["REQUEST_URI"];
    $keys = parse_url($path); //パース処理
    $path = (strpos($path,'/page/') !== false)? str_replace('page/'.end(explode("/", $keys['path'])), '', $path):$path;
    $term = basename($path);
    $post_tag = get_the_terms(get_post()->ID,"event_tag");
    for($i=0; $i<count($post_tag); $i++){
        if($post_tag[$i]->slug == $term){
            $selectTag = $post_tag[$i]->name;
        }
    }

 ?>
                    <nav id="month-category-list" class="clearfix pc">
                        <div id="category-list" class="list-container">
                            <p class="title">TAG</p>
                            <ul class="clearfix">
                                <li><?php echo $selectTag; ?></li>
                            </ul>
                        </div>
                    </nav>

                    </div>

                    <div id="events-list" class="clearfix">
                        <?php
                            $paged = get_query_var('paged') ? get_query_var('paged') : 1 ;

                            $args = array(
                                'post_type' => 'event',
                                'post_status' => 'publish',
                                'paged' => $paged,
                                'posts_per_page' => 15,
                                'order'     => 'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'event_tag',
                                        'field' => 'slug',
                                        'terms' => array(
                                            $term,
                                        ),
                                    ),
                                ),
                                'has_password' => false,


                                // 'meta_query' => array(array(
                                //     'key' => '2017_1',
                                //     // 'value' => true,
                                //     // 'compare'=>'!=',
                                // ))
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
