<?php echo Form::open() ?>
<?php echo Form::csrf() ?>
	
	<div class="text_wrap inner">
		<p>本当に退会いたします、よろしいですか？</p>
	</div>
	
	<div class="btn_list_wrap inner">
	<?php echo Form::hidden('withdrawal_complete', '1') ?>
	<div class="btn black center"><button><span>退会する</span></button></div>
	<div class="btn gray center mt"><a href="<?php echo Uri::create("mypage") ?>"><span>マイページに戻る</span></a></div>
	</div>

<?php echo Form::close() ?>
