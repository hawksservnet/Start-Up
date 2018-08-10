    <h2 id="page-title" class="clearfix">
      <div class="page-title-inner">
        <span class="en">PARTNERS</span>
        <span class="jp">パートナー</span>
      </div>
    </h2>
          
            
            
    <section id="partners" class="section-container">
      <div class="section-inner">
        <div class="section-contents">
          <p class="text">StartupHubTokyoへ協力・連携いただいておりますパートナー様を紹介いたします。</p>
          <div class="partners-list">
            <ul>
                <?php
                    $number = 1;
                    $args = array(
                        'post_type' => 'partners',
                        'post_status' => 'publish',
                        'paged' => $paged,
                        'posts_per_page' => -1,
						'orderby' =>  'date',
						'order' =>  'ASC',
                    );
                    $the_query = new WP_Query( $args );
                    $totalcount = count($the_query->posts);
                    if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post() ;

                  $post_cat = get_the_terms(get_post()->ID,"partner");
				/*
				echo "----------------------<br>";
				echo "name:".get_field( 'name')."<br>";
				echo "logo_img:".get_field( 'logo_img')."<br>";
				echo "url:".get_field( 'url')."<br>";
				echo "----------------------<br>";
              */
				?>
              <li class="partners-item item-all item-<?php echo $post_cat[0]->slug; ?>">
              <?php $img = get_field( 'logo_img'); ?>
                <div class="image">
                  <a href="<?php the_field('url'); ?>" class="openmodal" target="_blank">
                  <?php if($img['url'] != ""): ?>
                    <img src="<?php echo $img['url']; ?>" alt="<?php the_field('name'); ?>">
                  <?php else: ?>
                    <img src="<?php echo home_url('/'); ?>assets/img/partners/list_no-image.png" alt="<?php the_field('name'); ?>">
                  <?php endif; ?>
                  </a>
                </div>
                <div class="name"><span><?php the_field('name'); ?></span></div>
              </li>
                <?php
                $number++;
                endwhile;
                endif;
                wp_reset_postdata();
            ?>

            </ul>
          </div>
        </div><!-- /.section-contents -->
      </div><!-- /.section-inner -->
    </section><!-- /.section-container -->

    <script type="text/javascript" src="<?php echo home_url('/'); ?>assets/js/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="<?php echo home_url('/'); ?>assets/js/masonry.pkgd.min.js"></script>
    <script type="text/javascript">
      $(function(){
<?php /* 		  
        $('.sort-link a').on('click',function(e){
          e.preventDefault();
          var selected = $(this).attr('class');
          $(this).parent('li').addClass('active').siblings().removeClass('active');
          $('.item-all').hide();
          $('.item-' + selected).show();
          $('.partners-list > ul').masonry({
            // options
            itemSelector: '.partners-item',
            columnWidth: 430
          });
        });

        $('.sort-select select').on('change',function(e){
          e.preventDefault();
          var selected = $(this).val();
          $('.item-all').hide();
          $('.item-' + selected).show();
        });
*/ ?>

		var winWstat, winWstatB;
        $(window).on('resize load',function(){
          var winW = $(window).width();
          winWstatB = winWstat;
          if(winW > 750){
            winWstat = "PC";
            if(winWstat != winWstatB){
              $('.partners-list > ul').masonry({
                // options
                itemSelector: '.partners-item',
                columnWidth: 430
              });
            }
          }else{
            winWstat = "mobile";
            if(winWstat != winWstatB){
              $('.partners-list > ul').masonry({
                // options
                itemSelector: '.partners-item',
                columnWidth: 430
              });
              $('.partners-list > ul').masonry('destroy');
            }
          }
          $.colorbox.remove();
//          if(winW < 750){
//            $('.openmodal').colorbox({rel:'person',inline: true, width: 305, maxWidth: winW-40, maxHeight: "90%"});
//          }else{
//            $('.openmodal').colorbox({rel:'person',inline: true});
//          }
        });
      });
    </script>
