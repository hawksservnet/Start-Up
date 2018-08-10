<div id="user-registration" class="section-container">
  <div class="section-inner">
    <div class="section-contents">
      <form action="<?php echo Uri::create("users/add"); ?>" method="post" enctype="multipart/form-data">

        <!-- フォーム内容 -->
        <?php echo render('users/_form', compact('jobs')); ?>

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

<script>
<!-- TODO: 下記のスクリプトは、src/public/assets/js/common/script.js がコンパイルできたら不要
  $(function() {
    if($( ".datepicker" )[0]) $( ".datepicker" ).datepicker({
      "dateFormat":"yy/mm/dd",
    });
  })
-->
</script>
