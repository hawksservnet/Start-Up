<h2>イベント情報登録</h2>

<form action="<?php echo Uri::create("admin/events/add"); ?>" method="post">

  <!-- フォーム内容 -->
  <?php echo render('admin/events/_form', $this->data); ?>

  <div class="row">
      <div class="col-xs-12 row">
          <div class="col-xs-1 ad-padding-right-none">
              <p class="ad-text-header">
                  審査有無
              </p>
          </div>
          <div class="col-xs-11 ">
              <div class="col-xs-5">
                  <?php echo Form::checkbox('event_approval', 1, Input::get('event_approval', (isset($event->approval)?$event->approval:0)),
                      array('id'=>'event-approval')); ?>
              </div>
          </div>
      </div>
    <div class="col-xs-4"></div>
    <div class="col-xs-4">
      <div class="form-action"><button class="btn btn-primary btn-lg btn-block" type="submit">追加・確認する</button></div>
    </div>
  </div>

</form>
<hr>
<?php echo Html::anchor('admin/events', 'イベント一覧に戻る', array('class'=>'btn btn-default')); ?>
