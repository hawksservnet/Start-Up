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
      <div class="col-xs-4">
        <div class="form-group">
          <label>イベント名称</label>
          <?= Form::input('title', Input::get('title'),
              array('class'=>'form-control text white w248','placeholder' => 'イベント名称')); ?></div>
      </div>
      <div class="col-xs-4">
        <div class="form-group">
          <label>オーガナイザ名称</label>
          <?= Form::input('organizer', Input::get('organizer'),
              array('class'=>'form-control text white w248','placeholder' => '主催者')); ?></div>
      </div>
      <div class="col-xs-4">
        <div class="form-group">
          <label>タグ</label>
          <?= Form::input('tag', Input::get('tag'),
              array('class'=>'form-control text white w248','placeholder' => 'タグ')); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <div class="form-group">
          <label>定員数</label>
          <div class="form-inline">
            <input type="text" name="capacity_min" class="form-control text white datepicker"
                   placeholder="定員数（最小）"
                   value="<?php echo Input::get("capacity_min")?:''; ?>"> 〜
            <input type="text" name="capacity_max" class="form-control text white datepicker"
                   placeholder="定員数（最大）"
                   value="<?php echo Input::get("capacity_max")?:''; ?>">
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="form-group">
          <label>開催日</label>
          <div class="form-inline">
            <input type="text" id="start_date_start" name="start_date_start" class="form-control text white datepicker"
                   placeholder="開催日（始）"
                   value="<?php echo Input::get("start_date_start")?:''; ?>"> 〜
           <input type="text" id="start_date_end" name="start_date_end" class="form-control text white datepicker"
                  placeholder="開催日（終）"
                  value="<?php echo Input::get("start_date_end")?:''; ?>">
          </div>
        </div>

        <script type="text/javascript">
          $(function () {
            $('#start_date_start').datetimepicker(datetimepicker_config);
            $('#start_date_end').datetimepicker(datetimepicker_config);
            $("#start_date_start").on("dp.change", function (e) {
              $('#start_date_end').data("DateTimePicker").minDate(e.date);
            });
            $("#start_date_end").on("dp.change", function (e) {
                $('#start_date_start').data("DateTimePicker").maxDate(e.date);
            });
          });
        </script>

      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="form-group">
          <label>キャンセル待ち</label>
          <div class="">
            <label for="is_remaining" class="checkbox-inline no_text"><?php echo Form::checkbox('is_remaining', 1, Input::get('is_remaining'),
              array('id'=>'is_remaining', 'class' => 'seat')); ?> 空きあり
            </label>
            <label for="is_waiting" class="checkbox-inline no_text"><?php echo Form::checkbox('is_waiting', 1, Input::get('is_waiting'),
              array('id'=>'is_waiting', 'class' => 'seat')); ?> キャンセル待ち
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="form-group">
          <label>ステータス</label>
          <div class="">
            <?php foreach ($event_statuses as $key => $event_status): ?>
            <label class="checkbox-inline no_text">
              <?php echo Form::checkbox("statuses[{$event_status->id}]", $event_status->id, Input::get("statuses.{$event_status->id}"),
                array('id'=>'status-'.$event_status->id, 'class' => 'status')); ?> <?= $event_status->name ?>
            </label>
            <?php endforeach?>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="form-group">
          <div class="">
            <label>カテゴリ</label>
            <?php foreach ($categories as $key => $category): ?>
            <label class="checkbox-inline no_text long-label">
              <?php echo Form::checkbox("categories[{$category->id}]",
                         $category->id, Input::get("categories.{$category->id}"),
                         array('id'=>'category-'.$category->id, 'class' => 'category')); ?>
              <?= $category->name ?>
            </label>
            <?php endforeach?>
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


<div class="list_table_wrap">

  <div class="row">
    <div class="col-xs-10">
      <p class="lead"><strong>検索結果<?= $count ?>件</strong></p>
    </div>
    <div class="col-xs-2">
      <a href="<?= Uri::create('admin/events/add') ?>" class="btn btn-primary btn-block">イベント追加</a>
    </div>
  </div>

  <?php if (empty($events)): ?>
  <div id="no-result">検索結果がありません</div>
  <?php else: ?>

    <div class="row">
      <div class="col-sm-12 list_table_wrap">

        <table class="table">
          <tr>
            <th class="">
              <?php $desc = (Input::get('order')=='id')?(!Input::get('desc')):false; ?>
              <a href="<?= Uri::update_query_string(array('order' => 'id', 'desc' => $desc)) ?>">
                ID
              </a>
            </th>
            <th class="">
              <?php $desc = (Input::get('order')=='title')?(!Input::get('desc')):false; ?>
              <a href="<?= Uri::update_query_string(array('order' => 'title', 'desc' => $desc)) ?>">
                名称
              </a>
            </th>
            <th class="">
              <?php $desc = (Input::get('order')=='start_date')?(!Input::get('desc')):false; ?>
              <a href="<?= Uri::update_query_string(array('order' => 'start_date', 'desc' => $desc)) ?>">
                開催日
              </a>
            </th>
            <th class="">
              <?php $desc = (Input::get('order')=='start_time')?(!Input::get('desc')):false; ?>
              <a href="<?= Uri::update_query_string(array('order' => 'start_time', 'desc' => $desc)) ?>">
                開催時間
              </a>
            </th>
            <th class="">
              <?php $desc = (Input::get('order')=='charge')?(!Input::get('desc')):false; ?>
              <a href="<?= Uri::update_query_string(array('order' => 'charge', 'desc' => $desc)) ?>">
                料金
              </a>
            </th>
            <th class="">
              <?php $desc = (Input::get('order')=='capacity')?(!Input::get('desc')):false; ?>
              <a href="<?= Uri::update_query_string(array('order' => 'capacity', 'desc' => $desc)) ?>">
                定員
              </a>
            </th>
            <th class="">
              申込人数
            </th>
            <th class="">
              <?php $desc = (Input::get('order')=='organizer')?(!Input::get('desc')):false; ?>
              <a href="<?= Uri::update_query_string(array('order' => 'organizer', 'desc' => $desc)) ?>">
                主催者
              </a>
            </th>
            <th class="url_column">イベントURL</th>

            <th class="w80"></th>
          </tr>
          <?php foreach($events as $event): ?>
            <tr>
              <td class="center"><?= $event->id; ?></td>
              <td class="center"><?= $event->title; ?></td>
              <td class="center"><?= $event->getStartDate(); ?></td>
              <td class="center"><?= $event->getStartTime(); ?></td>
              <td class="center"><?= $event->charge; ?></td>
              <td class="center"><?= $event->capacity; ?></td>
              <td class="center"><?= $event->getRequestNum(); ?></td>
              <td class="center"><?= $event->getOrganizer(); ?></td>
              <td class="center url_column"><a href="<?= $event->wp_url; ?>" target="_blank"><?= $event->wp_url; ?></a></td>

              <td>
                <a href="<?= Uri::create('admin/events/view/'.$event->id); ?>" class="btn btn-primary btn-xs">　詳細　</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
  <?php endif; ?>

</div><!-- /.list_table_wrap -->

<div class="bottom_ctrl_wrap">
  <?php if (isset($pagination)) { ?>
  <?php echo htmlspecialchars_decode($pagination); ?>
  <?php } ?>
</div><!-- /.bottom_ctrl_wrap -->

<?php echo Form::close() ?>
