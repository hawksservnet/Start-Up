<div id="user-registration" class="section-container">
  <div class="section-inner">
    <div class="section-contents">
      <p class="lead center">DM登録内容を変更します。よろしいですか？</p>
      <form method="post" enctype="multipart/form-data">


        
		<div class="section-contents">
			<div class="profile-wrap">
				<dl class="profile-row">
					<dt class="profile-head">DMによる案内</dt>
					<dd class="profile-detail">
						<div class="detail-content">
							<?= $user->mailmagazine_info?'受け取る':'受け取らない'  ?>
						</div>
					</dd>
				</dl>
			</div>
		</div><!-- /.section-contents -->



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
