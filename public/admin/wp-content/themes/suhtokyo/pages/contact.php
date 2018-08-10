<?php
/* Template Name: CONTACT */
get_header();
?>

        <h2 id="page-title" class="clearfix">
            <div class="page-title-inner">
                <span class="en">CONTACT US</span>
                <span class="jp">お問い合わせ</span>
            </div>
        </h2>

        <div id="user-registration" class="section-container bg_03">
            <div class="section-inner">
                <div class="section-contents">

                    <div class="contact-container">
                        <dl>
                            <dt>
                                <span class="icon"><img src="<?php echo home_url('/'); ?>assets/img/common/icon_tel.svg"></span>
                                <span class="text">電話でのお問い合わせ</span>
                            </dt>
                            <dd>
                                <p class="link">
                                    <a href="tel:03-6551-2470">03-6551-2470</a>
                                </p>
                                <p class="text">
                                    <span class="bold">受付時間</span>
                                    <span>平日 10:00〜22:00　<br class="sp">土日祝 10:00〜18:00</span>
                                </p>
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                <span class="icon"><img src="<?php echo home_url('/'); ?>assets/img/common/icon_tel.svg"></span>
                                <span class="text">イベント開催のお問い合わせ</span>
                            </dt>
                            <dd>
                                <p class="link">
                                    <a href="tel:03-6551-2610">03-6551-2610</a>
                                </p>
                                <p class="text">
                                    <span class="bold">受付時間</span>
                                    <span>平日 10:00〜18:00(土日祝をのぞく)</span>
                                </p>
                            </dd>
                        </dl>
                    </div>

                    <h2 class="section-title clearfix">
                        <span class="en"><span>CONTACT FORM</span></span>
                        <span class="jp"><span>お問い合わせフォーム</span></span>
                    </h2>

                    <p class="lead">下記フォームに必須項目をご入力いただき、お問い合わせください。</p>
<script>
    setTimeout(function() {
        $('#contact_address').empty();
        var $list = {
            'info@startuphub.tokyo': '施設に関するお問い合わせ',
            'event.info@startuphub.tokyo': 'イベント参加についてのお問い合わせ',
            'press@startuphub.tokyo': '取材に関するお問い合わせ',
            'kidsroom@startuphub.tokyo': '一時保育サービスに関するお問い合わせ',
            'event@startuphub.tokyo': 'イベント開催を希望'
        }
        var $options = $.map($list, function (name, value) {
            $option = $('<option>', { value: value, text: name  });
            return $option;
        });
        $('#contact_address').append($options);

        var contactType = {
            $s :  $('#contact_address'),
            $i :  $('#contact_type'),
        }

        contactType.$i.val(contactType.$s.children(":selected").text());
        contactType.$s.on("change",function(){
            contactType.$i.val($(this).children(":selected").text());
        });
    },500);
</script>
<?php if (have_posts()) : while ( have_posts() ) : the_post();?>
<?php the_content(); ?>
<?php endwhile; endif; ?>

                </div><!-- /.section-contents -->
            </div><!-- /.section-inner -->
        </section><!-- /.section-container -->

<?php get_footer(); ?>
