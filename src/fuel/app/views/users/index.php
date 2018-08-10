    <div id="container" class="user">
      <?php echo Form::open(array("method"=>"get")) ?>
      <div id="main_contents">
        <div id="search_wrap">
          <ul class="clearfix">
                <li><?= Form::input('find',Input::get('find'),
                    array('class'=>'text white w248','placeholder' => 'ユーザーID, 名前')); ?>
                </li>
                <li><?= Form::input('email',Input::get('email'),
                    array('class'=>'text white w248','placeholder' => 'メールアドレス')); ?>
                </li>
                <li><?= Form::input('tel',Input::get('tel'),
                    array('class'=>'text white w248','placeholder' => '電話番号')); ?>
                </li>
                <li>
                  <label for="selected1" class="checkbox no_text">男性
                    <?php echo Form::checkbox('sex_selected[1]', 1, Input::post('selected1'),
                      array('id'=>'selected1', 'class' => 'type-selection')); ?>
                  </label>
                  <label for="selected2" class="checkbox no_text">女性
                    <?php echo Form::checkbox('sex_selected[2]', 1, Input::post('selected2'),
                      array('id'=>'selected2', 'class' => 'type-selection')); ?>
                  </label>
                </li>
                <li><?= Form::input('nationality',Input::get('nationality'),
                    array('class'=>'text white w248','placeholder' => '国籍')); ?>
                </li>
                <li>
                  <?php echo Form::select('pref', (string) Input::post('pref', isset($user)?$user->pref:''),
                      array('' => '都道府県') + Config::get('master.PREFECTURE_CODES'),
                      array("class"=>"select half")
                  ); ?>
                </li>
                <li><?= Form::input('city',Input::get('city'),
                    array('class'=>'text white w248','placeholder' => '市区町村')); ?>
                </li>
                <li><?= Form::input('organization',Input::get('organization'),
                    array('class'=>'text white w248','placeholder' => '所属組織名')); ?>
                </li>
                <li><?= Form::input('position',Input::get('position'),
                    array('class'=>'text white w248','placeholder' => '役職')); ?>
                </li>
                <li>
                  <div class="date_wrap">
                    <div class="start">
                      <input type="text" name="birthday_start" class="text white datepicker"
                             placeholder="生年月日（始）"
                             value="<?php echo Input::get("birthday_start")?:''; ?>">
                    </div>
                    〜
                    <div class="end">
                      <input type="text" name="birthday_end" class="text white datepicker"
                             placeholder="生年月日（終）"
                             value="<?php echo Input::get("birthday_end")?:''; ?>">
                    </div>
                  </div>
                </li>
                <li>
                  <div class="date_wrap">
                    <div class="start">
                      <input type="text" name="registration_start" class="text white datepicker"
                             placeholder="登録日（始）"
                             value="<?php echo Input::get("registration_start")?:''; ?>">
                    </div>
                    〜
                    <div class="end">
                      <input type="text" name="registration_end" class="text white datepicker"
                             placeholder="登録日（終）"
                             value="<?php echo Input::get("registration_end")?:''; ?>">
                    </div>
                  </div>
                </li>
                <li>
                  <div class="date_wrap">
                    <div class="start">
                      <input type="text" name="login_start" class="text white datepicker"
                             placeholder="最終ログイン（始）"
                             value="<?php echo Input::get("login_start")?:''; ?>">
                    </div>
                    〜
                    <div class="end">
                      <input type="text" name="login_end" class="text white datepicker"
                             placeholder="最終ログイン（終）"
                             value="<?php echo Input::get("login_end")?:''; ?>">
                    </div>
                  </div>
                <li>
                  <?php echo Form::select('group', Input::post('group', isset($user)?$user->group:''),
                      array('' => 'アカウント種別') + Config::get('master.USER_GROUP'),
                      array("class"=>"select half required")
                  ); ?>
                </li>
                <li>
                  <label for="selected1" class="checkbox no_text"><?= Config::get('master.USER_TYPES')[1] ?>
                    <?php echo Form::checkbox('type_selected[1]', 1, Input::post('selected1'),
                      array('id'=>'selected1', 'class' => 'type-selection')); ?>
                  </label>
                  <label for="selected2" class="checkbox no_text"><?= Config::get('master.USER_TYPES')[2] ?>
                    <?php echo Form::checkbox('type_selected[2]', 1, Input::post('selected2'),
                      array('id'=>'selected2', 'class' => 'type-selection')); ?>
                  </label>
                  <label for="selected3" class="checkbox no_text"><?= Config::get('master.USER_TYPES')[3] ?>
                    <?php echo Form::checkbox('type_selected[3]', 1, Input::post('selected3'),
                      array('id'=>'selected3', 'class' => 'type-selection')); ?>
                  </label>
                  <label for="selected999" class="checkbox no_text"><?= Config::get('master.USER_TYPES')[999] ?>
                    <?php echo Form::checkbox('type_selected[999]', 1, Input::post('selected999'),
                      array('id'=>'selected999', 'class' => 'type-selection')); ?>
                  </label>
                  <label for="selected-1" class="checkbox no_text"><?= Config::get('master.USER_TYPES')[-1] ?>
                    <?php echo Form::checkbox('type_selected[-1]', 1, Input::post('selected-1'),
                      array('id'=>'selected-1', 'class' => 'type-selection')); ?>
                  </label>
                </li>
                <li>
                  <label for="selected1" class="checkbox no_text">受け取る
                    <?php echo Form::checkbox('mailmagazine_info_selected[1]', 1, Input::post('selected1'),
                      array('id'=>'selected1', 'class' => 'type-selection')); ?>
                  </label>
                  <label for="selected0" class="checkbox no_text">受け取らない
                    <?php echo Form::checkbox('mailmagazine_info_selected[0]', 1, Input::post('selected0'),
                      array('id'=>'selected0', 'class' => 'type-selection')); ?>
                  </label>
                </li>


                
                <li>
                  <p class="search_btn">
                  <input type="reset" value="クリア" class="btn_mid gray"
                    onclick="location.href='<?php echo Uri::current() ?>'" />
                  </p>
                </li>
                <li>
                  <p class="search_btn">
                  <input type="submit" value="検索" class="btn_mid black" />
                  </p>
                </li>
          </ul>
        </div><!-- /#search_wrap -->

        <div class="list-info">
          <h3>現在の総登録会員数<?= $total_count ?>名</h3>
          <h3>絞込検索結果<?= $count ?>名</h3>
        </div>
        
        <div class="list_table_wrap">

          <!-- <div class="btn_wrap clearfix">
          <div class="add_btn"><a href="users/add">ユーザー追加</a></div>
          <div class="add_btn">
          <?php //echo Html::anchor('users/csv_export?'. http_build_query(Input::get()), 'CSVエクスポート'); ?>
          </div>
          </div> -->

          <?php if (empty($users)): ?>
          <div id="no-result">検索結果がありません</div>
          <?php else: ?>
          <table>
            <tr>
              <!-- <th class="w100">ユーザーID</th> -->
              <th>名前</th>
              <th>性別</th>
              <!-- <th class="w250">アカウント種別</th>
              <th class="w250">メンバー種別</th> -->
              <th class="w250">生年月日</th>
              <th>都道府県</th>
              <th>国籍</th>
              <th>電話番号</th>
              <th>メールアドレス</th>
              <th class="w80"></th>
            </tr>
            <?php foreach($users as $user): ?>
                <?php if(empty($user->stop_flag)): ?>
                  <tr>
                <?php else: ?>
                  <tr class="cancel">
                <?php endif; ?>
                <!-- <td class="center"><= $user->id; ></td> -->
                <td><?=$user->getName(); ?></td>
                <td><?=$user->getSex(); ?></td>
                <!-- <td class="center"><= $user->getGroupName(); ></td>
                <td class="center"><= $user->getType(); ></td> -->
                <td class="center"><?= $user->getBirthday(); ?></td>
                <td class="center"><?= $user->getPref(); ?></td>
                <td class="center"><?= $user->nationality; ?></td>
                <td class="center"><?= $user->tel; ?></td>
                <td class="center"><?= $user->email; ?></td>
                <td>
                  <a href="<?= Uri::create('users/edit/'.$user->id); ?>" class="btn_min black">詳細</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
          <?php endif; ?>

        </div><!-- /.list_table_wrap -->

        <div class="bottom_ctrl_wrap">
          <?php if (isset($pagination)) { ?>
          <?php echo htmlspecialchars_decode($pagination); ?>
          <?php } ?>
        </div><!-- /.bottom_ctrl_wrap -->
      </div><!-- /#main_contents -->
      <?php echo Form::close() ?>
    </div>
