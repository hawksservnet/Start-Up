<div id="user-registration" class="section-container">
  <div class="section-inner">
    <div class="section-contents">
      <form action="<?php echo Uri::create('users/edit_pw/'. $user->id); ?>" method="post">

        <!-- フォーム -->
        <div class="form-wrap clearfix">
              <dl class="clearfix">
                <dt class="required">パスワード</dt>
                <dd class="clearfix">
                  <input type="password" class="text required w346" name="password" id="password"
                      value="<?= Input::post("password") ?>">
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="required">パスワード（確認）</dt>
                <dd class="clearfix">
                  <input type="password" class="text required w346" name="passwordcheck" id="passwordcheck"
                      value="<?= Input::post("passwordcheck") ?>">
                  <p class="caution-text">※確認のためコピーせずにもう一度入力してください</p>
                </dd>
              </dl>
        </div>

        <!-- ボタン -->
        <div class="btn-list clearfix">
          <div class="btn w160 h60 icon-none back">
            <div class="btn-inner clear">
              <a class="overlay-text" id="reset-btn" onclick="history.back();return false">
                <span class="text en">BACK</span>
              </a>
              <div class="line"></div>
              <div class="line2"></div>
            </div>
          </div>
          <div id="submit-btn" class="btn">
            <div class="btn-inner black">
              <button id="submit-btn">
                <span class="text en">CONFIRM</span>
              </button>
              <div class="line"></div>
              <div class="line2"></div>
            </div>
          </div>
        </div><!--btn_list-->
      </form>
    </div>
  </div>
</div>
