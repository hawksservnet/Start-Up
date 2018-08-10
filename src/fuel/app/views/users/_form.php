            <div class="form-wrap clearfix">
<?php if (empty($page) or $page =='base'): // 基本情報?>
              <dl class="clearfix">
                <dt class="required">お名前</dt>
                <dd>
                  <input type="text" class="foucus_t text required half smp-half smp-float" name="name_last" id="name_last"
                      value="<?= Input::post('name_last', isset($user)?$user->name_last:'') ?>" placeholder="姓">
                  <input type="text" class="foucus_t text required half smp-half smp-float" name="name_first" id="name_first"
                      value="<?= Input::post('name_first', isset($user)?$user->name_first:'') ?>" placeholder="名">
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="required">お名前（ふりがな）</dt>
                <dd>
                  <input type="text" class="foucus_t text required half smp-half smp-float" name="hiragana_name_last" id="hiragana_name_last" placeholder="姓（ふりがな）" value="<?= Input::post("hiragana_name_last", isset($user)?$user->hiragana_name_last:'') ?>">
                  <input type="text" class="foucus_t text required half smp-half smp-float" name="hiragana_name_first" id="hiragana_name_first" placeholder="名（ふりがな）" value="<?= Input::post("hiragana_name_first", isset($user)?$user->hiragana_name_first:'') ?>">
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="required">メールアドレス</dt>
                <dd class="clearfix">
                  <input type="text" class="foucus_t text required w440" name="email" id="email" placeholder="例）xxxxx@xxxxx.co.jp"
                      value="<?= Input::post("email", isset($user)?$user->email:'') ?>"><span class="unit right">半角英数字</span>
                </dd>
              </dl>

            <?php if (Request::main()->action == 'registration'): ?>
              <!-- 登録の場合にはメール確認欄を表示 -->
              <dl class="clearfix">
                <dt class="required">メールアドレス（確認）</dt>
                <dd class="clearfix">
                  <input type="text" class="foucus_t text required w440" name="emailcheck" id="emailcheck" placeholder="例）xxxxx@xxxxx.co.jp" value="<?= Input::post("emailcheck") ?>"><span class="unit right">半角英数字</span>
                  <p class="caution-text">※確認のためコピーせずにもう一度入力してください</p>
                </dd>
              </dl>
            <?php endif; ?>

            <?php if (Request::main()->action == 'registration' or Request::main()->action == 'add'): ?>
              <!-- 登録と新規の場合にはパスワード欄を表示 -->
              <dl class="clearfix">
                <dt class="required">パスワード</dt>
                <dd class="clearfix">
                  <input type="password" class="foucus_t text required w346" name="password" id="password"
                      value="<?= Input::post("password") ?>">
                </dd>
              </dl>
            <?php endif; ?>

            <?php if (Request::main()->action == 'registration'): ?>
              <!-- 登録の場合にはパスワード確認欄を表示 -->
              <dl class="clearfix">
                <dt class="required">パスワード（確認）</dt>
                <dd class="clearfix">
                  <input type="password" class="foucus_t text required w346" name="passwordcheck" id="passwordcheck"
                      value="<?= Input::post("passwordcheck") ?>">
                  <p class="caution-text">※確認のためコピーせずにもう一度入力してください</p>
                </dd>
              </dl>
            <?php endif; ?>

              <dl class="clearfix">
                <dt class="required">電話番号</dt>
                <dd>
                  <input type="text" class="foucus_t text w180" name="tel" id="tel" placeholder="例）000-0000-0000" maxlength="13"
                      value="<?= Input::post("tel", isset($user)?$user->tel:'') ?>">
                  <p class="caution-text">※ハイフン付きの半角数字で入力してください</p>
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="required">生年月</dt>
                <dd>
                  <div class="select w160 smp-half foucus_t">
                    <select name="birth_year">
                        <?php $birth_year = Input::post("birth_year", isset($user)?$user->getBirthYear():''); ?>
                        <?php foreach(range(1940,2016) as $year): ?>
                          <option value="<?=$year?>"
                            <?php echo ($birth_year==$year)?'selected':''; ?>
                            <?php if (empty($birth_year)and $year==1980) echo 'selected'; ?>>
                          <?=$year?>年
                          </option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="select w160 smp-half smp-float smp-ml-none smp-mt foucus_t">
                    <select name="birth_month">
                        <?php $birth_month = Input::post("birth_month", isset($user)?$user->getBirthMonth():''); ?>
                        <?php foreach(range(1,12) as $month): ?>
                          <option value="<?=str_pad($month,2,0,STR_PAD_LEFT)?>"
                            <?php echo ($birth_month==$month)?'selected':''; ?>
                            <?php if (empty($birth_month)and $month==1) echo 'selected'; ?>>
                          <?=$month?>月
                          </option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <!-- <div class="select w160 smp-half smp-float smp-mt">
                    <select name="birth_day">
                        <?php $birth_day = Input::post("birth_day", isset($user)?$user->getBirthDate():''); ?>
                        <?php foreach(range(1,31) as $day): ?>
                          <option value="<?=str_pad($day,2,0,STR_PAD_LEFT)?>"
                            <?php echo ($birth_day==$day)?'selected':''; ?>
                            <?php if (empty($birth_day)and $day==1) echo 'selected'; ?>>
                          <?=$day?>日
                          </option>
                        <?php endforeach; ?>
                    </select>
                  </div> -->
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="required">性別</dt>
                <dd>
                  <input type="radio" name="sex" value="1" id="male"
                      <?= (Input::post('sex', isset($user)?$user->sex:'')==1)?'checked="checked"':'' ?>">
                  <label for="male" class="radio foucus_t">男性</label>
                  <input type="radio" name="sex" value="2" id="female"
                      <?= (Input::post('sex', isset($user)?$user->sex:'')==2)?'checked="checked"':'' ?>">
                  <label for="female" class="radio foucus_t">女性</label>
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="required">国籍</dt>
                <dd>
                  <input type="text" class="foucus_t text w480" name="nationality" id="nationality" placeholder=""
                      value="<?= Input::post("nationality", isset($user)?$user->nationality:'') ?>">
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="required">郵便番号</dt>
                <dd>
                  <input type="zip" class="foucus_t text w150" name="zip" id="zip" placeholder="例）000-0000" maxlength="8"
                      value="<?= Input::post("zip", isset($user)?$user->zip:'') ?>">
                  <p class="caution-text">※ハイフン付きの半角数字で入力してください</p>
                </dd>
              </dl>
              <dl class="clearfix mt-half">
                <dt class="required">県/市町村区</dt>
                <dd>
                  <div class="select half foucus_t">
                  <?php echo Form::select('pref', (string) Input::post('pref', isset($user)?$user->pref:'13'),
                      Config::get('master.PREFECTURE_CODES'),
                      array("class"=>"select half")
                  ); ?>
                  </div>
                  <input type="text" class="foucus_t text required w210 smp-mt" name="city" id="city" placeholder="市区町村"
                      value="<?= Input::post("city", isset($user)?$user->city:'') ?>">
                </dd>
              </dl>


<?php if (false): ?>
  <!--
	<dl class="clearfix mt-half">
	<dt>番地</dt>
	<dd>
	<input type="text" class="text required w480" name="address" id="address" placeholder="例）0-00-0" value="<?= Input::post("address") ?>">
	<span class="unit right">半角</span>
	</dd>
	</dl>
	<dl class="clearfix mt-half">
	<dt>建物名・部屋番号</dt>
	<dd>
	<input type="text" class="text w480" name="building" id="building" placeholder="例）ダミータワー00F" value="<?= Input::post("building") ?>">
	</dd>
	</dl> -->
<?php endif; ?>


              <dl class="clearfix">
                <dt>所属組織名</dt>
                <dd>
                  <input type="text" class="foucus_t text w480" name="organization" id="organization" placeholder="例）大学名/企業名"
                      value="<?= Input::post("organization", isset($user)?$user->organization:'') ?>">
                </dd>
              </dl>
              <dl class="clearfix mt-half">
                <dt>役職</dt>
                <dd>
                  <input type="text" class="foucus_t text w480" name="position" id="position" placeholder=""
                      value="<?= Input::post("position", isset($user)?$user->position:'') ?>">
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="required">職業</dt>
                <dd>
                  <div class="select half foucus_t">
                  <?php echo Form::select('job', Input::post('job', isset($user)?$user->job:''),
                      array('' => '職業') + $jobs,
                      array("class"=>"select half required")
                  ); ?>
                  </div>
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="required">起業への興味</dt>
                <dd>
                  <input type="radio" name="interest" value="1" id="interest_yes"
                      <?= (Input::post('interest', isset($user)?$user->interest:'')==="1")?'checked="checked"':'' ?>">
                  <label for="interest_yes" class="radio foucus_t">あり</label>
                  <input type="radio" name="interest" value="0" id="interest_no"
                      <?= (Input::post('interest', isset($user)?$user->interest:'')==="0")?'checked="checked"':'' ?>">
                  <label for="interest_no" class="radio foucus_t">なし</label>
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="required">起業への準備</dt>
                <dd>
                  <input type="radio" name="preparation" value="1" id="preparation_yes"
                      <?= (Input::post("preparation", isset($user)?$user->preparation:'')==="1")?'checked="checked"':'' ?>>
                  <label for="preparation_yes" class="radio foucus_t">している</label>
                  <input type="radio" name="preparation" value="2" id="preparation_now"
                      <?= (Input::post("preparation", isset($user)?$user->preparation:'')==="2")?'checked="checked"':'' ?>>
                  <label for="preparation_now" class="radio foucus_t">情報収集中</label>
                  <input type="radio" name="preparation" value="0" id="preparation_no"
                      <?= (Input::post("preparation", isset($user)?$user->preparation:'')==="0")?'checked="checked"':'' ?>>
                  <label for="preparation_no" class="radio foucus_t">していない</label>
                </dd>
              </dl>

          <?php if (Request::main()->action == 'edit'): // 編集画面のみ ?>
            <?php if (Auth::has_access('adminPage.browse')): // 管理者のみ ?>
              <hr style="margin-top:30px; margin-bottom:30px"/>
              <dl class="clearfix">
                <dt class="">アカウント種別</dt>
                <dd>
                  <div class="select half foucus_t">
                  <?php echo Form::select('group', Input::post('group', isset($user)?$user->group:''),
                      array('' => 'アカウント種別') + Config::get('master.USER_GROUP'),
                      array("class"=>"select half required")
                  ); ?>
                  </div>
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="">会員種別</dt>
                <dd>
                  <div class="select half foucus_t">
                  <?php echo Form::select('type', Input::post('type', isset($user)?$user->type:''),
                      array('' => '会員種別') + Config::get('master.USER_TYPES'),
                      array("class"=>"select half required")
                  ); ?>
                  </div>
                </dd>
              </dl>
            <?php endif; ?>
          <?php endif; ?>

<?php endif; // 基本情報 ?>
<?php if (empty($page) or $page =='dm'): // DM情報?>
              <dl class="clearfix">
                <dt class="required">DMによる案内</dt>
                <dd>
                  <input type="radio" name="mailmagazine_info" value="1" id="mailmagazine_info_yes"
                  <?= (Input::post("mailmagazine_info", isset($user)?$user->mailmagazine_info:'')!=="0")?'checked="checked"':'' ?>>
                  <label for="mailmagazine_info_yes" class="radio foucus_t">受け取る</label>
                  <input type="radio" name="mailmagazine_info" value="0" id="mailmagazine_info_no"
                  <?= (Input::post("mailmagazine_info", isset($user)?$user->mailmagazine_info:'')==="0")?'checked="checked"':'' ?>>
                  <label for="mailmagazine_info_no" class="radio foucus_t">受け取らない</label>
                </dd>
              </dl>
<?php endif; // DM情報 ?>
            </div>
