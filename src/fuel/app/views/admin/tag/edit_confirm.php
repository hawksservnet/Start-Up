<h2>タグ登録確認</h2>

<div class="confirm">
  <strong>タグ名：</strong>
  <div><?php echo $tag->name; ?></div>
</div>
<br />

<form method="post">
  <div class="row">
    <div class="col-xs-4">
      <a class="btn btn-default" id="back-btn" onclick="history.back();return false">戻る</a>
    </div>
    <div>
      <?php echo Form::submit('submit', '登録する', array('class' => 'btn btn-primary')); ?>
    </div>
  </div>
<?php echo Form::close(); ?>
