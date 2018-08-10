<!-- カレンダーの日本語化 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.min.css">
<script>
  $.datetimepicker.setLocale('ja');
  var datetimepicker_config = {
      lang:'ja',
      timepicker:false,
      useCurrent: false,
      format: 'Y-m-d'
  }
</script>

<?php echo Form::open(array("method"=>"get")) ?>
  <div class="search-area row" style="border: 1px solid #ddd; padding: 20px 0; border-radius: 5px; background: #eee; margin-bottom: 50px;">
    <div class="col-xs-12">
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group"><?= Form::input('userid',Input::get('userid'),
              array('class'=>'form-control text white w248','placeholder' => 'ユーザーID')); ?>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group"><?= Form::input('kana',Input::get('kana'),
              array('class'=>'form-control text white w248','placeholder' => 'よみがな')); ?>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group"><?= Form::input('email',Input::get('email'),
              array('class'=>'form-control text white w248','placeholder' => 'メールアドレス')); ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group"><?= Form::input('name',Input::get('name'),
              array('class'=>'form-control text white w248','placeholder' => '名前')); ?>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group"><?= Form::input('tel',Input::get('tel'),
              array('class'=>'form-control text white w248','placeholder' => '電話番号')); ?>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="selected1" class="checkbox-inline no_text">
              <?php echo Form::checkbox('sex_selected[1]', 1, Input::get('sex_selected.1'),
                array('id'=>'selected1', 'class' => 'type-selection')); ?> 男性
            </label>
            <label for="selected2" class="checkbox-inline no_text">
              <?php echo Form::checkbox('sex_selected[2]', 2, Input::get('sex_selected.2'),
                array('id'=>'selected2', 'class' => 'type-selection')); ?> 女性
            </label>
          </div>
        </div>
        <div class="col-sm-4"></div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group"><?= Form::input('nationality',Input::get('nationality'),
              array('class'=>'form-control text white w248','placeholder' => '国籍')); ?>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <?php echo Form::select('pref', (string) Input::get('pref', isset($user)?$user->pref:''),
                array('' => '都道府県') + Config::get('master.PREFECTURE_CODES'),
                array("class"=>"form-control select half")
            ); ?>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group"><?= Form::input('city',Input::get('city'),
              array('class'=>'form-control text white w248','placeholder' => '市区町村')); ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label>起業についての興味</label>
            <div>
              <label for="interest1" class="checkbox-inline no_text">
                <?php echo Form::checkbox('interest[1]', 1, Input::get('interest.1'),
                  array('id'=>'interest1', 'class' => 'type-selection')); ?> あり
              </label>
              <label for="interest2" class="checkbox-inline no_text">
                <?php echo Form::checkbox('interest[0]', 0, Input::get('interest.0'),
                  array('id'=>'interest2', 'class' => 'type-selection')); ?> なし
              </label>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label>起業への準備</label>
            <div>
              <label for="preparation1" class="checkbox-inline no_text">
                <?php echo Form::checkbox('preparation[1]', 1, Input::get('preparation.1'),
                  array('id'=>'preparation1', 'class' => 'type-selection')); ?> している
              </label>
              <label for="preparation2" class="checkbox-inline no_text">
                <?php echo Form::checkbox('preparation[2]', 2, Input::get('preparation.2'),
                  array('id'=>'preparation2', 'class' => 'type-selection')); ?> 情報収集中
              </label>
              <label for="preparation3" class="checkbox-inline no_text">
                <?php echo Form::checkbox('preparation[0]', 0, Input::get('preparation.0'),
                  array('id'=>'preparation3', 'class' => 'type-selection')); ?> していない
              </label>
            </div>

          </div>

        </div>
        <div class="col-sm-4"></div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group"><?= Form::input('organization',Input::get('organization'),
              array('class'=>'form-control text white w248','placeholder' => '所属組織名')); ?>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group"><?= Form::input('position',Input::get('position'),
              array('class'=>'form-control text white w248','placeholder' => '役職')); ?>
          </div>
        </div>
        <div class="col-sm-4"></div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>生年月（始）〜（終）</label>
            <div class="form-inline">
              <?php foreach (range(1920, date('Y')) as $year) {
                        $years[(string)$year] = $year .'年';
                        if ($year == '1999') $years[''] = '生年';
                    } ?>
              <?php echo Form::select('birthday_start[]', Input::get('birthday_start.0', ''),
                    $years,
                    array("class"=>"form-control select half")
              ); ?>
              <?php echo Form::select('birthday_start[]', Input::get('birthday_start.1', ''),
                    array('' => '月') + Config::get('master.MONTHS'),
                    array("class"=>"form-control select half")
              ); ?>
              <span class="form-control-static">　〜　</span>
              <?php echo Form::select('birthday_end[]', Input::get('birthday_end.0', ''),
                    $years,
                    array("class"=>"form-control select half")
              ); ?>
              <?php echo Form::select('birthday_end[]', Input::get('birthday_end.1', ''),
                    array('' => '月') + Config::get('master.MONTHS'),
                    array("class"=>"form-control select half")
              ); ?>
            </div>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <div class="form-inline">
              <input type="text" id="login_start" name="login_start" class="form-control text white datepicker"
                     placeholder="最終ログイン（始）"
                     value="<?php echo Input::get("login_start")?:''; ?>">
              <span class="form-control-static">　〜　</span>
              <input type="text" id="login_end" name="login_end" class="form-control text white datepicker"
                     placeholder="最終ログイン（終）"
                     value="<?php echo Input::get("login_end")?:''; ?>">
            </div>
          </div>

          <script type="text/javascript">
            $(function () {
              $('#login_start').datetimepicker(datetimepicker_config);
              $('#login_end').datetimepicker(datetimepicker_config);
              $("#login_start").on("dp.change", function (e) {
                $('#login_end').data("DateTimePicker").minDate(e.date);
              });
              $("#login_end").on("dp.change", function (e) {
                  $('#login_start').data("DateTimePicker").maxDate(e.date);
              });
            });
          </script>

        </div>
        
        <div class="col-sm-6">
          <div class="form-group">
            <div class="form-inline">
              <input type="text" id="registration_start" name="registration_start" class="form-control text white datepicker"
                     placeholder="登録日（始）"
                     value="<?php echo Input::get("registration_start")?:''; ?>">
              <span class="form-control-static">　〜　</span>
              <input type="text" id="registration_end" name="registration_end" class="form-control text white datepicker"
                     placeholder="登録日（終）"
                     value="<?php echo Input::get("registration_end")?:''; ?>">
            </div>
          </div>

          <script type="text/javascript">
            $(function () {
              $('#registration_start').datetimepicker(datetimepicker_config);
              $('#registration_end').datetimepicker(datetimepicker_config);
              $("#registration_start").on("dp.change", function (e) {
                $('#registration_end').data("DateTimePicker").minDate(e.date);
              });
              $("#registration_end").on("dp.change", function (e) {
                  $('#registration_start').data("DateTimePicker").maxDate(e.date);
              });
            });
          </script>

        </div>
        <div class="col-sm-4"></div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <?php echo Form::select('group', Input::get('group', isset($user)?$user->group:'1'),
                array('' => '全アカウント種別') + Config::get('master.USER_GROUP'),
                array("class"=>"form-control select half required")
            ); ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <div class="form-group">
            <label>会員種別</label>
            <div>
              <?php foreach(Config::get('master.USER_TYPES') as $key =>$val): ?>
                <label for="type_selected<?= $key; ?>" class="checkbox-inline no_text">
                  <?php echo Form::checkbox('type_selected['.$key.']', $key, Input::get('type_selected.'.$key),
                    array('id'=>'type_selected'.$key, 'class' => 'type-selection')); ?> <?= $val ?>
                </label>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label>DM受取</label>
            <div>
              <label for="mailmagazine_info_selected1" class="checkbox-inline no_text">
                <?php echo Form::checkbox('mailmagazine_info_selected[1]', 1, Input::get('mailmagazine_info_selected.1'),
                  array('id'=>'mailmagazine_info_selected1', 'class' => 'type-selection')); ?> OK
              </label>
              <label for="mailmagazine_info_selected0" class="checkbox-inline no_text">
                <?php echo Form::checkbox('mailmagazine_info_selected[0]', 0, Input::get('mailmagazine_info_selected.0'),
                  array('id'=>'mailmagazine_info_selected0', 'class' => 'type-selection')); ?> NG
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-2">
          <input type="reset" value="クリア" class="btn btn-default btn-lg btn-block"
            onclick="location.href='<?php echo Uri::current() ?>'" />
        </div>
        <div class="col-sm-2">
          <input type="submit" value="検索" class="btn btn-primary btn-lg btn-block" />
        </div>
        <div class="col-sm-4"></div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-8">
      <p class="lead"><strong>現在の総数<?= $total_count ?>名　絞込検索結果<?= $count ?>名</strong></p>
    </div>
    <div class="col-xs-2">
      <?php echo Html::anchor('admin/users/csv_export?'. http_build_query(Input::get()), 'CSVエクスポート',
                              array('class' => "btn btn-primary btn-block")); ?>
    </div>
    <div class="col-xs-2">
      <a href="<?= Uri::create('admin/users/add') ?>" class="btn btn-primary btn-block">メンバー追加</a>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 list_table_wrap">

      <!-- <div class="add_btn">
      <?php //echo Html::anchor('users/csv_export?'. http_build_query(Input::get()), 'CSVエクスポート'); ?>
      </div> -->

      <?php if (empty($users)): ?>
      <div id="no-result" style="margin: 20px;">検索結果がありません</div>
      <?php else: ?>
      <table class="table">
        <tr>
          <th class="w100">
            <?php $desc = (Input::get('order')=='id')?(!Input::get('desc')):false; ?>
            <a href="<?= Uri::update_query_string(array('order' => 'id', 'desc' => $desc)) ?>">
              ユーザーID
            </a>
          </th>
          <th>
            <?php $desc = (Input::get('order')=='name')?(!Input::get('desc')):false; ?>
            <a href="<?= Uri::update_query_string(array('order' => 'name', 'desc' => $desc)) ?>">
              名前
            </a>
          </th>
          <th>
            <?php $desc = (Input::get('order')=='sex')?(!Input::get('desc')):false; ?>
            <a href="<?= Uri::update_query_string(array('order' => 'sex', 'desc' => $desc)) ?>">
              性別
            </a>
          </th>
          <th class="w250">
            <?php $desc = (Input::get('order')=='birthday')?(!Input::get('desc')):false; ?>
            <a href="<?= Uri::update_query_string(array('order' => 'birthday', 'desc' => $desc)) ?>">
              生年月日
            </a>
          </th>
          <th>
            <?php $desc = (Input::get('order')=='pref')?(!Input::get('desc')):false; ?>
            <a href="<?= Uri::update_query_string(array('order' => 'pref', 'desc' => $desc)) ?>">
              都道府県
            </a>
          </th>
          <th>
            <?php $desc = (Input::get('order')=='nationality')?(!Input::get('desc')):false; ?>
            <a href="<?= Uri::update_query_string(array('order' => 'nationality', 'desc' => $desc)) ?>">
              国籍
            </a>
          </th>
          <th>
            <?php $desc = (Input::get('order')=='tel')?(!Input::get('desc')):false; ?>
            <a href="<?= Uri::update_query_string(array('order' => 'tel', 'desc' => $desc)) ?>">
              電話番号
            </a>
          </th>
          <th>
            <?php $desc = (Input::get('order')=='email')?(!Input::get('desc')):false; ?>
            <a href="<?= Uri::update_query_string(array('order' => 'email', 'desc' => $desc)) ?>">
              メールアドレス
            </a>
          </th>
          <th>
            ステータス
          </th>
          <th class="w80"></th>
        </tr>
        <?php foreach($users as $user): ?>
            <?php if(empty($user->stop_flag)): ?>
              <tr>
            <?php else: ?>
              <tr class="cancel">
            <?php endif; ?>
            <td class="center"><?= $user->id ?></td>
            <td><?=$user->getName(); ?></td>
            <td><?=$user->getSex(); ?></td>
            <!-- <td class="center"><= $user->getGroupName(); ></td> -->
            <td class="center"><?= $user->getBirthday(); ?></td>
            <td class="center"><?= $user->getPref(); ?></td>
            <td class="center"><?= $user->nationality; ?></td>
            <td class="center"><?= $user->tel; ?></td>
            <td class="center"><?= $user->email; ?></td>
            <td class="center"><?= $user->getType(); ?></td>
            <td>
              <a href="<?= Uri::create('admin/users/show/'.$user->id); ?>" class="btn btn-primary btn-xs">　詳細　</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
      <?php endif; ?>

    </div><!-- /.list_table_wrap -->
  </div>

  <div class="bottom_ctrl_wrap">
    <?php if (isset($pagination)) { ?>
    <?php echo htmlspecialchars_decode($pagination); ?>
    <?php } ?>
  </div><!-- /.bottom_ctrl_wrap -->
<?php echo Form::close() ?>
