<div class="row">
  <div class="col-xs-6">
    <div class="form-group">
      <label>イベント名称<span class="required">（必須）</span></label>
      <input type="title" class="form-control" name="title"
            value="<?= Input::post("title", isset($event)?$event->title:'') ?>" required>
    </div>
    <div class="form-group">
      <label>イベントページURL</label>
      <input type="wp_url" class="form-control" name="wp_url"
            value="<?= Input::post("wp_url", isset($event)?$event->wp_url:'') ?>">
    </div>
    <div class="form-group">
      <label>画像URL</label>
      <input type="img_url" class="form-control" name="img_url"
            value="<?= Input::post("img_url", isset($event)?$event->img_url:'') ?>">
    </div>
    <div class="form-group">
      <label>開催日</label>
      <div class="form-inline">
        <select name="start_year" class="form-control">
            <?php $input_year = Input::post("start_year", isset($event)?$event->getStartYear():''); ?>
            <?php foreach(range(2017,2018) as $year): ?>
              <option value="<?=$year?>"
                <?php echo ($input_year==$year)?'selected':''; ?>
                <?php if (empty($input_year)and $year==2017) echo 'selected'; ?>>
              <?=$year?>年
              </option>
            <?php endforeach; ?>
        </select>
        <select name="start_month" class="form-control">
            <?php $input_month = Input::post("start_month", isset($event)?$event->getStartMonth():''); ?>
            <?php foreach(range(1,12) as $month): ?>
              <option value="<?=str_pad($month,2,0,STR_PAD_LEFT)?>"
                <?php echo ($input_month==$month)?'selected':''; ?>
                <?php if (empty($input_month)and $month==1) echo 'selected'; ?>>
              <?=$month?>月
              </option>
            <?php endforeach; ?>
        </select>
        <select name="start_day" class="form-control">
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
    </div>
    <div class="form-group">
      <label>開催時刻</label>
      <div class="form-inline">
        <select name="start_hour" class="form-control">
            <?php $input_hour = Input::post("start_hour", isset($event)?$event->getStartHour():''); ?>
            <?php foreach(range(0,23) as $hour): ?>
              <option value="<?=str_pad($hour,2,0,STR_PAD_LEFT)?>"
                <?php echo ($input_hour==$hour)?'selected':''; ?>
                <?php if (empty($input_hour)and $hour==10) echo 'selected'; ?>>
              <?=$hour?>時
              </option>
            <?php endforeach; ?>
        </select>
        <select name="start_min" class="form-control">
            <?php $input_min = Input::post("start_min", isset($event)?$event->getStartMin():''); ?>
            <?php foreach(range(0,59) as $min): ?>
              <option value="<?=str_pad($min,2,0,STR_PAD_LEFT)?>"
                <?php echo ($input_min==$min)?'selected':''; ?>>
              <?=$min?>分
              </option>
            <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label>終了時刻</label>
      <div class="form-inline">
        <select name="end_hour" class="form-control">
            <?php $input_hour = Input::post("end_hour", isset($event)?$event->getEndHour():''); ?>
            <?php foreach(range(0,23) as $hour): ?>
              <option value="<?=str_pad($hour,2,0,STR_PAD_LEFT)?>"
                <?php echo ($input_hour==$hour)?'selected':''; ?>
                <?php if (empty($input_hour)and $hour==10) echo 'selected'; ?>>
              <?=$hour?>時
              </option>
            <?php endforeach; ?>
        </select>
        <select name="end_min" class="form-control">
            <?php $input_min = Input::post("end_min", isset($event)?$event->getEndMin():''); ?>
            <?php foreach(range(0,59) as $min): ?>
              <option value="<?=str_pad($min,2,0,STR_PAD_LEFT)?>"
                <?php echo ($input_min==$min)?'selected':''; ?>>
              <?=$min?>分
              </option>
            <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label>受付開始時刻</label>
      <div class="form-inline">
        <select name="reception_hour" class="form-control">
            <?php $input_hour = Input::post("reception_hour", isset($event)?$event->getReceptionHour():''); ?>
            <?php foreach(range(0,23) as $hour): ?>
              <option value="<?=str_pad($hour,2,0,STR_PAD_LEFT)?>"
                <?php echo ($input_hour==$hour)?'selected':''; ?>
                <?php if (empty($input_hour)and $hour==10) echo 'selected'; ?>>
              <?=$hour?>時
              </option>
            <?php endforeach; ?>
        </select>
        <select name="reception_min" class="form-control">
            <?php $input_min = Input::post("reception_min", isset($event)?$event->getReceptionMin():''); ?>
            <?php foreach(range(0,59) as $min): ?>
              <option value="<?=str_pad($min,2,0,STR_PAD_LEFT)?>"
                <?php echo ($input_min==$min)?'selected':''; ?>>
              <?=$min?>分
              </option>
            <?php endforeach; ?>
        </select>      </div>
    </div>
    <div class="form-group">
      <label>料金<span class="required">（必須）</span></label>
      <div class="input-group">
        <input type="charge" class="form-control" name="charge"
            value="<?= Input::post("charge", isset($event)?$event->charge:'') ?>" required>
        <div class="input-group-addon">円</div>
      </div>
      <p class="guide">※半角数字で入力して下さい。</p>
    </div>
    <div class="form-group">
      <label>定員数<span class="required">（必須）</span></label>
      <div class="input-group">
        <input type="capacity" class="form-control" name="capacity"
            value="<?= Input::post("capacity", isset($event)?$event->capacity:'') ?>" required>
        <div class="input-group-addon">名</div>
      </div>
      <p class="guide">※半角数字で入力して下さい。</p>
    </div>
    <div class="form-group">
      <label>主催者<span class="required">（必須）</span></label>
      <input type="organizer" class="form-control" name="organizer"
          value="<?= Input::post("organizer", isset($event)?$event->organizer:'') ?>" required>
      <p class="help-block">入力者と主催者が異なる場合にのみ、オーガナイザーアカウントのメールアドレスを入力して下さい。</p>
    </div>
    <div class="form-group">
      <label>ステータス<span class="required">（必須）</span></label>
      <div class="form-inline">
        <?php foreach($event_statuses as $key => $event_status): ?>
          <label class="radio">
            <input type="radio" name="status" value="<?= $event_status->id ?>" id="status<?= $event_status->id ?>"
            <?= (Input::post('status', isset($event)?$event->status:'')==$event_status->id)?'checked="checked"':'' ?> required>
              <?= $event_status->name ?>
          </label>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="form-group">
      <label>カテゴリ（複数選択可）</label>
      <div class="form-inline">
        <?php foreach ($categories as $key => $category): ?>
          <label class="checkbox long-label"><?= Form::checkbox("categories[$category->id]", $category->id, Input::post("categories.{$category->id}", isset($event)?$event->hasCategory($category->id):''), array('id' => 'category-'.$category->id)) ?> <?= $category->name ?></label>
        <?php endforeach ?>
      </div>
    </div>
    <div class="form-group">
      <label>タグ（複数選択可）</label>
      <div class="form-inline">
        <?php foreach ($tags as $key => $tag): ?>
          <label class="checkbox long-label"><?= Form::checkbox("tags[{$tag->id}]", $tag->id, Input::post("tags.{$tag->id}", isset($event)?$event->hasTag($tag->id):''), array('id' => 'tag-'.$tag->id)) ?> <?= $tag->name ?></label>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</div>
