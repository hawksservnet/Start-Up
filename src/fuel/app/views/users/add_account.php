<?php
$page_id = 'user-registration'; //ページ独自にスタイルを指定する場合は入力
$page_title = ''; //ページ名
$child_title = ''; //子ページ名
$page_description = '';
$page_keyword = '';
?>
<?php echo View::forge('top/_header', compact('extra_css', 'page_path')); ?>

		<h2 id="page-title" class="clearfix">
			<div class="page-title-inner">
				<span class="en">USER REGISTRATION</span>
				<span class="jp">ユーザー登録</span>
			</div>
		</h2>

		<div id="user-registration" class="section-container">
			<div class="section-inner">
				<div class="section-contents">

					<div class="form-wrap complete clearfix">
						<p class="title">ユーザー登録が完了いたしました。</p>
						<p class="text">ご登録が完了いたしました。誠にありがとうございます。</p>
					</div>

					<div class="btn-list clearfix">
						<div class="btn">
							<div class="btn-inner black">
								<a href="https://startuphub.tokyo/">
									<span class="text en">BACK&nbsp;TO&nbsp;TOP</span>
								</a>
								<div class="line"></div>
								<div class="line2"></div>
							</div>
						</div>
					</div><!--btn_list-->

                </div><!-- /.section-contents -->
			</div><!-- /.section-inner -->
		</section><!-- /.section-container -->

<?php echo View::forge('top/_footer', compact('extra_js', 'page_path')); ?>