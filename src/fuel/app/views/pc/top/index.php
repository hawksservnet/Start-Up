<script>
var portURL = "<?php echo Uri::create("port/detail/") ?>";
var url_port_json   = "<?php echo Uri::create("top/port_json") ?>";
var page_id   = "<?php echo $page_id ?>";
var google_api_key = "<?php echo Config::get('master.GOOGLE_MAPS_API_KEY'); ?>";

var now_lat = 35.681382;
var now_lon = 139.76608399999998;

</script>

<div id="map_wrap">
  <div id="map"></div>  
  <!-- <div id="google_map"></div> -->

  <div id="detail_wrap">
    <div id="detail_inner">

      <div id="port_detail" class="detail_content">
        <div class="detail_content_inner">
          <div class="photo" style="background-image:url(<?= Asset::get_file('map/img_port.jpg','img'); ?>);"></div>
          <div class="detail_title">
            <a class="op_hover" href="#">
              <span class="name">新橋第2ポート</span>
              <span class="text icon_map">東京都中央区銀座8-15-2</span>
            </a>
          </div>
          <div class="enter_status">
            <div class="detail_list station">
              <ul>
                <li>
                  <dl>
                    <dt>URL：</dt>
                    <dd class="url"><a href="xxxxxxxxxxxxx.co.jp" target="_blank">xxxxxxxxxxxxx.co.jp</a></dd>
                  </dl>
                </li>
                <li>
                  <dl>
                    <dt>営業時間：</dt>
                    <dd>24時間</dd>
                  </dl>
                </li>
                <li>
                  <dl>
                    <dt>TEL：</dt>
                    <dd class="tel"><a href="tel:052-962-1011">052-962-1011</a></dd></dd>
                  </dl>
                </li>
              </ul>
            </div><!-- /.detail_list -->
            <!-- <div class="detail_sec_title">
              <dl class="clearfix">
                <dt class="enter">入庫状況</dt>
                <dd><span class="num">5</span>台/最大<span class="max-num">15</span>台</dd>
              </dl>
            </div> -->
            <div class="rent_res_wrap clearfix">
              <dl class="clearfix">
                <dt class="enter">貸出可能</dt>
                <dd class="num">0</dd>
              </dl>
              <dl class="clearfix">
                <dt class="enter">返却可能</dt>
                <dd class="max-num">0</dd>
              </dl>
            </div>
            <div class="detail_list bike">
              <div class="title bike">設置車両</div>
              <ul>
                <li class="clearfix">
                  <span class="bike_photo" style="background-image:url(<?= Asset::get_file('map/img_bicycle.jpg','img'); ?>);"></span>
                  <dl>
                    <dt><a href="07_2_resource-bicycle_detail.php">電動アシスト自転車</a></dt>
                    <dd>
                      <span class="title_min">車両番号</span>
                      <span class="text_min">0000000</span>
                    </dd>
                    <dd>
                      <span class="title_min">利用料金</span>
                      <span class="text_min block">¥0 / 1時間あたり<br>
                      ¥0 / 1日あたり</span>
                    </dd>
                  </dl>
                </li>
                <li class="clearfix">
                  <span class="bike_photo" style="background-image:url(<?= Asset::get_file('map/img_bicycle.jpg','img'); ?>);"></span>
                  <dl>
                    <dt><a href="07_2_resource-bicycle_detail.php">電動アシスト自転車</a></dt>
                    <dd>
                      <span class="title_min">車両番号</span>
                      <span class="text_min">0000000</span>
                    </dd>
                    <dd>
                      <span class="title_min">利用料金</span>
                      <span class="text_min block">¥0 / 1時間あたり<br>
                      ¥0 / 1日あたり</span>
                    </dd>
                  </dl>
                </li>
              </ul>
            </div><!-- /.detail_list -->
          </div>
        </div><!-- /.detail_content_inner -->
      </div><!-- /#port_detail -->

    </div><!-- /#detail_inner -->
  </div><!-- /#detail_wrap -->

</div>