<div id="user-registration" class="section-container">
  <div class="section-inner">
    <div class="section-contents">
      <form method="post" enctype="multipart/form-data">

        <!-- フォーム内容 -->
        <?php echo render('users/_form', compact('user', 'jobs', 'page')); ?>

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
          <div id="confirm-btn" class="btn">
            <div class="btn-inner black">
              <button id="confirm-btn">
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
