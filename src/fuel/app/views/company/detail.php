<div id="company_wrap">
  <div class="kv_wrap">
    <?php if($company->photo_path): ?> 
    <h3 class="name"><img src="<?php echo $company->photo_path ?>" alt="<?php echo $company->name ?>"></h3>
    <?php endif; ?>
    <p><?php echo $company->name ?></p>
  </div>
  <?php if($company->overview): ?> 
  <div class="company_inner">
    <p class="company_text">
    <?php echo nl2br($company->overview) ?></p>
  </div>
  <?php endif; ?>
  <div class="text">
    弊社管理のステーション、ポートにつきましては以下のフリーダイヤルまたはメールアドレス宛にお問合わせ下さい。
  </div>
  <?php if(!empty($company->tel)): ?>
  <h3 class="sub_title">電話でのお問い合わせ</h3>
  <div class="form_content text">
    <p class="text_guide">営業時間内の対応とさせていただきます。時間帯によっては混み合う場合がございます。予めご了承下さい。</p>
    <div>
      <?php if(!empty($company->tel)): ?>
      <ul>
        <li><a href="tel:<?php echo $company->tel ?>" class="free_tel"><?php echo $company->tel ?></a></li>
      </ul>
      <?php endif; ?>
      <?php if(!empty($company->getBusinessHourInfo())): ?>
      <ul class="rest">
        <li><p>営業時間　<?php echo $company->getBusinessHourInfo(); ?></p></li>
      </ul>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>
  <?php if(!empty($company->email)): ?>
  <h3 class="sub_title">メールでのお問い合わせ</h3>
  <div class="form_content text">
    <p class="text_guide">営業時間内でのご回答とさせていただきます。時間帯によってはご連絡までにお時間がかかる場合がございます。予めご了承下さい。</p>
    <div>
      <ul>
        <li><a href="mailto:<?php echo $company->email ?>" class="mail"><?php echo $company->email ?></a></li>
      </ul>
    </div>
  </div>
  <?php endif; ?>
  <?php if(!empty($company->site_url)): ?>
  <h3 class="sub_title">WEBSITE</h3>
  <div class="form_content text">
    <p class="text_guide">サービスの詳しい情報はウェブサイトをご覧ください。</p>
    <div>
      <ul>
        <li><a href="<?php echo $company->site_url ?>" target="_blank"><?php echo $company->site_url ?></a></li>
      </ul>
    </div>
  </div>
  <?php endif; ?>

<div id="company_wrap">
  <h3 class="sub_title">運営会社情報</h3>
  <div class="logo_wrap">
    <h4><img src="<?php echo $company->photo_path ?>" alt="COGICOGI"></h3>
  </div>

  <table class="company_info_block">
    <tr>
      <th>社名</th>
      <td><?php echo $company->name ?></td>
    </tr>
    <tr>
      <th>設立</th>
      <td><?php echo $company->establish_date ?></td>
    </tr>
    <tr>
      <th>代表取締役</th>
      <td><?php echo $company->ceo_name ?></td>
    </tr>
    <tr>
      <th>主要株主</th>
      <td><?php echo nl2br($company->major_shareholder) ?></td>
    </tr>
    <tr>
      <th>事務所所在地</th>
      <td><?php echo $company->getAddress() ?></td>
    </tr>
    <tr>
      <th>資本金</th>
      <td><?php echo $company->capital ?></td>
    </tr>
    <tr>
      <th>事業内容</th>
      <td><?php echo $company->business ?></td>
    </tr>
  </table>

</div><!-- /#map_wrap -->


  <!--
  <p class="sub_title">共有エリア</p>
  <div class="company_inner">
    <ul class="share_area clearfix">
      <li>千代田区</li>
      <li>港区</li>
      <li>中央区</li>
      <li>千代田区</li>
      <li>港区</li>
    </ul>
    <div class="btn_box">
      <a href="company_03.php">MAPで見る</a>
    </div>
  </div>
  -->

  <!-- <p class="sub_title">自転車の仕様</p>
  <ul class="specification">
		<?php foreach( $company->bikes as $bike ) : ?>
	    <li>
	      <div class="clearfix">
          <?php if($bike->photo_path): ?> 
          <img src="<?php echo $bike->photo_path ?>">
          <?php else: ?>
          <span class="no_image" style="background-image: url(<?php echo Asset::get_file('common/no_image.png', 'img'); ?>);"></span>
          <?php endif; ?>
	        <div class="text_area">
	          <p class="title"><?php echo $bike->category ? $bike->category->name : $bike->code; ?></p>
	          <table>
	            <tr>
	              <th>サイズ</th>
	              <td>26インチ</td>
	            </tr>
	            <tr>
	              <th>かご</th>
	              <td>有り</td>
	            </tr>
	            <tr>
	              <th>鍵</th>
	              <td>4桁の暗証番号</td>
	            </tr>
	          </table>
	        </div>
	      </div>
	      <p class="text">ダミーダミー内装3段変速機、ローラーブレーキなどを備えたスタンダードタイプ。カゴ、オートライト、泥よけ、鍵、軽量アルミフレームの他、高品質なドイツ製シュワルベタイヤを装着。</p>
	      <div class="info_wrap">
	        <p class="title">ご利用料金</p>
	        <p class="content">
              ¥<?php echo number_format($bike->hour_price) ?> / 1時間あたり<br>
              ¥<?php echo number_format($bike->day_price)  ?> / 1日あたり -->
              <!-- 他社ステーション乗入れ 貸出<?php echo $bike->rent_percentage ?>% / 返却<?php echo $bike->return_percentage ?>% -->
	        <!-- </p>
	      </div>
	    </li>
		<?php endforeach; ?>
  </ul> -->

  <!-- <p class="sub_title">レンタルプラン</p>
  <div class="plan_list_area">
    <ul class="plan_list">
      <li>
        <div class="plan_name">
          <div class="plan_name_inner">
            <p class="type">月額会員</p>
            <p class="fee">2,000円 ＋ 延長料金</p><span></span>
          </div>
        </div>
        <div class="plan_contents">
          <p class="title">頻繁にご利用される方向けの乗り放題</p>
          <ul>
            <li>月額会費 2,000円<br>毎回1時間以内の利用であれば何回でも利用可能</li>
            <li>1時間を超過した利用をした場合は超過1時間毎に100円の延長料金</li>
            <li>表示は税抜きです。上記金額には、別途消費税が加算されます。</li>
          </ul>
        </div>
      </li>
    </ul>
    <ul class="plan_list">
      <li>
        <div class="plan_name">
          <div class="plan_name_inner">
            <p class="type">一日会員</p>
            <p class="fee">1,500円 ＋ 延長料金</p><span></span>
          </div>
        </div>
        <div class="plan_contents">
          <p class="title">頻繁にご利用される方向けの乗り放題</p>
          <ul>
            <li>月額会費 2,000円<br>毎回1時間以内の利用であれば何回でも利用可能</li>
            <li>1時間を超過した利用をした場合は超過1時間毎に100円の延長料金</li>
            <li>表示は税抜きです。上記金額には、別途消費税が加算されます。</li>
          </ul>
        </div>
      </li>
    </ul>
    <ul class="plan_list">
      <li>
        <div class="plan_name">
          <div class="plan_name_inner">
            <p class="type">ダミー会員</p>
            <p class="fee">3,500円 ＋ 延長料金</p><span></span>
          </div>
        </div>
        <div class="plan_contents">
          <p class="title">頻繁にご利用される方向けの乗り放題</p>
          <ul>
            <li>月額会費 2,000円<br>毎回1時間以内の利用であれば何回でも利用可能</li>
            <li>1時間を超過した利用をした場合は超過1時間毎に100円の延長料金</li>
            <li>表示は税抜きです。上記金額には、別途消費税が加算されます。</li>
          </ul>
        </div>
      </li>
    </ul>
  </div> -->

  <!-- <div id="port_menu_wrap" class="bg_black_wrap fixed_bottom">
    <div class="menu_wrap">
      <div class="btn black company center">
        <a onClick="history.back();">
          <span>ステーション詳細へもどる</span>
        </a>
      </div>
    </div>
  </div> -->


</div><!-- /#map_wrap -->
