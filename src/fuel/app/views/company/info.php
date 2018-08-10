<div id="company_wrap">
  <div class="logo_wrap">
    <h3><img src="<?php echo $company->photo_path ?>" alt="COGICOGI"></h3>
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
      <th>TEL</th>
      <td><?php echo $company->tel ?></td>
    </tr>
    <tr>
      <th>E-MAIL</th>
      <td><?php echo $company->email ?></td>
    </tr>
    <tr>
      <th>URL</th>
      <td><?php echo $company->site_url ?></td>
    </tr>
    <tr>
      <th>営業時間</th>
      <td><?php echo $company->getBusinessHourInfo() ?></td>
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
