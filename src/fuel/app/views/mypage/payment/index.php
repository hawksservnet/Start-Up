<?php echo Form::open('mypage/payment') ?>
<?php echo Form::csrf() ?>
	<div class="form_wrap">
		<p class="top_text inner">セキュリティ上、登録済みのカード情報は表示できません。<br>
			カード情報を更新したい場合は以下のフォームに入力してください。</p>
		<?php echo Asset::img('account/img_credit.png',array('alt'=>'クレジットカード', 'class'=>'credit_card')); ?>
		<ul class="form_list inner">
			<li>
				<dl class="clearfix">
					<dt class="required">カード番号</dt>
					<dd>
						<span>
							<?php echo Form::input('card_num[1]', Input::post('card_num.1'), array('type'=>'number', 'class'=>'clear text', "placeholder"=>"1234",'maxlength'=>'4')) ?>
						</span>
						<span>
							<?php echo Form::input('card_num[2]', Input::post('card_num.2'), array('type'=>'number', 'class'=>'clear text', "placeholder"=>"5678",'maxlength'=>'4')) ?>
						</span>
						<span>
							<?php echo Form::input('card_num[3]', Input::post('card_num.3'), array('type'=>'number', 'class'=>'clear text', "placeholder"=>"9012",'maxlength'=>'4')) ?>
						</span>
						<span>
							<?php echo Form::input('card_num[4]', Input::post('card_num.4'), array('type'=>'number', 'class'=>'clear text', "placeholder"=>"3456",'maxlength'=>'4')) ?>
						</span>
					</dd>
				</dl>
			</li>
			<li>
				<dl class="clearfix">
					<dt class="required">有効期限</dt>
					<dd>
						<?php echo Form::select('card_limit_year', Input::post('card_limit_year'),$years, array('type'=>'text', 'class'=>'clear text min', "placeholder"=>"")) ?> 年　
						<?php echo Form::select('card_limit_month', Input::post('card_limit_month'),$months, array('type'=>'text', 'class'=>'clear text min', "placeholder"=>"")) ?> 月
					</dd>
				</dl>
			</li>
			<li>
				<dl class="clearfix">
					<dt class="required">セキュリティコード</dt>
					<dd><?php echo Form::input('card_security', Input::post('card_security'), array('type'=>'tel', 'class'=>'clear text min hankaku_number', "placeholder"=>"000",'minlength'=>3,'maxlength'=>4)) ?>
						　<a href="#" class="security_link"><span class="arrow">></span>セキュリティコードについて</a>
					</dd>
				</dl>
			</li>
		</ul>
		<p class="pay_text">お支払い回数 ： 一括払い<span>※お支払い回数は一括払いのみとなっております。</span></p>
		<!-- <a class="text_scan" href="camera_access.php"><span>カードをスキャンする</span></a> -->
	</div>

	<div class="bg_black_wrap fixed_bottom">
		<div class="btn black center"><button><span>次へ</span></button></div>
	</div>
<?php echo Form::close() ?>

<div class="modal_wrap security_modal_wrap">
	<div class="modal_inner">
		<p class="title">セキュリティコードについて</p>
		<div class="image_wrap">
			<?php echo Asset::img('account/img_security_cord.png',array('alt'=>'セキュリティコード')); ?>
		</div>
		<p class="text">セキュリティコードはクレジットカード裏面の末尾3桁の数字です。<br>（一部のクレジットカードの場合、カード表面右側にある4桁の数字となります。）</p>
		<span class="close_btn"></span>
	</div>
</div><!--セキュリティコード-->
