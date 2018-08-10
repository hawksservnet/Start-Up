<?php get_header(); ?>


            <div class="page-container page_sub page_news" data-namespace="listpage" data-pagetype="listpage">


                <?php get_template_part('tpl/menu'); ?>
                <section>

                    <h1 class="sub_logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php bloginfo('template_directory'); ?>/common/img/logo_h.svg" alt="STUDIO DETAILS" width="130" height="10"></a></h1>


                    <div class="news_list">

	                    <ul class="flex-center">
	                    	<li>
                                <article>
                                    <p class="date"><?php the_time('Y,m,d'); ?></p>
                                    <div class="post_images">
                                        <?php echo wp_get_attachment_image( get_the_ID() ); ?>
                                    </div>

                                </article>
                            </li>
	                    </ul>

                    </div>


                    
                </section>

<?php get_footer(); ?>
