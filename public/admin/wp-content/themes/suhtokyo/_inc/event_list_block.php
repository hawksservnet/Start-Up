                        <article class="js__link-box">
                            <p class="photo"><?php $main_image = get_field('main_image');?>
                                <span class="photo-cont">
                                    <a href="<?php the_permalink(); ?>">
                                    <span class="photo-inner" style="background-image: url('<?php echo $main_image["sizes"]["large"]; ?>')"></span>
                                    </a>
                                </span>
                            </p>
                            <?php $get_date = date_create(get_field('open_day'));
                            $week = array("日", "月", "火", "水", "木", "金", "土");
                            $w = (int)date_format($get_date, 'w');
                            ?>
                            <time class="date" data-date="<?php echo date_format($get_date,'Y.m.d'); ?>"><div class="date-inner"><?php echo date_format($get_date,'Y.m.d'); ?> <?php the_field('open_time'); ?></div></time>
                            <div class="text-container">
                                <p class="title"><?php the_title(); ?></p>

								<ul class="category js__st" data-width="100%">

<?php
    $post_cat = get_the_terms(get_post()->ID,"events");
    if(!empty($post_cat)):
?>
<?php
    for( $i=0; $i<count($post_cat); $i++ ){
        if($post_cat[$i]->parent!=0 && get_term($post_cat[$i]->parent,'events')->slug == "type"){
            echo ' <li><a href="'.home_url('/').'event/'.$post_cat[$i]->slug.'/">'.$post_cat[$i]->name.'</a></p>';
        }
      }
?>
<?php endif; ?>
                            <?php if( get_field('cancel')): ?>
                                <li class="list-cancel"><span>キャンセル待ち</span></li>
                            <?php endif; ?>
								</ul>

<?php
    $post_tag = get_the_terms(get_post()->ID,"event_tag");
    if(!empty($post_tag)):
?>
								<ul class="tag-list clearfix">
<?php
    for( $i=0; $i<count($post_tag); $i++ ){
        echo ' <li><a href="'.home_url('/').'event/'.$post_tag[$i]->slug.'/">'.$post_tag[$i]->name.'</a></li>';
    }
?>
								</ul>
<?php endif; ?>
                            </div>
                        </article>