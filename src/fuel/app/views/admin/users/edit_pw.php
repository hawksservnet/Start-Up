<h2>パスワード変更</h2>

<form action="<?php echo Uri::create('admin/users/edit_pw/'. $user->id); ?>" method="post">

  <!-- フォーム内容 -->
  <div class="row">
    <div class="col-xs-6">
      <div class="form-group">
        <label>パスワード</label>
        <input type="password" class="form-control text required w346" name="password" id="password"
            value="<?= Input::post("password") ?>">
      </dd>
      </div>
      <div class="form-group">
        <label>パスワード（確認）</label>
        <input type="password" class="form-control text required w346" name="passwordcheck" id="passwordcheck"
            value="<?= Input::post("passwordcheck") ?>">
        <p class="help-block">※確認のためコピーせずにもう一度入力してください</p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-4"></div>
    <div class="col-xs-4">
      <div class="form-action"><button class="btn btn-primary btn-lg btn-block" type="submit">登録・変更する</button></div>
    </div>
  </div>

</form>

<hr>
<?php echo Html::anchor('admin/users/show/'. $user->id, 'ユーザー詳細に戻る', array('class'=>'btn btn-default')); ?>
