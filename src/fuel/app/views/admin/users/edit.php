<h2>メンバー情報編集</h2>

<form method="post">

  <!-- フォーム内容 -->
  <?php echo render('admin/users/_form', compact('user', 'jobs')); ?>

  <div class="row">
    <div class="col-xs-4"></div>
    <div class="col-xs-4">
      <div class="form-action"><button class="btn btn-primary btn-lg btn-block" type="submit">登録・確認する</button></div>
    </div>
  </div>

</form>
<hr>
<?php echo Html::anchor('admin/users/show/'. $user->id, 'メンバー詳細に戻る', array('class'=>'btn btn-default')); ?>
