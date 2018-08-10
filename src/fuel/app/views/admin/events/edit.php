<style>
    a.glyphicon{
        cursor: pointer;
    }
</style>
<h2>イベント情報編集</h2>

<form action="<?php echo Uri::create('admin/events/edit/'. $event->id); ?>" method="post">

  <!-- フォーム内容 -->
  <?php echo render('admin/events/_form', $this->data); ?>

  <div class="row">
      <div class="col-xs-12 row">
          <div class="col-xs-1">
              <p class="ad-text-header">
                  問診
              </p>
          </div>
          <div class="col-xs-11">
              <div class="col-xs-5">
                  <div class="ad-show-time">
                      <p class="" ></p>
                  </div>
                  <div>
                      <table class="table ad-table-center">
                          <?php if(!empty($event['interview_items'])): ?>
                              <?php
                              $interviews = $event['interview_items'];
                              $totalItem = count($interviews);
                              $cnt = 1;
                              ?>
                              <?php foreach($interviews as $interview): ?>
                                  <tr>
                                      <td class="ad-wrap-btn">
                                          <?php if($cnt > 1): ?>
                                              <a id="sort-up-<?= $cnt ?>" class="glyphicon glyphicon-arrow-up" aria-hidden="true" onclick="sortUp(<?= $cnt ?>);"></a>
                                          <?php endif; ?>
                                          <?php if($cnt < $totalItem): ?>
                                              <a id="sort-down-<?= $cnt ?>" class="glyphicon glyphicon-arrow-down" aria-hidden="true" onclick="sortDown(<?= $cnt ?>);"></a>
                                          <?php endif; ?>
                                      </td>
                                      <td id="interview-item-<?= $cnt ?>" data-sort-no="<?= $interview['sort_no'] ?>">
                                          <?= Form::hidden('sort_no_' . $interview['id'],$interview['sort_no'],
                                              array('id'=>'sort-no-' . $interview['id'],
                                                  'class' => "sort_no_store")) ?>
                                          <p>項目名： <?= htmlentities($interview['item_name']) ?></p>
                                          <p>タイプ： <?= Config::get('master.INTERVIEW_TYPE')[$interview['type']] ?></p>
                                          <?php if($interview['type'] == 2 || $interview['type'] == 3): ?>
                                              <p>選択肢：
                                                  <?php foreach($interview['interview_lists'] as $interviewList): ?>
                                                      <?= ' ' . htmlentities($interviewList['list_text']) ?>
                                                  <?php endforeach; ?>
                                              </p>
                                          <?php endif; ?>
                                      </td>
                                      <td id="interview-item-btn-<?= $cnt ?>">
                                          <a class="btn btn-primary" href="<?= Uri::create("admin/events/interview/" . $event->id . "/" . $interview['id']); ?>">変更</a>
                                      </td>
                                  </tr>
                                  <?php
                                  $cnt = $cnt+1;
                                  ?>
                              <?php endforeach; ?>
                          <?php endif; ?>
                          <tr>
                              <td/>
                              <td/>
                              <td><a class="btn btn-primary" href="<?= Uri::create("admin/events/interview/" . $event->id); ?>">追加</a></td>
                          </tr>
                      </table>
                  </div>
              </div>
          </div>

          <div class="col-xs-1 ad-padding-right-none">
              <p class="ad-text-header">
                  審査有無
              </p>
          </div>
          <div class="col-xs-11 ">
              <div class="col-xs-5">
                  <?php echo Form::checkbox('event_approval', 1, Input::get('event_approval', $event->approval),
                      array('id'=>'event-approval')); ?>
              </div>
          </div>
      </div>
    <div class="col-xs-4"></div>
    <div class="col-xs-4">
      <div class="form-action"><button class="btn btn-primary btn-lg btn-block" type="submit">変更・確認する</button></div>
    </div>
  </div>

</form>
<hr>
<?php if (strpos(Input::referrer(), '/events/')): ?>
  <?php echo Html::anchor('admin/events/view/'. $event->id, 'イベント詳細に戻る', array('class'=>'btn btn-default')); ?>
<?php else: ?>
  <a id="back-btn" class="btn btn-default" onclick="history.back();return false">
    <span>元に戻る</span>
  </a>
<?php endif; ?>
<script>
    function sortUp(cnt, id, preId, total){
        if(cnt <= 0) return false;
        var cur_content = $('#interview-item-'+cnt).html();
        $('#interview-item-'+cnt).html($('#interview-item-'+(cnt-1)).html());
        $('#interview-item-'+(cnt-1)).html(cur_content);

        var cur_btn = $('#interview-item-btn-'+cnt).html();
        $('#interview-item-btn-'+cnt).html($('#interview-item-btn-'+(cnt-1)).html());
        $('#interview-item-btn-'+(cnt-1)).html(cur_btn);

        $('td#interview-item-'+cnt+' input.sort_no_store').val($('td#interview-item-'+cnt).attr('data-sort-no'));
        $('td#interview-item-'+(cnt-1)+' input.sort_no_store').val($('td#interview-item-'+(cnt-1)).attr('data-sort-no'));
        return true;
    }
    function sortDown(cnt, id, nextId, total){
        if(cnt >= total) return false;
        var cur_content = $('#interview-item-'+cnt).html();
        $('#interview-item-'+cnt).html($('#interview-item-'+(cnt+1)).html());
        $('#interview-item-'+(cnt+1)).html(cur_content);

        var cur_btn = $('#interview-item-btn-'+cnt).html();
        $('#interview-item-btn-'+cnt).html($('#interview-item-btn-'+(cnt+1)).html());
        $('#interview-item-btn-'+(cnt+1)).html(cur_btn);

        $('td#interview-item-'+cnt+' input.sort_no_store').val($('td#interview-item-'+cnt).attr('data-sort-no'));
        $('td#interview-item-'+(cnt+1)+' input.sort_no_store').val($('td#interview-item-'+(cnt+1)).attr('data-sort-no'));

        return true;
    }
</script>