<?php
$url = "https://startuphub.tokyo/";
if (strpos($_SERVER["HTTP_HOST"],'dev-mp') !== false) {
  $url ='https://dev.startuphub.tokyo/';
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>assets/css/mypage2.css?<?php echo date('mdyGi');  ?>">
<script src="/assets/js/detectmobilebrowser.js"></script>
<style>
	.interview:hover .tooltip {
		z-index: 999999;
	}
.dont-break-out {

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
	.interview:hover .tooltip {
		width: 540px;
	}

		.interview:hover .tooltip p {
			width: auto;
		}

	.interview {
		border: 1px solid #808080;
	}

		.interview .title {
			border-bottom: 1px solid #808080;
			padding: 5px;
		}

		.interview .content {
			padding: 5px;
		}

			.interview .content .question, .interview .tooltip .question {
				width: 100%;
				font-weight: 700;
				clear: both;
				display: block;
			}

			.interview .content .aws, .interview .tooltip .aws {
				line-height: 25px;
			}

	.data-tooltip {
		display: none;
	}

	.sub_name {
		position: relative;
		height: 40px;
		margin-bottom: 2px;
	}

		.sub_name .host {
			height: 40px;
			position: absolute;
		}

		.sub_name .btn {
			position: absolute;
			right: 0;
		}

	@media only screen and (min-width: 320px) and (max-width: 767px) {
		.sub_name {
			position: relative;
			height: auto;
		}

			.sub_name .host {
				height: 40px;
				position: relative;
				width: 100%;
			}

			.sub_name .btn {
				position: relative;
				margin: 0;
				width: 110px;
			}

		.tooltip p {
			width: auto;
			overflow-x: scroll;
		}

		p.datetime {
			font-size: 12px;
		}

		.interview:hover .tooltip {
			width: 85%;
		}
	}
</style>
<script>
    var isMobile = false;
    if (jQuery.browser.mobile) {
        isMobile = true;
    }
</script>
<div id="mypage" class="section-container">
	<div class="mypage-navi">
		<div class="inner">
			<ul>
				<li class="active"><a href="<?php echo Uri::create('mypage/index'); ?>">予約・開催済みイベント</a></li>
				<li><a href="<?php echo Uri::create('mypage/profile'); ?>">登録情報</a></li>
				<li><a href="<?php echo $url . 'mypage/reserve/list'; ?>">コンシェルジュ相談申込履歴</a></li>
				<li><a href="<?php echo $url . 'mypage/nursery/list'; ?>">一時保育サービス予約状況</a></li>
			</ul>
		</div>
	</div>
	<div class="section-inner">
		<div class="section-contents">
			<!--
            <div class="mypage__infomation-container">
                <p class="title">HP更新前に<br class="sp">
                    イベントお申込みをいただいた方へ</p>
                <p class="text">
                    HP更新前（1月27日以前）にイベントお申込みされた情報は、マイページ上に表示はされておりませんが、<br class="pc">
                    申し込みは前システムにて受付完了しております。<br class="pc">
                    そのため、既にお申し込みをいただいたイベントには再度お申し込みをいただく必要はございません。<br class="pc">
                    ご利用いただく皆様にはご不便おかけいたしますが何卒よろしくお願いいたします。
                </p>
            </div>
-->
			<!-- /.mypage__infomation-container -->
			<div class="event-information">
				<div class="event-navi">
					<ul>
						<li class="active js__tab-trigger" data-target="reserved"><span>予約済みイベント</span></li>
						<li class="js__tab-trigger" data-target="past"><span>開催済みイベント</span></li>
					</ul>
				</div>


				<div id="js__tab-container">

					<div id="reserved-event" class="js__tab-content">

						<?php if (empty($requests)): ?>

						<div class="event-none-container clearfix">
							<p class="text">
								現在ご予約中またはキャンセル待ちのイベントはございません。<br>
								以下のボタンよりイベントをご予約いただけます。ご希望のイベントをお選びください。
							</p>

							<div class="btn-list clearfix">
								<div class="btn center">
									<div class="btn-inner black">
										<a href="<?php echo $url.'event/'; ?>">
											<span class="text">イベントを予約する</span>
										</a>
										<div class="line"></div>
										<div class="line2"></div>
									</div>
								</div>
							</div>
							<!--btn_list-->
						</div>
						<?php else: ?>
						<div class="event-content">
							<ul class="event-list">
								<?php foreach ($requests as $rkey => $request): ?>
								<?php $anws= Model_Interview_Answer::findByEventRequestIdToArray($request->id);
								?>
								<li class="event-item">
									<div class="image-box">
										<a href="<?= $request->event->wp_url; ?>">
											<img src="<?= $request->event->img_url ?>" alt=""></a>
									</div>
									<div class="detail-box top" id="title-alias">
										<p class="status <?= $request->getStatusClass() ?>">
											<?php 
                                          /*
                                          if($request->status==11 && $request->approval==0){
                                          echo "審査まち";
                                          }
                                          else 
                                          echo $request->getStatus()
                                           */
                                          //Change Status MSG
                                          if ($request->event->approval==0){
                                              if($request->status==11)
                                                  echo "予約済";
                                          }elseif($request->event->approval==1){
                                              if($request->status==11 && $request->approval==1){
                                                  echo "当選";
                                              }else {
                                                  if($request->approval==0)
                                                      echo "審査中";
                                                  elseif($request->approval==2)
                                                      echo "落選";
                                              }
                                          }
											?>
											<?= $request->getWaitingInfo() ?>
										</p>
										<p class="datetime"><?= $request->event->getStartDate() ?>
											<?= $request->event->getStartTime() ?> 〜 <?= $request->event->getEndTime() ?>
										</p>
										<p class="title "><a href="<?= $request->event->wp_url; ?>"><?= $request->event->title ?></a></p>
										<div class="sub_name">
											<p class="host">
												主催者：<?= $request->event->organizer ?>

											</p>
											<div class="btn w110 h40 icon-none">
												<div class="btn-inner clear">
													<a class="openmodal" href="#cancel-<?= $rkey ?>">キャンセル</a>
													<div class="line"></div>
													<div class="line2"></div>
												</div>
											</div>
										</div>
										<?php if (count($anws)) {?>
										<div class="interview">
											<div id="tooltip_<?php echo $request->id ?>" class="data-tooltip tooltip">
												<p>
													<?php 
                                                  foreach($anws as $row) {
													?>
													<span class="question"><?php echo $row->interview_items->item_name ?>:</span>
													<span class="aws dont-break-out ">
														<?php 
                                                      if($row->interview_items->type == Model_Interview_Item::INTERVIEW_TEXT ||
                                                          $row->interview_items->type == Model_Interview_Item::INTERVIEW_TEXTAREA){
                                                          echo  $row->answer_text;
                                                      } elseif($row->interview_items->type == Model_Interview_Item::INTERVIEW_RADIO ||
															$row->interview_items->type == Model_Interview_Item::INTERVIEW_CHECKBOX) {
                                                          	echo  str_replace(';','/',$row->answer_value);
															if (!empty($row->answer_text)) {
																echo '<br/>'.$row->answer_text;
															}
                                                      }
														?>
													</span>
													<?php 
                                                  }
													?>
												</p>
											</div>
											<div class="title show-tooltip"   data-id="<?php echo $request->id ?>" >アンケート</div>
											<div class="content">
												<?php
                                                  $i =0;
                                                  foreach($anws as $row) {
                                                      if($i>3)
                                                          break;
                                                      if (!empty($row->answer_text) ||!empty($row->answer_value)  ){
                                                          $i++
												?>
												<span class="question"><?php echo $row->interview_items->item_name ?>:</span>
												<span class="aws dont-break-out ">
													<?php 
                                                          if($row->interview_items->type == Model_Interview_Item::INTERVIEW_TEXT ||
                                                              $row->interview_items->type == Model_Interview_Item::INTERVIEW_TEXTAREA){
                                                              echo  $row->answer_text;
                                                          } elseif($row->interview_items->type == Model_Interview_Item::INTERVIEW_RADIO ||
                                                              $row->interview_items->type == Model_Interview_Item::INTERVIEW_CHECKBOX) {
                                                              echo  str_replace(';','/',$row->answer_value);
															  if (!empty($row->answer_text)) {
																echo '<br/>'.$row->answer_text;
															  }
                                                          }
													?>
												</span>
												<?php 
                                                      }
												?>


												<?php } ?>

											</div>
										</div>
										<?php }?>
									</div>
									<div class="action-box">
									</div>
									<div class="modal-area">
										<div class="modal-content" id="cancel-<?= $rkey ?>">
											<div class="modal-title">
												<p class="title-text">キャンセル確認</p>
											</div>
											<div class="modal-inner">
												<p class="text">以下のイベントをキャンセルされますか？キャンセルすると取り消しが出来ません。</p>
												<div class="modal-event-item">
													<div class="image-box">
														<img src="<?= $request->event->img_url ?>" alt="">
													</div>
													<div class="detail-box top">
														<p class="status <?= $request->getStatusClass() ?>">
															<?= $request->getStatus() ?>
															<?= $request->getWaitingInfo() ?>
														</p>
														<p class="datetime"><?= $request->event->getStartDate() ?>
															<?= $request->event->getStartTime() ?> 〜 <?= $request->event->getEndTime() ?>
														</p>
														<p class="title"><?= $request->event->title ?></p>
														<p class="host">主催者：<?= $request->event->organizer ?></p>
													</div>
												</div>
												<?php echo Form::open(array("action"=>"event/requests/cancel/".$request->id ,"method"=>"post")); ?>
												<div class="action">
													<div class="btn w240 h60 center">
														<div class="btn-inner clear">
															<button type="submit" name="cancel" value="cancel" style="line-height: 20px;">キャンセルする</button>
															<div class="line"></div>
															<div class="line2"></div>
														</div>
													</div>
												</div>
												<?php echo Form::close(); ?>
											</div>
										</div>
									</div>
								</li>
								<?php endforeach; ?>
							</ul>
							<div class="modal-area">
								<div class="modal-content" id="cancel-complete">
									<div class="modal-title">
										<p class="title-text">キャンセル完了</p>
									</div>
									<div class="modal-inner">
										<p class="text">イベントをキャンセルしました</p>
										<div class="action">
											<div class="btn w240 h60 center icon-none">
												<div class="btn-inner clear">
													<a href="#" onclick="$.colorbox.close(); return false;">閉じる</a>
													<div class="line"></div>
													<div class="line2"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endif; ?>
					</div>
					<!-- /.js__tab-content -->
					<div id="past-event" class="js__tab-content" style="display: none;">

						<?php if (empty($accepted_requests)): ?>

						<div class="event-none-container clearfix">
							<p class="text">
								参加いただいたイベントはございません。<br>
								以下のボタンよりイベントをご予約いただけます。ご希望のイベントをお選びください。
							</p>

							<div class="btn-list clearfix">
								<div class="btn center">
									<div class="btn-inner black">
										<a href="<?php echo $url.'event/'; ?>">
											<span class="text">イベントを予約する</span>
										</a>
										<div class="line"></div>
										<div class="line2"></div>
									</div>
								</div>
							</div>
							<!--btn_list-->
						</div>


						<?php else: ?>
						<div class="event-content">
							<div class="event-select">
								<div class="event-select-group">
									<div class="select-title">MONTH</div>
									<div class="select-body">
										<div class="select">
											<select class="select half required" name="job" id="form_job">
												<option value="" selected="selected">開催月から探す</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<ul class="event-list">
								<?php foreach ($accepted_requests as $rkey => $accepted_request): ?>
								<li class="event-item start<?php echo Date::forge(strtotime($accepted_request->event->start_time))->format("%Y年%m月") ?>">
									<div class="image-box">
											<img src="<?= $accepted_request->event->img_url ?>" alt="">
									</div>
									<div class="detail-box">
										<p class="datetime"><?= $accepted_request->event->getStartDate() ?>
											<?= $accepted_request->event->getStartTime() ?> 〜 <?= $accepted_request->event->getEndTime() ?>
										</p>
										<p class="title"><?= $accepted_request->event->title ?></p>
										<p class="host">主催者：<?= $accepted_request->event->organizer ?></p>
									</div>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
						<?php endif; ?>

					</div>
					<!-- /.js__tab-content -->


				</div>
				<!-- /#js__tab-container -->


			</div>

		</div>
		<!-- /.section-contents -->
	</div>
	<!-- /.section-inner -->
</div>
<!-- /.section-container -->
<script>
    function simple_tooltip(target_items, name) {
        $(target_items).each(function (i) {

            //$("body").append("<div class='" + name + "' id='" + name + i + "'><p>" + $(this).attr('data-title') + "</p></div>");
            var my_tooltip = $("#tooltip_" + $(this).attr('data-id'));

            var top = $(this).position().top;
            var left = $(this).position().left;
            var linkWidth = $(this).outerWidth();
            var marginTop = 50;
            if ($(this).attr("data-id") != "" && $(this).attr("data-id") != "undefined") {

                if (!isMobile) {
                    $(this).mouseover(function () {
                        my_tooltip.css({ opacity: 0.8, display: "none" }).fadeIn(400);
                    }).mousemove(function (kmouse) {
                        var border_top = $(window).scrollTop();

                        var border_right = $(window).width();
                        var left_pos;
                        var top_pos;
                        var offset = 10;
                        if (border_right - (350) >= my_tooltip.width() + kmouse.pageX) {
                            left_pos = (kmouse.pageX + offset) - (left / 2);
						
                        } else {
                            left_pos = my_tooltip.width() - offset;
                        }

                        if (border_top + (offset * 2) >= kmouse.pageY - my_tooltip.height()) {

                            top_pos = border_top + offset;
                            if (top_pos > border_top) {
                                top_pos = border_top;
                            }

                        } else {

                            top_pos = kmouse.pageY - my_tooltip.height() - offset;
                        }
                        var toptooltip = 0;
                        if (top_pos > (top + marginTop))
                            toptooltip = (top + marginTop);
                        else
                            toptooltip = top_pos;


                        my_tooltip.css({ left: left_pos, top: toptooltip + "px", 'z-index': 99999999, 'display': 'block' });
                    }).mouseout(function () {
                        my_tooltip.css({ left: "-9999px" });
                    });
                }
                else {
                    $(this).click(function (e) {

                        var offset = 5;
                        my_tooltip.css({ opacity: 0.8, left: 20, top: e.target.offsetTop + e.target.clientHeight + offset + "px", 'z-index': 99999 }).fadeIn(400);
                    }).mouseout(function () {
                        my_tooltip.hide();
                    });
                }


            }

        });
    }

    $(document).ready(function () {
        simple_tooltip(".show-tooltip");

        $('*').click(function (e) {

            if (!$(e.target).hasClass("show-tooltip")) {
                $('.data-tooltip').hide();
            }
        });

    });

</script>
