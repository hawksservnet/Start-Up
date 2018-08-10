    <div id="container" class="event">
      <?php echo Form::open(array("method"=>"get")) ?>
      <div id="main_contents">
        <div id="search_wrap">
          <ul class="clearfix">
                <li>
                  <?= Form::input('title', Input::get('title'),
                      array('class'=>'text white w248','placeholder' => 'イベントID名称')); ?>
                </li>
                <li>
                  <?= Form::input('organizer', Input::get('organizer'),
                      array('class'=>'text white w248','placeholder' => '主催者')); ?>
                </li>
                <li>
                  <div class="date_wrap">
                    <div class="start">
                      <input type="text" name="capacity_min" class="text white datepicker"
                             placeholder="定員数（最小）"
                             value="<?php echo Input::get("capacity_min")?:''; ?>">
                    </div>
                    <div class="end">
                      <input type="text" name="capacity_max" class="text white datepicker"
                             placeholder="定員数（最大）"
                             value="<?php echo Input::get("capacity_max")?:''; ?>">
                    </div>
                  </div>
                </li>
                <li>
                  <label for="is_remaining" class="checkbox no_text">空きあり
                    <?php echo Form::checkbox('is_remaining', 1, Input::post('is_remaining'),
                      array('id'=>'is_remaining', 'class' => 'seat')); ?>
                  </label>
                  <label for="is_waiting" class="checkbox no_text">キャンセル待ち
                    <?php echo Form::checkbox('is_waiting', 1, Input::post('is_waiting'),
                      array('id'=>'is_waiting', 'class' => 'seat')); ?>
                  </label>
                </li>
                <li>
                  <?= Form::input('tag', Input::get('tag'),
                      array('class'=>'text white w248','placeholder' => 'タグ')); ?>
                </li>
                <li>
                  <div class="date_wrap">
                    <div class="start">
                      <input type="text" name="start_date_start" class="text white datepicker"
                             placeholder="開催日（始）"
                             value="<?php echo Input::get("start_date_start")?:''; ?>">
                    </div>
                    <div class="end">
                      <input type="text" name="start_date_end" class="text white datepicker"
                             placeholder="開催日（終）"
                             value="<?php echo Input::get("start_date_end")?:''; ?>">
                    </div>
                  </div>
                </li>
                <li>
                  <label for="status1" class="checkbox no_text">公開
                    <?php echo Form::checkbox('status1', 1, Input::post('status1'),
                      array('id'=>'status1', 'class' => 'status')); ?>
                  </label>
                  <label for="status2" class="checkbox no_text">締め切り済
                    <?php echo Form::checkbox('status2', 1, Input::post('status2'),
                      array('id'=>'status2', 'class' => 'status')); ?>
                  </label>
                  <label for="status3" class="checkbox no_text">非公開
                    <?php echo Form::checkbox('status3', 1, Input::post('status3'),
                      array('id'=>'status3', 'class' => 'status')); ?>
                  </label>
                  <label for="status4" class="checkbox no_text">承認待ち
                    <?php echo Form::checkbox('status4', 1, Input::post('status4'),
                      array('id'=>'status4', 'class' => 'status')); ?>
                  </label>
                </li>
                <li>
                  <label for="category1" class="checkbox no_text">カテゴリ1
                    <?php echo Form::checkbox('category1', 1, Input::post('category1'),
                      array('id'=>'category1', 'class' => 'category')); ?>
                  </label>
                  <label for="category2" class="checkbox no_text">カテゴリ2
                    <?php echo Form::checkbox('category2', 1, Input::post('category2'),
                      array('id'=>'category2', 'class' => 'category')); ?>
                  </label>
                  <label for="category3" class="checkbox no_text">カテゴリ3
                    <?php echo Form::checkbox('category3', 1, Input::post('category3'),
                      array('id'=>'category3', 'class' => 'category')); ?>
                  </label>
                  <label for="category4" class="checkbox no_text">カテゴリ4
                    <?php echo Form::checkbox('category4', 1, Input::post('category4'),
                      array('id'=>'category4', 'class' => 'category')); ?>
                  </label>
                </li>
          </ul>
                
          <ul class="clearfix">
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

        <div class="list_table_wrap">

          <div class="btn_wrap clearfix">
            <div class="add_btn"><a href="<?= Uri::create('events/add') ?>">イベント追加</a></div>
            <div class="add_btn">
              <?php //echo Html::anchor('events/csv_export?'. http_build_query(Input::get()), 'CSVエクスポート'); ?>
            </div>
          </div>

          <?php if (empty($events)): ?>
          <div id="no-result">検索結果がありません</div>
          <?php else: ?>
          <table>
            <tr>
              <th class="">名称</th>
              <th class="">開催日</th>
              <th class="">開催時間</th>
              <th class="">料金</th>
              <th class="">定員</th>
              <th class="">主催者</th>
              <th class="">イベントURL</th>
              
              <th class="w80"></th>
            </tr>
            <?php foreach($events as $event): ?>
              <tr>
                <td class="center"><?= $event->title; ?></td>
                <td class="center"><?= $event->getStartDate(); ?></td>
                <td class="center"><?= $event->getStartTime(); ?></td>
                <td class="center"><?= $event->charge; ?></td>
                <td class="center"><?= $event->capacity; ?></td>
                <td class="center"><?= $event->getOrganizer(); ?></td>
                <td class="center"><?= $event->wp_url; ?></td>
                
                <td>
                  <a href="<?= Uri::create('events/edit/'.$event->id); ?>" class="btn_min black">詳細</a>
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
