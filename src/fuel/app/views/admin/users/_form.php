<div class="row">
  <div class="col-xs-6">
    <div class="form-group">
      <label>お名前</label>
      <div class="form-inline">
        <input type="text" class="form-control" name="name_last" id="name_last"
            value="<?= Input::post('name_last', isset($user)?$user->name_last:'') ?>" placeholder="姓">
        <input type="text" class="form-control" name="name_first" id="name_first"
            value="<?= Input::post('name_first', isset($user)?$user->name_first:'') ?>" placeholder="名">
      </div>
    </div>
    <div class="form-group">
      <label>お名前（ふりがな）</label>
      <div class="form-inline">
        <input type="text" class="form-control" name="hiragana_name_last" id="hiragana_name_last" placeholder="姓（ふりがな）" value="<?= Input::post("hiragana_name_last", isset($user)?$user->hiragana_name_last:'') ?>">
        <input type="text" class="form-control" name="hiragana_name_first" id="hiragana_name_first" placeholder="名（ふりがな）" value="<?= Input::post("hiragana_name_first", isset($user)?$user->hiragana_name_first:'') ?>">
      </div>
    </div>
    <div class="form-group">
      <label>メールアドレス</label>
      <input type="text" class="form-control" name="email" id="email" placeholder="例）xxxxx@xxxxx.co.jp" value="<?= Input::post("email", isset($user)?$user->email:'') ?>">
    </div>
    <?php if (Request::main()->action == 'add'): ?>
      <div class="form-group">
        <label>パスワード</label>
        <input type="password" class="form-control" name="password" id="password"
            value="<?= Input::post("password") ?>">
      </div>
    <?php endif; ?>
    <div class="form-group">
      <label>電話番号</label>
      <input type="tel" class="form-control" name="tel" id="tel" placeholder="例）000-0000-0000" maxlength="13"
          value="<?= Input::post("tel", isset($user)?$user->tel:'') ?>">
      <p class="caution-text">※ハイフン付きの半角数字で入力してください</p>
    </div>
    <div class="form-group">
      <label>生年月</label>
      <div class="form-inline">
        <select class="form-control" name="birth_year">
            <?php $birth_year = Input::post("birth_year", isset($user)?$user->getBirthYear():''); ?>
            <?php foreach(range(1940,2016) as $year): ?>
              <option value="<?=$year?>"
                <?php echo ($birth_year==$year)?'selected':''; ?>
                <?php if (empty($birth_year)and $year==1980) echo 'selected'; ?>>
              <?=$year?>年
              </option>
            <?php endforeach; ?>
        </select>
        <select class="form-control" name="birth_month">
            <?php $birth_month = Input::post("birth_month", isset($user)?$user->getBirthMonth():''); ?>
            <?php foreach(range(1,12) as $month): ?>
              <option value="<?=str_pad($month,2,0,STR_PAD_LEFT)?>"
                <?php echo ($birth_month==$month)?'selected':''; ?>
                <?php if (empty($birth_month)and $month==1) echo 'selected'; ?>>
              <?=$month?>月
              </option>
            <?php endforeach; ?>
        </select>
        <!-- <select class="form-control" name="birth_day">
            <?php $birth_day = Input::post("birth_day", isset($user)?$user->getBirthDate():''); ?>
            <?php foreach(range(1,31) as $day): ?>
              <option value="<?=str_pad($day,2,0,STR_PAD_LEFT)?>"
                <?php echo ($birth_day==$day)?'selected':''; ?>
                <?php if (empty($birth_day)and $day==1) echo 'selected'; ?>>
              <?=$day?>日
              </option>
            <?php endforeach; ?>
        </select> -->
      </div>
    </div>
    <div class="form-group">
      <label>性別</label>
      <div class="form-inline">
        <label class="radio-inline"><input type="radio" name="sex" value="1" id="male"
            <?= (Input::post('sex', isset($user)?$user->sex:'')==1)?'checked="checked"':'' ?>"> 男性</label>
        <label class="radio-inline"><input type="radio" name="sex" value="2" id="female"
            <?= (Input::post('sex', isset($user)?$user->sex:'')==2)?'checked="checked"':'' ?>"> 女性</label>
      </div>
    </div>
    <div class="form-group">
      <label>国籍</label>
      <input type="text" class="form-control" name="nationality" id="nationality" placeholder=""
          value="<?= Input::post("nationality", isset($user)?$user->nationality:'') ?>">
    </div>
    <div class="form-group">
      <label>郵便番号</label>
      <input type="zip" class="form-control" name="zip" id="zip" placeholder="例）000-0000" maxlength="8"
          value="<?= Input::post("zip", isset($user)?$user->zip:'') ?>">
      <p class="caution-text">※ハイフン付きの半角数字で入力してください</p>
    </div>
    <div class="form-group">
      <label>都道府県・市町村区</label>
      <div class="form-inline">
        <?php echo Form::select('pref', (string) Input::post('pref', isset($user)?$user->pref:'13'),
            Config::get('master.PREFECTURE_CODES'),
            array("class"=>"form-control select half")
        ); ?>
        <input type="text" class="form-control" name="city" id="city" placeholder="市区町村"
            value="<?= Input::post("city", isset($user)?$user->city:'') ?>">
          </div>
    </div>
  </div>
  <div class="col-xs-6">
    <div class="form-group">
      <label>所属組織名</label>
      <input type="text" class="form-control" name="organization" id="organization" placeholder="例）大学名/企業名"
          value="<?= Input::post("organization", isset($user)?$user->organization:'') ?>">
    </div>
    <div class="form-group">
      <label>役職</label>
      <input type="text" class="form-control" name="position" id="position" placeholder=""
          value="<?= Input::post("position", isset($user)?$user->position:'') ?>">
    </div>
    <div class="form-group">
      <label>職業</label>
      <?php echo Form::select('job', Input::post('job', isset($user)?$user->job:''),
          array('' => '職業') + $jobs,
          array("class"=>"form-control select half required")
      ); ?>
    </div>
    <div class="form-group">
      <label>入館カードID</label>
      <input type="text" class="form-control" name="cardid" id="cardid" placeholder=""
          value="<?= Input::post("cardid", isset($user)?$user->cardid:'') ?>">
    </div>
    <div class="form-group">
      <label>起業への興味</label>
      <div class="form-inline">
        <label class="radio-inline"><?= Form::radio('interest',1,isset($user)?$user->interest:''); ?> あり</label>
        <label class="radio-inline"><?= Form::radio('interest',0,isset($user)?$user->interest:''); ?> なし</label>
      </div>
    </div>
    <div class="form-group">
      <label>起業への準備</label>
      <div class="form-inline">

        <label class="radio-inline"><?= Form::radio('preparation',1,isset($user)?$user->interest:''); ?> している</label>
        <label class="radio-inline"><?= Form::radio('preparation',2,isset($user)?$user->interest:''); ?> 情報収集中</label>
        <label class="radio-inline"><?= Form::radio('preparation',0,isset($user)?$user->interest:''); ?> していない</label>
      </div>
    </div>
    <div class="form-group">
      <label>DMによる案内</label>
        <div class="form-inline">
          <label class="radio-inline"><input type="radio" name="mailmagazine_info" value="1" id="mailmagazine_info_yes" <?= (Input::post("mailmagazine_info", isset($user)?$user->mailmagazine_info:'')!=="0")?'checked="checked"':'' ?>> 受け取る</label>
          <label class="radio-inline"><input type="radio" name="mailmagazine_info" value="0" id="mailmagazine_info_no" <?= (Input::post("mailmagazine_info", isset($user)?$user->mailmagazine_info:'')==="0")?'checked="checked"':'' ?>> 受け取らない</label>
        </div>
    </div>
    <div>
      <?php if (Request::main()->controller == 'Controller_Admin_Users'): ?>
        <div class="form-group">
          <label>アカウント種別</label>
          <?php echo Form::select('group', Input::post('group', isset($user)?$user->group:''),
              Config::get('master.USER_GROUP'),
              array("class"=>"form-control select half required")
          ); ?>
        </div>
        <div class="form-group">
          <label>会員種別</label>
          <?php echo Form::select('type', Input::post('type', isset($user)?$user->type:''),
              array('' => '会員種別') + Config::get('master.USER_TYPES'),
              array("class"=>"form-control select half required")
          ); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
