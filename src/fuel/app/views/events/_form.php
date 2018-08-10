            <div class="form-wrap clearfix">
              <dl class="clearfix">
                <dt class="required">イベント名称</dt>
                <dd>
                  <input type="title" class="text w180" name="title"
                      value="<?= Input::post("title", isset($event)?$event->title:'') ?>">
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="">イベントページURL</dt>
                <dd>
                  <input type="wp_url" class="text w180" name="wp_url"
                      value="<?= Input::post("title", isset($event)?$event->wp_url:'') ?>">
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="required">開催日</dt>
                <dd>
                  <div class="select w160 smp-half">
                    <select name="start_year">
                        <?php $input_year = Input::post("start_year", isset($event)?$event->getStartYear():''); ?>
                        <?php foreach(range(2017,2018) as $year): ?>
                          <option value="<?=$year?>"
                            <?php echo ($input_year==$year)?'selected':''; ?>
                            <?php if (empty($input_year)and $year==2017) echo 'selected'; ?>>
                          <?=$year?>年
                          </option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="select w160 smp-half smp-float smp-ml-none smp-mt">
                    <select name="start_month">
                        <?php $input_month = Input::post("start_month", isset($event)?$event->getStartMonth():''); ?>
                        <?php foreach(range(1,12) as $month): ?>
                          <option value="<?=str_pad($month,2,0,STR_PAD_LEFT)?>"
                            <?php echo ($input_month==$month)?'selected':''; ?>
                            <?php if (empty($input_month)and $month==1) echo 'selected'; ?>>
                          <?=$month?>月
                          </option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="select w160 smp-half smp-float smp-mt">
                    <select name="start_day">
                        <?php $input_day = Input::post("start_day", isset($event)?$event->getStartDay():''); ?>
                        <?php foreach(range(1,31) as $day): ?>
                          <option value="<?=str_pad($day,2,0,STR_PAD_LEFT)?>"
                            <?php echo ($input_day==$day)?'selected':''; ?>
                            <?php if (empty($input_day)and $day==1) echo 'selected'; ?>>
                          <?=$day?>日
                          </option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="required">開催時間</dt>
                <dd>
                  <div class="select w160 smp-half">
                    <select name="start_hour">
                        <?php $input_hour = Input::post("start_hour", isset($event)?$event->getStartHour():''); ?>
                        <?php foreach(range(0,23) as $hour): ?>
                          <option value="<?=str_pad($hour,2,0,STR_PAD_LEFT)?>"
                            <?php echo ($input_hour==$hour)?'selected':''; ?>
                            <?php if (empty($input_hour)and $hour==10) echo 'selected'; ?>>
                          <?=$hour?>時
                          </option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="select w160 smp-half smp-float smp-ml-none smp-mt">
                    <select name="start_min">
                        <?php $input_min = Input::post("start_min", isset($event)?$event->getStartMin():''); ?>
                        <?php foreach(range(0,59) as $min): ?>
                          <option value="<?=str_pad($min,2,0,STR_PAD_LEFT)?>"
                            <?php echo ($input_min==$min)?'selected':''; ?>>
                          <?=$min?>分
                          </option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="required">終了時間</dt>
                <dd>
                  <div class="select w160 smp-half">
                    <select name="end_hour">
                        <?php $input_hour = Input::post("end_hour", isset($event)?$event->getEndHour():''); ?>
                        <?php foreach(range(0,23) as $hour): ?>
                          <option value="<?=str_pad($hour,2,0,STR_PAD_LEFT)?>"
                            <?php echo ($input_hour==$hour)?'selected':''; ?>
                            <?php if (empty($input_hour)and $hour==10) echo 'selected'; ?>>
                          <?=$hour?>時
                          </option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="select w160 smp-half smp-float smp-ml-none smp-mt">
                    <select name="end_min">
                        <?php $input_min = Input::post("end_min", isset($event)?$event->getEndMin():''); ?>
                        <?php foreach(range(0,59) as $min): ?>
                          <option value="<?=str_pad($min,2,0,STR_PAD_LEFT)?>"
                            <?php echo ($input_min==$min)?'selected':''; ?>>
                          <?=$min?>分
                          </option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="required">受付開始時間</dt>
                <dd>
                  <div class="select w160 smp-half">
                    <select name="reception_hour">
                        <?php $input_hour = Input::post("reception_hour", isset($event)?$event->getReceptionHour():''); ?>
                        <?php foreach(range(0,23) as $hour): ?>
                          <option value="<?=str_pad($hour,2,0,STR_PAD_LEFT)?>"
                            <?php echo ($input_hour==$hour)?'selected':''; ?>
                            <?php if (empty($input_hour)and $hour==10) echo 'selected'; ?>>
                          <?=$hour?>時
                          </option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="select w160 smp-half smp-float smp-ml-none smp-mt">
                    <select name="reception_min">
                        <?php $input_min = Input::post("reception_min", isset($event)?$event->getReceptionMin():''); ?>
                        <?php foreach(range(0,59) as $min): ?>
                          <option value="<?=str_pad($min,2,0,STR_PAD_LEFT)?>"
                            <?php echo ($input_min==$min)?'selected':''; ?>>
                          <?=$min?>分
                          </option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="">料金</dt>
                <dd>
                  <input type="charge" class="text w180" name="charge"
                      value="<?= Input::post("title", isset($event)?$event->charge:'') ?>">円
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="">定員数</dt>
                <dd>
                  <input type="capacity" class="text w180" name="capacity"
                      value="<?= Input::post("title", isset($event)?$event->capacity:'') ?>">名
                </dd>
              </dl>
              <dl class="clearfix">
                <dt class="">主催者</dt>
                <dd>
                  <input type="organizer" class="text w180" name="organizer"
                      value="<?= Input::post("title", isset($event)?$event->organizer:'') ?>">
                </dd>
                <p>入力者と主催者が異なる場合にのみ、オーガナイザーアカウントのメールアドレスを入力して下さい。</p>
              </dl>

              <dl class="clearfix">
                <dt class="required">ステータス</dt>
                <dd>
                  <input type="radio" name="status" value="1" id="status1"
                      <?= (Input::post('status', isset($event)?$event->status:'')==1)?'checked="checked"':'' ?>">
                  <label for="status1" class="radio">公開</label>
                  <input type="radio" name="status" value="2" id="status2"
                      <?= (Input::post('status', isset($event)?$event->status:'')==2)?'checked="checked"':'' ?>">
                  <label for="status2" class="radio">締め切り済</label>
                  <input type="radio" name="status" value="3" id="status3"
                      <?= (Input::post('status', isset($event)?$event->status:'')==3)?'checked="checked"':'' ?>">
                  <label for="status3" class="radio">非公開</label>
                  <input type="radio" name="status" value="4" id="status4"
                      <?= (Input::post('status', isset($event)?$event->status:'')==4)?'checked="checked"':'' ?>">
                  <label for="status4" class="radio">承認待ち</label>
                </dd>
              </dl>

              <dl class="clearfix">
                <dt class="">カテゴリ=未実装<span>（複数選択可）</span></dt>
                <dd>
                  <input type="checkbox" name="category01" id="category01" value="1"
                      <?= (Input::post("category01"))?'checked="checked"':'' ?>>
                  <label for="category01" class="checkbox">経営専従</label>
                  <input type="checkbox" name="category02" id="category02" value="1"
                      <?= (Input::post("category02"))?'checked="checked"':'' ?>>
                  <label for="category02" class="checkbox">プランナー</label>
                  <input type="checkbox" name="category03" id="category03" value="1"
                      <?= (Input::post("category03"))?'checked="checked"':'' ?>>
                  <label for="category03" class="checkbox">マーケッター</label>
                  <input type="checkbox" name="category04" id="category04" value="1"
                      <?= (Input::post("category04"))?'checked="checked"':'' ?>>
                  <label for="category04" class="checkbox mt">エンジニア</label>
                  <input type="checkbox" name="category05" id="category05" value="1"
                      <?= (Input::post("category05"))?'checked="checked"':'' ?>>
                  <label for="category05" class="checkbox mt">研究者</label>
                  <input type="checkbox" name="category06" id="category06" value="1"
                      <?= (Input::post("category06"))?'checked="checked"':'' ?>>
                  <label for="category06" class="checkbox mt">デザイナー</label>
                </dd>
              </dl>

              <dl class="clearfix">
                <dt class="">タグ=未実装<span>（複数選択可）</span></dt>
                <dd>
                  <input type="checkbox" name="tag01" id="tag01" value="1"
                      <?= (Input::post("tag01"))?'checked="checked"':'' ?>>
                  <label for="tag01" class="checkbox">経営専従</label>
                  <input type="checkbox" name="tag02" id="tag02" value="1"
                      <?= (Input::post("tag02"))?'checked="checked"':'' ?>>
                  <label for="tag02" class="checkbox">プランナー</label>
                  <input type="checkbox" name="tag03" id="tag03" value="1"
                      <?= (Input::post("tag03"))?'checked="checked"':'' ?>>
                  <label for="tag03" class="checkbox">マーケッター</label>
                  <input type="checkbox" name="tag04" id="tag04" value="1"
                      <?= (Input::post("tag04"))?'checked="checked"':'' ?>>
                  <label for="tag04" class="checkbox mt">エンジニア</label>
                  <input type="checkbox" name="tag05" id="tag05" value="1"
                      <?= (Input::post("tag05"))?'checked="checked"':'' ?>>
                  <label for="tag05" class="checkbox mt">研究者</label>
                  <input type="checkbox" name="tag06" id="tag06" value="1"
                      <?= (Input::post("tag06"))?'checked="checked"':'' ?>>
                  <label for="tag06" class="checkbox mt">デザイナー</label>
                </dd>
              </dl>
            </div>
