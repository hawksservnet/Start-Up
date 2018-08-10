<?= Form::open() ?>
<h2>登録内容確認</h2>
  <div class='event_area row'>
    <div>
        <table class="table">
          <tr>
              <th>名称</th>
              <td><?= $event->title ?></td>
          </tr>
          <tr>
              <th>イベントURL</th>
              <td class="url_column"><a href="<?= $event->wp_url; ?>" target="_blank"><?= $event->wp_url; ?></a></td>
          </tr>
          <tr>
              <th>画像URL</th>
              <td class="url_column"><a href="<?= $event->img_url; ?>" target="_blank"><?= $event->img_url; ?></a></td>
          </tr>
          <tr>
              <th>開催日</th>
              <td><?= $event->start_date ?></td>
          </tr>
          <tr>
              <th>開催時間</th>
              <td>
                <?= $event->start_time?date('H:i', strtotime($event->start_time)):'' ?>
                <?= $event->end_time?(' 〜 '.date('H:i', strtotime($event->end_time))):'' ?>
              </td>
          </tr>
          <tr>
              <th>受付開始時間</th>
              <td><?= $event->reception_open?date('H:i', strtotime($event->reception_open)):'' ?>〜</td>
          </tr>
          <tr>
              <th>料金</th>
              <td><?= $event->charge ?></td>
          </tr>
          <tr>
              <th>定員数</th>
              <td><?= $event->capacity?:0 ?>名</td>
          </tr>
          <tr>
              <th>主催者</th>
              <td><?= $event->getOrganizer() ?></td>
          </tr>
          <tr>
              <th>ステータス</th>
              <td><?= $event_statuses[$event->status] ?></td>
          </tr>
          <tr>
              <th>カテゴリ</th>
              <td>
              <?php foreach ($categories as $category): ?>
                <p><?= $category ?></p>
              <?php endforeach; ?>
              </td>
          </tr>
          <tr>
              <th>タグ</th>
              <td>
              <?php foreach ($tags as $tag): ?>
                <p><?= $tag ?></p>
              <?php endforeach; ?>
              </td>
          </tr>
        </table>
    </div>
  </div>

  <div class="row">
      <div class="col-xs-12 row">
          <?php if (!empty($event->id)): ?>
              <div class="col-xs-1 row">
                  <p class="ad-text-header">
                      問診
                  </p>
              </div>
              <div class="col-xs-11">
                  <div class="col-xs-5">
                      <div>
                          <table class="table ad-table-center">
                              <?php if(!empty($event->interview_items)): ?>
                                  <?php foreach($event->interview_items as $interview): ?>
                                      <tr>
                                          <td>
                                              <p>項目名： <?= $interview['item_name'] ?></p>
                                              <p>タイプ： <?= Config::get('master.INTERVIEW_TYPE')[$interview['type']] ?></p>
                                              <?php if($interview['type'] == 2 || $interview['type'] == 3): ?>
                                                  <p>選択肢：
                                                      <?php foreach($interview['interview_lists'] as $interviewList): ?>
                                                          <?= ' ' . $interviewList['list_text'] ?>
                                                      <?php endforeach; ?>
                                                  </p>
                                              <?php endif; ?>
                                          </td>
                                      </tr>
                                  <?php endforeach; ?>
                                  <tr>
                                      <td class="ad-text-right"><a class="btn btn-primary" data-toggle="modal" data-target="#myModal-page20">問診の画面プレビュー</a></td>
                                  </tr>
                              <?php endif; ?>
                          </table>
                      </div>
                  </div>
              </div>
              <!-- Modal -->
              <div id="myModal-page20" class="modal fade" role="dialog" >
                  <div class="modal-dialog " style="width:70%">
                      <!-- Modal content-->
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title ad-text-center ad-text-header">問診画面プレビュー</h4>
                          </div>
                          <div class="modal-body row">
                              <div class="col-xs-12 ad-none-padding">
                                  <?php if(!empty($event->interview_items)): ?>
                                      <?php foreach($event->interview_items as $interview): ?>
                                          <?php if($interview['type'] == Model_Interview_Item::INTERVIEW_TEXT): ?>
                                              <div class="col-xs-3">
                                                  <span class="ad-text-header"><?= $interview['item_name'] ?></span>
                                              </div>
                                              <div class="col-xs-9">
                                                  <input type="text"><?= (isset($interview['required']) && $interview['required'] ==1 )?'（必須）':'' ?>
                                              </div>
                                              <p class="clearfix"></p>
                                          <?php endif; ?>
                                          <?php if($interview['type'] == Model_Interview_Item::INTERVIEW_TEXTAREA): ?>
                                              <div class="col-xs-3">
                                                  <span class="ad-text-header"><?= $interview['item_name'] ?></span>
                                              </div>
                                              <div class="col-xs-9">
                                                  <textarea  rows="5" cols="20" class="ad-textarea ad-textarea-custom"></textarea><?= (isset($interview['required']) && $interview['required'] ==1 )?'（必須）':'' ?>
                                              </div>
                                              <p class="clearfix"></p>
                                          <?php endif; ?>
                                          <?php if($interview['type'] == Model_Interview_Item::INTERVIEW_RADIO): ?>
                                              <div class="col-xs-3">
                                                  <span class="ad-text-header"><?= $interview['item_name'] ?></span>
                                              </div>
                                              <div class="col-xs-9">
                                                  <div class="form-inline">
                                                      <?php foreach($interview['interview_lists'] as $interviewList): ?>
                                                          <label class="radio ad-radio">
                                                              <input type="radio" name="status" value="1" id="status1" checked="checked">
                                                              <?= $interviewList['list_text'] ?></label>
                                                      <?php endforeach; ?>
                                                      <?php if(isset($interview['other_check']) && $interview['other_check'] == 1): ?>
                                                          <label class="radio ad-radio">
                                                              <input type="radio" name="status" value="4" id="status5" required="">
                                                              その他 </label>
                                                      <?php endif; ?>
                                                      <?= (isset($interview['required']) && $interview['required'] ==1 )?'（必須）':'' ?>
                                                  </div>
                                              </div>
                                              <p class="clearfix"></p>
                                          <?php endif; ?>
                                          <?php if($interview['type'] == Model_Interview_Item::INTERVIEW_CHECKBOX): ?>
                                              <div class="col-xs-3">
                                                  <span class="ad-text-header"><?= $interview['item_name'] ?></span>
                                              </div>
                                              <div class="col-xs-9">
                                                  <div class="form-inline">
                                                      <?php foreach($interview['interview_lists'] as $interviewList): ?>
                                                          <label class="checkbox long-label ad-checkbox"><input  value="1" type="checkbox">
                                                              <?= $interviewList['list_text'] ?> </label>
                                                      <?php endforeach; ?>
                                                      <?php if(isset($interview['other_check']) && $interview['other_check'] == 1): ?>
                                                          <label class="checkbox long-label ad-checkbox"><input  value="1" type="checkbox">
                                                              その他 </label>
                                                      <?php endif; ?>
                                                      <?php if(isset($interview['select_max']) && $interview['select_max'] > 0): ?>
                                                          （<?= $interview['select_max'] ?>つまで）
                                                      <?php endif; ?>
                                                      <?= (isset($interview['required']) && $interview['required'] ==1 )?'（必須）':'' ?>
                                                  </div>
                                              </div>
                                              <p class="clearfix"></p>
                                          <?php endif; ?>
                                      <?php endforeach; ?>
                                  <?php endif; ?>
                              </div>
                          </div>
                          <div class="modal-footer ad-text-center">
                              <button type="button" class="btn btn-default" data-dismiss="modal">閉じる
                              </button>
                          </div>
                      </div>

                  </div>
              </div>
          <?php endif; ?>

          <div class="col-xs-1 row ad-padding-right-none">
              <p class="ad-text-header">
                  審査有無
              </p>
          </div>
          <div class="col-xs-11 ">
              <div class="col-xs-5">
                  <p><?= (isset($event["approval"]) && $event["approval"]=='1')?'あり':'なし' ?></p>
              </div>
          </div>
      </div>

      <div class="col-xs-4">
      <?php if (empty($event->id)): ?>
      <?php   echo Html::anchor('admin/events/add', '戻る', array('class'=>'btn btn-default')); ?>
      <?php else: ?>
      <?php   echo Html::anchor('admin/events/edit/'. $event->id, '戻る', array('class'=>'btn btn-default')); ?>
      <?php endif; ?>
    </div>
    <div class="col-xs-4">
      <div class="form-action"><button class="btn btn-primary btn-lg btn-block" type="submit">登録する</button></div>
    </div>
  </div>

<?= Form::close() ?>
