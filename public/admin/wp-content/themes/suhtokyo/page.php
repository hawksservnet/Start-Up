

        <div class="page-container page_sub" data-namespace="subpage" data-pagetype="subpage">

            <?php get_template_part('tpl/menu'); ?>
            <?php if (have_posts()) : while ( have_posts() ) : the_post();?>
            <section>

                <?php get_template_part('tpl/pagenavi'); ?>

                <h1 class="sub_logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php bloginfo('template_directory'); ?>/common/img/logo_h.svg" alt="STUDIO DETAILS" width="130" height="10"></a></h1>


                <div class="intro type2">
                    <div class="intro_body">
                        <div class="bgimg"></div>
                        <div class="outer_t">
                            <div class="inner_t v_m">
                                <div class="leadbox">
                                    <header>
                                        <h2 class="textblow"><?php the_title(); ?></h2>
                                        <p class="typewriter"><?php the_excerpt(); ?></p>
                                    </header>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="btn_dive"><div class="iconf"><span>_</span><span>_</span></div><div class="line"></div></a>
                </div>


                <div class="page_body">
                    <div class="block">
                        <div class="sentence">

                            <?php the_content(); ?>

                        </div>
                    </div>
                </div>
                
            </section>
            <?php endwhile; endif; ?>


<?php get_footer(); ?>