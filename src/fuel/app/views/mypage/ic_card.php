<div id="list_wrap">

	<div class="form_wrap inner">
		<p>ICカードの登録は自転車に設置してあるスマートロックからご登録可能です。</p>
		<p><a href="../tutorial/index.php?ic#ic01">ICカードのご登録について</a></p>
	</div>
		<div class="form_content">
			<?php if (empty($user->ic_cards)): ?>
				<div id="no-item" class="center wh_box">
					<b>登録されていません</b>
				</div>
			<?php else: ?>
			<ul class="ic_card_list">
				<?php foreach( $user->ic_cards as $ic_card ) : ?>
					<li class="card_detail">
						<dl class="clearfix">
							<dt class="ic_name">カード番号:</dt>
							<dd><?php echo $ic_card->code ?></dd>
						</dl>
						<p class="btn gray"><a href="<?php echo Uri::create('mypage/ic_card_delete/'.$ic_card->id) ?>" onclick="javascript:return confirm('本当に削除しますか？')">削除する</a></p>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>

</div>
