                    <article class="js__link-box">
                        <p class="photo">
                            <span class="photo-inner" style="background-image:url('<?php echo catch_that_image(); ?>"></span>
                        </p>
                        <div class="text-container">
                            <time class="date"><?php echo get_post_time('Y/m/j') ?></time>
                            <h3 class="title"><a href="<?php the_permalink(); ?>">
                                <?php $content = get_the_title();
                                echo mb_strimwidth( $content, 0, 50, "...", "UTF-8" ); ?></a></h3>
                        </div>
                    </article>