<?php get_header(); ?>
<style>
h2 {  /* 見出しのスタイルを指定 */
  margin: 35px 0 20px;
  padding: 15px;
  background: #F5F5F5;
  border-left: solid 5px #5a8b0f;
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
  font-size: 20px;
}
p.normal {  /* 本文のスタイルを指定 */
  line-height: 28px;
  font-size: 16px;
  margin: 1em 0px;
}
p.naname {  /* 引用のスタイルを指定 */
  line-height: 28px;
  font-size: 16px;
  margin: 1em 0px;
  font-style: italic;
}
p.question {  /* 質問のスタイルを指定 */
  line-height: 28px;
  font-size: 16px;
  margin: 1.6em 0px 1em;
  font-style: italic;
  font-weight:bold;
}
p.question:before {
content: "─";
}
div.img {
  text-align:center;
  margin: 30px 0;
}
div.credit {  /* クレジットのスタイルを指定 */
  background-color: #F5F5F5;
  padding: 1em 1.6em;
  border-radius: 4px;
  margin: 40px 0 20px;
}
p.credit {  /* クレジット内の文章のスタイルを指定 */
  line-height: 19px;
  font-size: 14px;
  margin: 0.78em 0px;
}
</style>

        <h2 id="page-title" class="clearfix">
            <div class="page-title-inner">
                <span class="en">MAGAZINE</span>
                <span class="jp">マガジン</span>
            </div>
        </h2>

        <div class="section-container bg_03">
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
    $post_cat = get_the_terms(get_post()->ID,"magazines");
    for( $i=0; $i<count($post_cat); $i++ ){
        echo ' <p class="category"><a href="'.home_url('/').'magazines/'.$post_cat[$i]->slug.'/">'.$post_cat[$i]->name.'</a></p>';
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
                            <a href="<?php echo home_url('/magazine/'); ?>">
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
