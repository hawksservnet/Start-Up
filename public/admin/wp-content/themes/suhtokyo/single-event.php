<?php get_header(); ?>

	<h2 id="page-title" class="clearfix">
            <div class="page-title-inner">
                <span class="en">EVENTS</span>
                <span class="jp">イベント</span>
            </div>
        </h2>

        <div class="section-container">
            <div class="section-inner">
                <div class="section-contents bg_01">

                    <article id="events-detail-container">

                        <section id="events-main" class="detail-section-container">
                            <div class="events-title-container">
                                <div class="events-title-inner">
                                    <?php $get_date = date_create(get_field('open_day'));
                                    $week = array("日", "月", "火", "水", "木", "金", "土");
                                    $w = (int)date_format($get_date, 'w');
                                    ?>
                                    <time class="date"><div class="date-inner"><?php echo date_format($get_date,'Y.m.d'); ?> <?php the_field('open_time'); ?></div></time>
                                    <h3 class="title"><?php the_title(); ?></h3>
<!--
                                    <p class="category">カテゴリA</p>
-->
                                </div>
                            </div><!-- /.events-title-container -->
                            <?php if(!post_password_required()): ?>
                            <?php if( get_field('cancel')): ?>
                            <div class="cancel-container">
                                <p class="text">キャンセル待ち</p>
                            </div>
                            <?php endif; ?>

                            <?php $main_image = get_field('main_image');?>
                            <?php  if($main_image): ?>
                            <p class="photo">
                                <span class="photo-inner pc">
                                <img src="<?php echo $main_image["sizes"]["large"]; ?>" alt="">
                                </span>
                                <span class="photo-inner sp" style="background-image: url('<?php echo $main_image["sizes"]["large"]; ?>')"></span>
                            </p>
                            <?php endif; ?>


                           <?php  if(get_field('main_text')): ?>
                            <div class="text-container">
                                <p class="text"><?php the_field('main_text'); ?></p>
                            </div>
                            <?php endif; ?>

                            <?php  if(get_field('venue_address')): ?>
                            <div class="info-container clearfix">
                                <div class="table-container">
                                    <table>
                                        <?php  if(get_field('open_time')): ?>
                                        <tr>
                                            <th>日時</th>
                                            <td><?php echo date_format($get_date,'Y年m月d日'); ?><?php echo '（'.$week[$w].'）'; ?> <?php the_field('open_time'); ?></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php  if(get_field('reception_time')): ?>
                                        <tr>
                                            <th>開場時間</th>
                                            <td><?php the_field('reception_time'); ?></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php  if(get_field('price')): ?>
                                        <tr>
                                            <th>料金</th>
                                            <td><?php the_field('price'); ?></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php  if(get_field('capacity')): ?>
                                        <tr>
                                            <th>定員</th>
                                            <td><?php the_field('capacity'); ?>名</td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php  if(get_field('venue_address')): ?>
                                        <tr>
                                            <th>会場</th>
                                            <?php $address = get_field('venue_address');
                                            $lat = $address['lat'];
                                            $lng = $address['lng'];
                                            $address = $address['address']; ?>
                                            <td><?php the_field('venue_name'); ?><br><?php echo $address; ?></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php  if(get_field('organizer')): ?>
                                        <tr>
                                            <th>主催者</th>
                                            <td><?php the_field('organizer'); ?></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php  if(get_field('url')): ?>
                                        <tr>
                                            <th>URL</th>
                                            <td><a href="<?php the_field('url'); ?>" target="_blank"><?php the_field('url'); ?><span class="icon blank"></span></a></td>
                                        </tr>
                                        <?php endif; ?>
                                    </table>
                                </div><!-- /.table-container -->
                                <div class="map-container">
                                    <div id="map" data-lat="<?php echo $lat; ?>" data-lng="<?php echo $lng; ?>"></div>
                                </div><!-- /.map-container -->
                            </div>
                            <?php endif; ?>

                            <div class="btn center icon-none w160 h35 sp">
                                <div class="btn-inner clear">
                                    <a href="http://maps.google.com/maps?q=<?php echo $lat; ?>%2C<?php echo $lng; ?>&oe=utf-8">
                                        <span class="text jp">アプリで見る</span>
                                    </a>
                                    <div class="line"></div>
                                    <div class="line2"></div>
                                </div>
                            </div>

                            <?php if( get_field('application')): ?>
                            <form action="<?php echo $USER_SITE_URL; ?>event/requests/add">
                                <input name="event_id" type="hidden" value="<?php the_field('id'); ?>">
                                <div class="btn center">
                                    <div class="btn-inner black">
                                        <button type="submit">
                                            <span class="text jp">参加申し込み</span>
                                        </button>
                                        <div class="line"></div>
                                        <div class="line2"></div>
                                    </div>
                                </div>
                            </form>
                            <?php endif; ?>
						<center><p class="text" style="width: 70%;border-width:1px; border-style:solid;padding:10px;font-size: x-small; ">
						<?php if( get_field('application')): ?>
・不測の事故、天災地変の発生、官公署の命令・指導、交通機関のストライキ・遅延などで東京都及び運営事務局が当施設の利用を不可能と判断した場合、<br>
または、主催者の都合やイベントを開催できない事由などにより、イベントの実施が困難と東京都及び運営事務局の判断した場合、<br>
当イベントを中止する場合がございますので、予めご了承下さい。中止の際のお知らせはメールとStartup Hub Tokyoホームページのinformationにて行います。<br>
・当イベントへの参加に当たっては、<a href="<?php echo home_url('/terms/'); ?>" target="_blank">「利用規約」</a>のリンク先で内容をご確認いただき、ご同意の上、お申し込み願います。<br>
						<?php else: ?>
・不測の事故、天災地変の発生、官公署の命令・指導、交通機関のストライキ・遅延などで東京都及び運営事務局が当施設の利用を不可能と判断した場合、<br>
または、主催者の都合やイベントを開催できない事由などにより、イベントの実施が困難と東京都及び運営事務局の判断した場合、<br>
当イベントを中止する場合がございますので、予めご了承下さい。中止の際のお知らせはStartup Hub Tokyoホームページのinformationにて行います。
						<?php endif; ?>
						</p></center>
						<br>
                            <?php else: ?>

                            <?php the_content(); ?>

                            <?php endif; ?>

                        </section><!-- /.detail-section-container -->

                        <?php if(!post_password_required()): ?>
                        <?php if(get_field('free_area')): ?>
                        <section id="free-area" class="detail-section-container">

                            <?php the_field('free_area'); ?>


                            <?php if( get_field('application')): ?>
                            <form action="<?php echo $USER_SITE_URL; ?>event/requests/add">
                                <input name="event_id" type="hidden" value="<?php the_field('id'); ?>">
                                <div class="btn center">
                                    <div class="btn-inner black">
                                        <button type="submit">
                                            <span class="text jp">参加申し込み</span>
                                        </button>
                                        <div class="line"></div>
                                        <div class="line2"></div>
                                    </div>
                                </div>
                            </form>
						<br>
                            <?php endif; ?>
						
						<?php if( get_field('application')): ?>
						<center><p class="text" style="width: 70%;border-width:1px; border-style:solid;padding:10px;font-size: x-small; ">
・不測の事故、天災地変の発生、官公署の命令・指導、交通機関のストライキ・遅延などで東京都及び運営事務局が当施設の利用を不可能と判断した場合、<br>
または、主催者の都合やイベントを開催できない事由などにより、イベントの実施が困難と東京都及び運営事務局の判断した場合、<br>
当イベントを中止する場合がございますので、予めご了承下さい。中止の際のお知らせはメールとStartup Hub Tokyoホームページのinformationにて行います。<br>
・当イベントへの参加に当たっては、<a href="<?php echo home_url('/terms/'); ?>" target="_blank">「利用規約」</a>のリンク先で内容をご確認いただき、ご同意の上、お申し込み願います。<br>
						<?php else: ?><br>
						<center><p class="text" style="width: 70%;border-width:1px; border-style:solid;padding:10px;font-size: x-small; ">
・不測の事故、天災地変の発生、官公署の命令・指導、交通機関のストライキ・遅延などで東京都及び運営事務局が当施設の利用を不可能と判断した場合、<br>
または、主催者の都合やイベントを開催できない事由などにより、イベントの実施が困難と東京都及び運営事務局の判断した場合、<br>
当イベントを中止する場合がございますので、予めご了承下さい。中止の際のお知らせはStartup Hub Tokyoホームページのinformationにて行います。
						<?php endif; ?>
						</p></center>
						<br>
                        </section><!-- /.detail-section-container -->
                        <?php endif; ?>
                        <?php endif; ?>

                        <div id="detail-cat_tag-container" class="clearfix">
<?php
    $post_cat = get_the_terms(get_post()->ID,"events");
    for( $i=0; $i<count($post_cat); $i++ ){
        if($post_cat[$i]->parent!=0 && get_term($post_cat[$i]->parent,'events')->slug == "type"){
            echo ' <p class="category"><a href="'.home_url('/').'events/'.$post_cat[$i]->slug.'/">'.$post_cat[$i]->name.'</a></p>';
        }
    }
?>
<?php
    $post_tag = get_the_terms(get_post()->ID,"event_tag");
    if(!empty($post_tag)):
?>
                                <ul class="tag-list clearfix">
<?php
    for( $i=0; $i<count($post_tag); $i++ ){
        echo ' <li><a href="'.home_url('/').'event_tag/'.$post_tag[$i]->slug.'/">'.$post_tag[$i]->name.'</a></li>';
    }
?>
                                </ul>
<?php endif; ?>
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
                            <a href="<?php echo home_url('/event/'); ?>">
                                <span class="text en">BACK TO LIST</span>
                            </a>
                            <div class="line"></div>
                            <div class="line2"></div>
                        </div>
                    </div>


                </div><!-- /.section-contents -->



            </div><!-- /.section-inner -->
        </section><!-- /.section-container -->


<?php get_footer(); ?>
