<style>
.content-total {
	width:85%;
}
div.result-confirm {
	width:100%;
}
	.total-list ul li span:nth-child(1) {
		width: 45%;
		margin-right: 20px;
	}
	.total-list ul li span:nth-child(1):after{
		content: ": ";
		position: absolute;
		right: 53%;
		top:0;
	}
	.total-list ul li span:nth-child(2):before {

	}

	.result-confirm ul li div.textarea:before {
        /* content: ": "; */
	}
	.wordwrap {

	 /* These are technically the same, but use both */
		overflow-wrap: break-word;
		word-wrap: break-word;

		-ms-word-break: break-all;
		/* This is the dangerous one in WebKit, as it breaks things wherever */
		word-break: break-all;
		/* Instead use this non-standard one: */
		word-break: break-word;

		/* Adds a hyphen where the word breaks, if supported (No Blink) */
		-ms-hyphens: auto;
		-moz-hyphens: auto;
		-webkit-hyphens: auto;
		hyphens: auto;
}
    .result-confirm ul li div.textarea{
            padding-left:47%;
    }
	@media screen and (max-width: 768px) and (min-width: 320px) {
		.total-list ul li span:nth-child(1) {
			width: 100%;
			margin-right: 20px;
		}

		.total-list ul li span:nth-child(2):before {
			content: "";
		}
        .result-confirm ul li div.textarea:before {
        content: "";
	}
	}
</style>
<div id="user-registration" class="section-container">
	<div class="section-inner">
		<div class="section-contents">
			<form action="<?php echo Uri::create("event/requests/confirm"); ?>" method="post">

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
				<div id="message" style="margin: 20px">
					<div id="request-event-container" style="padding: 0">
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

				<!-- イベント申込フォーム-->
				<?php $data_interview =Session::get('data_interview_'.$event->id); ?>
				<div class="content-total">
					<div class="total-list result-confirm">
						<?php if (count($data_interview>0)):?>
						<ul>
							<?php foreach($data_interview as $item) {
                                      $text='';
                                      if ($item['type']==1 ) {
                                          echo '<li><span>'.$item['name'].'</span>';
										  echo ' <div class="textarea wordwrap">'.$item['text'].'</div></li>';
									  }
                                      elseif($item['type']==2) {
                                          echo '<li><span>'.$item['name'].'</span>';
										  echo '<div class="textarea wordwrap">'.$item['value'];
										  if (trim($item['value'])=='その他') {
											  echo '<br/>'.$item['text'];
										  }
										  echo '</div></li>';
									  }
                                      elseif($item['type']==3 && $item['value'])
                                      {
                                          $text=implode(' ' , $item['value']);
                                          echo '<li><span>'.$item['name'].'</span>';
										  echo '<div  class="textarea wordwrap">'.$text;
										  if (!empty($item['text']))
										  {
											  echo '<br/>'.$item['text'];
										  }
										  echo '</div></li>';
                                      }
                                      else if ($item['type']==4){
                                          echo '<li><span>'.$item['name'].'</span> ';
                                          echo '<div class="textarea wordwrap">'.nl2br(  $item['text']).'</div></li>';
                                      }
							?>

							<?php } ?>


						</ul>
						<?php endif;?>
					</div>
				</div>
				<!-- ボタン -->
				<div class="btn-list clearfix">
					<div class="btn w160 h60 icon-none back">
						<div class="btn-inner clear">
							<a class="overlay-text" onclick="postback()" id="reset-btn">
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
<form action="<?php echo Uri::create("event/requests/add?event_id=".Input::get("event_id")); ?>" id="event_request" method="post">

	<div class="content-alias" style="display: none">
		<?php if(count($interview_items)>0) :?>

		<div class="total-list">
			<div class="form-wrap custom-list clearfix">
				<?php foreach ($interview_items as $item) :?>
				<?php if ($item['type']==1):?>
				<dl class="clearfix">
					<dt class="<?= $item['required']==1?'required':'' ?>"><?= $item['item_name'] ?></dt>
					<dd class="clearfix">
						<input type="text" class="foucus_t text required w440"   name="item_<?=$item['id']?>_name" value="<?=$data_interview['s_'.$item['id']]['text']?>">
					</dd>
				</dl>
				<?php elseif($item['type']==2):?>
				<dl class="clearfix">
					<dt class="<?= $item['required']==1?'required':'' ?>"><?= $item['item_name'] ?></dt>
					<?php
                          $item_list=Model_Interview_List::queryFromItemId($item['id'],$event->id)->order_by('sort_no','asc')->get();
					?>
					<?php if (count($item_list)>0): ?>
					<dd>
						<?php foreach($item_list as $arr) :?>
						<input type="radio" name="radio_<?=$item['id']?>" <?= trim ($data_interview['s_'.$item['id']]['value'])==trim ($arr->list_text)?'checked':'' ?> id="radio_<?=$item['id']?>_<?=$arr->id?>" value="<?=trim($arr->list_text)?>">
						<label for="radio_<?=$item['id']?>_<?=$arr->id?>" class="radio foucus_t" tabindex="23"><?=$arr->list_text?></label>
						<?php endforeach;?>
						<?php if ($item['other_check']==1): ?>
						<input type="radio" name="radio_<?=$item['id']?>" id="radio_<?=$item['id']?>_0" <?= trim($data_interview['s_'.$item['id']]['value'])=='その他'?'checked':'' ?> value="その他">
						<label class="radio foucus_t" for="radio_<?=$item['id']?>_0">その他</label>
						<input id="other_check_<?=$item['id']?>" name="other_check_<?=$item['id']?>" type="text"
									value="<?=$data_interview['s_'.$item['id']]['text']?>"
									class="foucus_t text required  other_textbox" <?= trim( Input::post('radio_'.$item['id']))=='その他'?'style="display:block"':'' ?> />
						<?php endif;?>
					</dd>
					<?php endif;?>
				</dl>
				<?php elseif($item['type']==3):?>
				<dl class="clearfix">
					<dt class="<?= $item['required']==1?'required':'' ?>"><?= $item['item_name'] ?></dt>
					<?php
                          $item_list=Model_Interview_List::queryFromItemId($item['id'],$event->id)->order_by('sort_no','asc')->get();
					?>
					<?php if (count($item_list)>0): ?>
					<dd>
						<?php foreach($item_list as $arr):?>
						<input type="checkbox" name="check<?=$item['id']?>[]" <?= (!empty($data_interview['s_'.$item['id']]['value']) &&  in_array(trim($arr->list_text), $data_interview['s_'.$item['id']]['value']))?'checked':''?>  id="<?=$item['id']?>_<?=$arr->id?>" value="<?=trim($arr->list_text)?>" />
						<label for="<?=$item['id']?>_<?=$arr->id?>" class="cs-box "><?=$arr->list_text?> </label>
						<?php endforeach;?>
						<?php if ($item['other_check']==1): ?>
						<input type="checkbox" name="check<?=$item['id']?>[]" id="check<?=$item['id']?>" <?= (!empty($data_interview['s_'.$item['id']]['value']) &&  in_array('その他', $data_interview['s_'.$item['id']]['value']))?'checked':''?> value="その他" />
						<label for="check<?=$item['id']?>" class="cs-box">その他</label>
							<input id="other_check_<?=$item['id']?>" name="other_check_<?=$item['id']?>" type="text"
									value="<?=Input::post('other_check_'.$item['id'])?>"
									class="foucus_t text required  other_textbox" <?= (!empty(Input::post('check'.$item['id'])) &&  in_array('その他', Input::post('check'.$item['id'])))?'style="display:block"':''?> />
							<input id="other_check_<?=$item['id']?>" name="other_check_<?=$item['id']?>" type="text"
						value="<?=$data_interview['s_'.$item['id']]['text']?>"
						class="foucus_t text required  other_textbox" <?= trim( Input::post('radio_'.$item['id']))=='その他'?'style="display:block"':'' ?> />
						<?php endif;?>
						<?php if ($item['select_max']>0) {
                                  echo '<span>（'.$item['select_max'].'つまで）</span>';
                              } ?>

					</dd>
					<?php endif;?>
				</dl>
				<?php elseif($item['type']==4):?>
				<dl class="clearfix">
					<dt class="<?= $item['required']==1?'required':'' ?>"><?= $item['item_name'] ?></dt>
					<dd>
						<textarea class="foucus_t text w480 custom-wd" placeholder="" value="" rows="5" name="item_<?=$item['id']?>_name" id="item_<?=$item['id']?>_name"><?=$data_interview['s_'.$item['id']]['text']?></textarea>
					</dd>
				</dl>
				<?php endif;?>
				<?php endforeach;?>
			</div>
		</div>

		<?php endif;?>
		<input type="hidden" name="postback" value="1" />
		<input type="hidden" name="event_id" value="<?=Input::get("event_id")?>" />
	</div>

</form>

<script>
    function postback() {
        $('#event_request').submit();
    }
</script>
