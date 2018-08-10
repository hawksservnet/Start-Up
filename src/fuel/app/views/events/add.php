<div id="event" class="section-container">
  <div class="section-inner">
    <div class="section-contents">
      <form action="<?php echo Uri::create("events/add"); ?>" method="post">

        <!-- フォーム内容 -->
        <?php echo render('events/_form', compact()); ?>

        <!-- ボタン -->
        <div class="btn-list clearfix">
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
