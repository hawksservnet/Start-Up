<style>
	#user-registration .form-wrap {
		word-break: normal !important;
	}
	.other_textbox {
		width: 100%;
		margin-top: 0px;
		margin-left: 15px;
		display:none;
	}
	.custom-list .radio {
		width: auto;
		margin-bottom: 10px;
		margin-left: 15px;
	}

	.clearfix dd .radio:nth-of-type(n+7) {
		margin-top: 0;
	}

	.cs-box {
		width: auto !important;
		margin-bottom: 10px;
		margin-left: 15px;
	}

	#user-registration .form-wrap dl dt {
		width: 50%;
		position: relative;
	}
#user-registration .form-wrap dl dd {
		width: 50%;

	}
 #user-registration .form-wrap dl dd input{
	 width:100%;

 }

	span.required {
		display: block;
		width: 29px;
		/*height: 18px;*/
		line-height: 18px;
		border: 1px solid #669d11;
		color: #669d11;
		text-align: center;
		font-size: 10px !important;
		margin-top: 3px;
        margin-bottom:3px;
		vertical-align: middle;
		font-weight: 700;
	}
	span.select_max {
		display: block;
		width: 56px;

		line-height: 18px;
		border: 1px solid #669d11;
		color: #669d11;
		text-align: center;
		font-size: 10px !important;
		margin-top: 3px;
        margin-bottom:3px;
		vertical-align: middle;
		font-weight: 700;
	}
	.content-alias{
		width:85%;
		padding: 0 20px 0px;
	}
	#request-event-container {
		padding: 0px 0px 30px !important;
	}

	.text-ask-input {
		padding: 0px 0px 20px;
		font-weight: bold;
		font-size: 1.4rem;
	}

	@media only all and (min-width: 751px) {
		dl dt.required:after {
			margin-top: 3px;
		}
		#user-registration .form-wrap{
			width:100%;
		}
		#user-registration .form-wrap dl dd textarea:first-child, #user-registration .form-wrap dl dd input:first-child {
			margin-left: 15px;
			width:100%;
		}
		.other_textbox {
		width: 100%;

		}
	}
</style>
<div id="user-registration" class="section-container">
	<div class="section-inner">
		<div class="section-contents">
			<form action="<?php echo Uri::create("event/requests/add?event_id=".Input::get("event_id")); ?>" method="post">

				<?php if (!empty(Input::get("event_id"))
          		and array_key_exists(Input::get("event_id"), $title_events)): ?>

				<?php // イベント情報取得
                          $event = Model_Event::find(Input::get("event_id")); ?>

				<!-- フォーム内容（隠し） -->
				<div class="form-wrap clearfix" style="display: none">
					<dl class="clearfix">
						<dt class="required">ユーザーid</dt>
						<dd>
							<input type="text" class="text w180" name="user_id"
                  value="<?= Input::get("user_id") ?>">
						</dd>
					</dl>
					<dl class="clearfix">
						<dt class="required">イベントid</dt>
						<dd>
							<input type="text" class="text w180" name="event_id"
                  value="<?= Input::get("event_id") ?>">
						</dd>
					</dl>
					<dl class="clearfix">
						<dt class="required">ステータス</dt>
						<dd>
							<?php if ($event->getVacancy() > 0): ?>
							<input type="text" name="status" value="<?= Model_Event_Request::STATUS_RESERVED ?>">申請する
              <?php else: ?>
							<input type="text" name="status" value="<?= Model_Event_Request::STATUS_CANCEL_WAIT ?>">キャンセル待ちに入る
                <!-- <input type="text" name="waiting_order" value="<= $event->nextWaitingOrder() >">待ち順番 -->
							<?php endif; ?>
						</dd>
					</dl>
				</div>

				<ul id="progress-navi">
					<li><span><span class="en">STEP.1</span> 選択</span></li>
					<li class="current"><span><span class="en">STEP.2</span> 確認</span></li>
					<li><span><span class="en">STEP.3</span> 予約完了</span></li>
				</ul>
				<div style="margin: 20px; color=red;">
					<p class="text red" style="font-weight: bold;">※まだ予約は完了していません。</p>
				</div>
				<!-- 登録メッセージ -->
				<div id="message" style="margin: 20px 20px 0px;">
					<div id="request-event-container">
						<h3 class="name"><?= $current_user->getName() ?>様</h3>
						<p class="text">以下のイベントを予約されますか？</p>
						<div class="event-item">
								<?php
								$style='width:100%';
								$padding ='padding:30px 30px';
								if(empty($event->img_url )){
										$style='width:85%;margin: 0 auto;';
										$padding ='padding:30px 30px 30px 0';
								} ?>
							<div style='<?php echo $style  ?>' >
								<?php if(!empty($event->img_url ))  { ?>
								<div class="image-box">

									<img src="<?= $event->img_url ?>" alt="">

								</div>
										<?php } ?>
								<div class="detail-box top" style="<?php echo $padding ?>">
									<?php if ($event->getVacancy() > 0): ?>
									<p class="status green">予約可能</p>
									<?php else: ?>
									<p class="status red">キャンセル待ち（<?= $event->nextWaitingOrder() ?> 人目）</p>
									<?php endif; ?>
									<p class="datetime">
										<?= $event->getStartDate() ?>
										<?= $event->getStartTime() ?> 〜 <?= $event->getEndTime() ?>
									</p>
									<p class="title"><?= $event->title ?></p>
									<p class="host">主催者：<?= $event->organizer ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="content-alias">
					<?php if(count($interview_items)>0) :?>
					<div class="clearfix">
						<p class="text-ask-input">下記アンケートにお答えください</p>
					</div>

					<div class="total-list">
						<div class="form-wrap custom-list clearfix">
							<?php foreach ($interview_items as $item) :?>
							<?php if ($item['type']==1):?>
							<dl class="clearfix">
								<dt>

									<?= $item['item_name'] ?>
									<?php if ($item['required']==1) { ?>
									<span class="required">必須</span>
									<?php } ?>
								</dt>
								<dd class="clearfix">
									<input type="text" class="foucus_t text required w440"   name="item_<?=$item['id']?>_name" value="<?=Input::post('item_'.$item['id'].'_name')?>">
								</dd>
							</dl>
							<?php elseif($item['type']==2):?>
							<dl class="clearfix">
								<dt>
									<?= $item['item_name'] ?>
									<?php if ($item['required']==1) { ?>
									<span class="required">必須</span>
									<?php } ?>
								</dt>
								<?php
                                      $item_list=Model_Interview_List::queryFromItemId($item['id'],$event->id)->order_by('sort_no','asc')->get();
								?>
								<?php if (count($item_list)>0): ?>
								<dd>
									<?php foreach($item_list as $arr) :?>
									<input class="item_radio" data-other="0" data-id="<?=$item['id']?>" type="radio" name="radio_<?=$item['id']?>" <?= trim ( Input::post('radio_'.$item['id']))==trim ($arr->list_text)?'checked':'' ?> id="radio_<?=$item['id']?>_<?=$arr->id?>" value="<?=trim($arr->list_text)?>">
									<label for="radio_<?=$item['id']?>_<?=$arr->id?>" class="radio foucus_t" tabindex="23"><?=$arr->list_text?></label>
									<?php endforeach;?>
									<?php if ($item['other_check']==1): ?>
									<input class="item_radio"  data-other="1" data-id="<?=$item['id']?>" type="radio" name="radio_<?=$item['id']?>" id="radio_<?=$item['id']?>_0" <?= trim( Input::post('radio_'.$item['id']))=='その他'?'checked':'' ?> value="その他">
									<label class="radio foucus_t" for="radio_<?=$item['id']?>_0">その他</label>
									<input id="other_check_<?=$item['id']?>" name="other_check_<?=$item['id']?>" type="text"
									value="<?=Input::post('other_check_'.$item['id'])?>"
									class="foucus_t text required  other_textbox" <?= trim( Input::post('radio_'.$item['id']))=='その他'?'style="display:block"':'' ?> />

									<?php endif;?>
								</dd>

								<?php endif;?>
							</dl>
							<?php elseif($item['type']==3):?>
							<dl class="clearfix">
								<dt><?= $item['item_name'] ?>
									<?php if ($item['select_max']>0) {
                                              echo '<span style="font-weight:bold">('.$item['select_max'].'つまで）</span>';
									} ?>
									<?php if ($item['required']==1) { ?>
									<span class="required">必須</span>
									<?php } ?>

								</dt>
								<?php
                                      $item_list=Model_Interview_List::queryFromItemId($item['id'],$event->id)->order_by('sort_no','asc')->get();
								?>
								<?php if (count($item_list)>0): ?>
								<dd>
									<?php foreach($item_list as $arr):?>
									<input class="item_checkbox" data-other="0" data-id="<?=$item['id']?>"  type="checkbox" name="check<?=$item['id']?>[]" <?= (!empty(Input::post('check'.$item['id'])) &&  in_array(trim($arr->list_text), Input::post('check'.$item['id'])))?'checked':''?>  id="<?=$item['id']?>_<?=$arr->id?>" value="<?=trim($arr->list_text)?>" />
									<label for="<?=$item['id']?>_<?=$arr->id?>" class="cs-box "><?=$arr->list_text?> </label>
									<?php endforeach;?>
									<?php if ($item['other_check']==1): ?>
									<input class="item_checkbox" data-other="1" data-id="<?=$item['id']?>"  type="checkbox" name="check<?=$item['id']?>[]" id="check<?=$item['id']?>" <?= (!empty(Input::post('check'.$item['id'])) &&  in_array('その他', Input::post('check'.$item['id'])))?'checked':''?> value="その他" />
									<label for="check<?=$item['id']?>" class="cs-box">その他</label>
									<input id="other_check_<?=$item['id']?>" name="other_check_<?=$item['id']?>" type="text"
									value="<?=Input::post('other_check_'.$item['id'])?>"
									class="foucus_t text required  other_textbox" <?= (!empty(Input::post('check'.$item['id'])) &&  in_array('その他', Input::post('check'.$item['id'])))?'style="display:block"':''?> />
									<?php endif;?>
									<?php if ($item['select_max']>0) {
                                              //echo '<span>（'.$item['select_max'].'つまで）</span>';
									} ?>

								</dd>
								<?php endif;?>
							</dl>
							<?php elseif($item['type']==4):?>
							<dl class="clearfix">
								<dt><?= $item['item_name'] ?>

									<?php if ($item['required']==1) { ?>
									<span class="required">必須</span>
									<?php } ?>
								</dt>
								<dd>
									<textarea class="foucus_t text w480 custom-wd" placeholder="" value="" rows="5" name="item_<?=$item['id']?>_name" id="item_<?=$item['id']?>_name"><?=Input::post('item_'.$item['id'].'_name')?></textarea>
								</dd>
							</dl>
							<?php endif;?>
							<?php endforeach;?>
						</div>
					</div>

					<?php endif;?>

				</div>

				<!-- ボタン -->
				<div class="btn-list clearfix">
					<div class="btn w160 h60 icon-none back">
						<div class="btn-inner clear">
							<a class="overlay-text" id="reset-btn" href="<?= $event->wp_url; ?>">
								<span class="text en">BACK</span>
							</a>
							<div class="line"></div>
							<div class="line2"></div>
						</div>
					</div>
					<div id="submit-btn" class="btn">
						<div class="btn-inner black">
							<button id="submit-btn">
								<span class="text">予約申し込み</span>
							</button>
							<div class="line"></div>
							<div class="line2"></div>
						</div>
					</div>
				</div>
				<!--btn_list-->

				<?php else: ?>
				<div id="message" style="margin: 20px; color=red;">
					パラメータが不正です。
				</div>
				<?php endif; ?>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$("input[type=radio].item_radio").on("change", function (e) {
			var other = $(this).attr('data-other') ;
			var id= $(this).attr('data-id');
			if (other==1) {
				$('#other_check_'+id).show();
			}else {
				$('#other_check_'+id).hide();
				$('#other_check_'+id).val('')
			}
		});


		$("input[type=checkbox].item_checkbox").on("change", function (e) {
			var other = $(this).attr('data-other');
			var id= $(this).attr('data-id');
			if (other==1) {
				 if ($(this).is(":checked")){
					$('#other_check_'+id).show();
				 }
				 else {
					$('#other_check_'+id).hide();
					$('#other_check_'+id).val('')
				 }

			}
		});
	});
</script>
