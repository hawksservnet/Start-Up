<?php get_header(); ?>

        <h2 id="page-title" class="clearfix">
            <div class="page-title-inner">
                <span class="en">COLUMN</span>
                <span class="jp">コラム</span>
            </div>
        </h2>

        <div class="section-container">
            <div class="section-inner">
                <div class="section-contents">

                    <?php while (have_posts()) : the_post(); ?>
                    <article id="information-detail-container">

                        <section id="information-main" class="detail-section-container">
                            <div class="information-title-container">
                                <div class="information-title-inner">
                                    <time class="date"><div class="date-inner"><?php echo get_post_time('Y.m.j') ?></div></time>
                                    <h3 class="title"><?php the_title(); ?></h3>
                                </div>
                            </div><!-- /.information-title-container -->

                            <?php the_content(); ?>

                        </section><!-- /.detail-section-container -->
                        <div id="detail-cat_tag-container" class="clearfix">
<?php
    $post_cat = get_the_terms(get_post()->ID,"columns");
    for( $i=0; $i<count($post_cat); $i++ ){
        echo ' <p class="category"><a href="'.home_url('/').'columns/'.$post_cat[$i]->slug.'/">'.$post_cat[$i]->name.'</a></p>';
    }
?>
                        </div>

                    </article>

                    <div class="pagenation clarfix">
                        <div class="pagenation-inner">
                            <div class="prev"><?php previous_post_link('%link', '<span><span>PREV</span></span>', FALSE); ?></div>
                            <div class="next"><?php next_post_link('%link', '<span><span>NEXT</span></span>', FALSE); ?></div>
                        </div>
                    </div>

                    <div class="btn center min js__mark detail-back-btn">
                        <div class="btn-inner clear">
                            <a href="<?php echo home_url('/column/'); ?>">
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

    <?php include get_template_directory().'/_inc/fixbtn.php'; ?>


<?php get_footer(); ?>
