    <link rel="stylesheet" href="<?php echo home_url('/'); ?>assets/css/pop-up.css"/>
    <h2 id="page-title" class="clearfix">
      <div class="page-title-inner">
        <span class="en">CONCIERGE</span>
        <span class="jp">コンシェルジュ</span>
      </div>
    </h2>

    <section id="concierge" class="section-container bg_02">
      <div class="section-inner">
      <p class="title-pop">
          <a class="btn-open-popup poptext" href="javascript:void(0);" title="Popup">予約・利用方法</a>
          <!-- <a class="" href="javascript:void(0);" title="Popup">予約・利用方法</a> -->
      </p>
      <div class="btn center">
          <div class="btn-inner black">
              <button type="button" onclick="window.location = '/concierge/top';">
                  <span class="text jp">コンシェルジュ相談予約（無料）</span>
              </button>
              <div class="line"></div>
              <div class="line2"></div>
          </div>
      </div>
      <br><br>
        <div class="section-contents">
          <p class="text">様々な分野に精通したコンシェルジュが、ビジネスアイデアの創出やプランニング、起業に必要な法務手続きや税務面でのアドバイスなど、様々な分野で創業希望者をサポートします。<br class="pc">
            コンシェルジュは全員が創業経験者なので、初めてのことで不安が多い方も安心して相談していただくことが可能です。</p>
<!--
          <div class="sort-link pc">
            <ul>
              <li class="active"><a href="#" class="all">ALL</a></li>
              <li><a href="#" class="mon">MON.</a></li>
              <li><a href="#" class="tues">TUES.</a></li>
              <li><a href="#" class="wed">WED.</a></li>
              <li><a href="#" class="thurs">THURS.</a></li>
              <li><a href="#" class="fri">FRI.</a></li>
              <li><a href="#" class="sat">SAT.</a></li>
              <li><a href="#" class="sun">SUN.</a></li>
            </ul>
          </div>
          <div class="sort-select sp">
            <div class="select w160 smp-half">
              <select name="birth_year">
                <option value="all">ALL</option>
                <option value="mon">MON.</option>
                <option value="tues">TUES.</option>
                <option value="wed">WED.</option>
                <option value="thurs">THURS.</option>
                <option value="fri">FRI.</option>
                <option value="sat">SAT.</option>
                <option value="sun">SUN.</option>
              </select>
            </div>
          </div>
-->
          <div class="concierge-list">
            <ul>
                <?php
                    $number = 1;
                    $args = array(
                        'post_type' => 'concierge',
                        'post_status' => 'publish',
                        'paged' => $paged,
                        'posts_per_page' => -1,
                    );
                    $the_query = new WP_Query( $args );
                    $totalcount = count($the_query->posts);
                    if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post() ;

                  $post_cat = get_the_terms(get_post()->ID,"concierges");
              ?>
              <li class="concierge-item item-all item-<?php echo $post_cat[0]->slug; ?>">
              <?php $img = get_field( 'list_img'); ?>
                <div class="image">
                  <a href="#item<?php echo $number; ?>" class="openmodal">
                  <?php if($img['url'] != ""): ?>
                    <img src="<?php echo $img['url']; ?>" alt="<?php the_field('name'); ?>">
                  <?php else: ?>
                    <img src="<?php echo home_url('/'); ?>assets/img/concierge/list_no-image.png" alt="<?php the_field('name'); ?>">
                  <?php endif; ?>
                  </a>
                </div>

                <div class="weekday"><?php echo $post_cat[0]->name; ?></div>
                <div class="name"><?php the_field('title'); ?><span><?php the_field('name'); ?></span></div>
                <div class="kana"><?php the_title(); ?></div>
                <div class="modal-area">
                  <div class="modal-content" id="item<?php echo $number; ?>">
                    <div class="concierge-modal">
                    <?php $img = get_field( 'detail_img'); ?>
                      <?php if($img['url'] != ""): ?>
                        <div class="image" style="background-image: url(<?php echo $img['url']; ?>)"></div>
                      <?php else: ?>
                        <div class="image no-image"></div>
                      <?php endif; ?>
                      <div class="weekday"><?php echo $post_cat[0]->name; ?></div>
                      <div class="name"><?php the_field('title'); ?><span class="name-wrap"><span class="name-text"><?php the_field('name'); ?></span><span class="kana"><?php the_title(); ?></span></span></div>
                      <?php
                      $post_tag = get_the_terms(get_post()->ID,"concierge_tag");
                          if(!empty($post_tag)):
                      ?>
                        <div class="type">
                          <ul>
                            <?php
                                for( $i=0; $i<count($post_tag); $i++ ){
                                    echo ' <li>'.$post_tag[$i]->name.'</li>';
                                }
                            ?>
                          </ul>
                        </div>
                      <?php endif; ?>
                      <div class="text"><?php the_content(); ?></div>
                      <div class="modal-number pc"><?php echo $number; ?> / <?php echo $totalcount; ?></div>
                    </div>
                  </div>
                </div>
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

    <!-- POP-UP -->
      <div class="to-popup con-popup">
          <span class="btn-close"></span>
          <div class="popup-cont popup-wrap">
              <h2>利用・予約方法</h2>
              <div class="cont-inner" style="float:left;text-align: left;padding-left:10%;fot-size:8pt;">
                <p>＜対象＞</p>
                <p>・起業前～起業して間もない方</p>
                <br>
                <p>＜料金＞</p>
                <p>・無料</p>
                <br>
                <p>＜コンシェルジュ予約について＞</p>
	            <p>・ご予約の際は、表示されているカレンダーから、〇がついている希望の時間帯をクリックし、お申し込みを行ってください。</p>
	            <p>×と表示されている場合、該当の時間帯はご予約いただけません。</p>
	            <p></p>
	            <p>・現在表示されている中に希望するお時間がない場合、「すべて表示」を押下いただくことで、該当日の全時間帯の表示が可能です。</p>
	            <p></p>
	            <p>・ご予約は開始時間1分前（〜59分）までお申し込み可能ですが、</p>
	            <p>開始時間までに申し込みを完了頂く必要がありますので、余裕をもってお申し込みください。</p>
	            <p></p>
	            <p>・ご予約は１か月４回までとさせていただいております。</p>
	            <br>
	            <p>＜コンシェルジュ相談当日について＞</p>
	            <p>・当日は、開始時間になりましたら、受付に「お名前とご予約時間」をお申し出ください。</p>
	            <p>受付スタッフがご案内させていただきます。</p>
	            <p>（相談時間は１回40分程度とさせていただいております。）</p>
	            <p></p>
	            <br>
	            <p>＜予約のキャンセルについて＞</p>
	            <p>・予約のキャンセルはStartup Hub TokyoのHPにログインいただきMyPageよりお手続きいただきますようお願いいたします。</p>
	            <p>　※不測の事情等で開始時間に間に合わない場合、開始時間前までにお電話（03-6551-2470）にてご連絡ください。</p>
	            <p>　※ご連絡なく10分以上遅れた場合にはやむを得ずキャンセルとさせていただきますので、ご了承ください。</p>
	            <br>
	            <p>＜その他＞</p>
	            <p>・ご予約いただいたコンシェルジュが変更になる場合、メールにてご連絡させていただきます。</p>
	            <p>　あらかじめご了承いただけますと幸いです。</p>
	            <p>・その他のご不明点については、concierge@startup.tokyoまでメールでお問合せください。</p>
	            <br>
              </div>
              <div class="tcenter m-t15">
                  <input id="close-popup" onclick = "disablePopup()" class="button" type="button" name=""  value="閉じる" />
              </div>
          </div>
          <!-- End popup-cont -->
      </div>
      <!-- End to-popup -->
      <div class="background-popup"></div>
      <!-- END POP-UP -->

    <script type="text/javascript" src="<?php echo home_url('/'); ?>assets/js/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="<?php echo home_url('/'); ?>assets/js/masonry.pkgd.min.js"></script>
    <script type="text/javascript" src="<?php echo home_url('/'); ?>assets/js/pop-up.js"></script>
    <script type="text/javascript">
      function disablePopup() {
        $('.to-popup').hide();
        $(".to-popup").fadeOut(300);
        $(".background-popup").fadeOut(300);
        $('body,html').css("overflow","auto");//enable scroll bar
      }
      $(function(){
        $('.sort-link a').on('click',function(e){
          e.preventDefault();
          var selected = $(this).attr('class');
          $(this).parent('li').addClass('active').siblings().removeClass('active');
          $('.item-all').hide();
          $('.item-' + selected).show();
          $('.concierge-list > ul').masonry({
            // options
            itemSelector: '.concierge-item',
            columnWidth: 430
          });
        });
        $('.sort-select select').on('change',function(e){
          e.preventDefault();
          var selected = $(this).val();
          $('.item-all').hide();
          $('.item-' + selected).show();
        });
        var winWstat, winWstatB;
        $(window).on('resize load',function(){
          var winW = $(window).width();
          winWstatB = winWstat;
          if(winW > 750){
            winWstat = "PC";
            if(winWstat != winWstatB){
              $('.concierge-list > ul').masonry({
                // options
                itemSelector: '.concierge-item',
                columnWidth: 430
              });
            }
          }else{
            winWstat = "mobile";
            if(winWstat != winWstatB){
              $('.concierge-list > ul').masonry({
                // options
                itemSelector: '.concierge-item',
                columnWidth: 430
              });
              $('.concierge-list > ul').masonry('destroy');
            }
          }

          $.colorbox.remove();
          if(winW < 750){
            $('.openmodal').colorbox({rel:'person',inline: true, width: 305, maxWidth: winW-40, maxHeight: "90%"});
          }else{
            $('.openmodal').colorbox({rel:'person',inline: true});
          }
        });
      });
    </script>
