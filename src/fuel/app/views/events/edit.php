<div id="event" class="section-container">
  <div class="section-inner">
    <div class="section-contents">
      <form action="<?php echo Uri::create('events/edit/'. $event->id); ?>" method="post">

        <!-- フォーム内容 -->
        <?php echo render('events/_form', compact('event')); ?>

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
                <span class="text en">SUBMIT</span>
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
