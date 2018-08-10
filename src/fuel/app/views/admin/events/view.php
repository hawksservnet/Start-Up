<?= Form::open() ?>
<?php
$current_date = new \DateTime();
 ?>
 <style>
 a.showModal {
    color:#333;
    cursor: pointer;
 }

 a.showModal:hover, a.showModal:focus {
     text-decoration:underline;
     cursor: pointer;
 }
 .modal-body.custom {
         max-height: 560px;
    overflow: hidden;
    overflow-y: scroll;
    width: 100%;
    margin-left: 0;
    margin-right: 0;
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
 </style>
<h2>イベント詳細</h2>
<div class='event_area row'>
    <div class='col-xs-7'>
        <table class="table">
          <tr>
              <th>名称</th>
              <td><?= $event->title ?></td>
          </tr>
          <tr>
              <th>イベントID</th>
              <td><?= $event->id ?></td>
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
              <th>申込人数</th>
              <td><?= $event->getRequestNum() ?>名</td>
          </tr>
          <tr>
              <th>主催者</th>
              <td><?= $event->getOrganizer() ?></td>
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
            <tr>
                <th>問診</th>
                <td>
                    <table class="table ad-table-center" style="margin-bottom: 0px;">
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
                        <?php endif; ?>
                    </table>
                </td>
            </tr>
            <tr>
                <th>審査有無 </th>
                <td>

                    <?= (isset($event["approval"]) && $event["approval"]=='1')?'あり':'なし' ?>
                </td>
            </tr>
            <tr>
                <th>申し込み件数</th>
                <td>
                    <?php if (isset($event["approval"]) && $event["approval"]=='1')  {?>
                      <?php if($event->approval == 1 && !empty($approval_numbers)): ?>
                        承認制 現在の件数（承認：<span><?=!empty($approval_numbers['approval'])?$approval_numbers['approval']:'0'?>人</span>
                        非承認：<span><?=!empty($approval_numbers['approved'])?$approval_numbers['approved']:'0'?>人</span>
                        承認待ち：<span><?=!empty($approval_numbers['approval_waiting'])?$approval_numbers['approval_waiting']:'0'?>人</span>
                        キャンセル: <span><?=!empty($approval_numbers['status_cancel'])?$approval_numbers['status_cancel']:'0'?>人</span>
                        ）<br>合計：　<span><?=!empty($approval_numbers['status_total'])?$approval_numbers['status_total']:'0'?>人</span>
                    <?php endif; ?>
                  <?php } ?>
                    現在の件数（予約済み：<span><?=!empty($status_numbers['status_reserv'])?$status_numbers['status_reserv']:'0'?>人</span>
                    キャンセル待ち：<span><?=!empty($status_numbers['status_wait'])?$status_numbers['status_wait']:'0'?>人</span>
                    キャンセル：<span><?=!empty($status_numbers['status_cancel'])?$status_numbers['status_cancel']:'0'?>人</span>
                    参加済み: <span><?=!empty($status_numbers['status_partic'])?$status_numbers['status_partic']:'0'?>人</span>
                    ）<br>合計：　<span><?=!empty($status_numbers['status_total'])?$status_numbers['status_total']:'0'?>人</span>
                </td>
            </tr>
        </table>
        <?= Html::anchor(Uri::create('admin/events/edit/'.$event->id), '情報編集', array('class' => 'btn btn-primary')) ?>
    </div>
    <div class="col-xs-3"></div>
    <div class='col-xs-2'>
        <p class="lead"><strong>ステータス</strong></p>
        <?php foreach($event_statuses as $key => $event_status): ?>
            <div class='radio'>
                <label for="status<?= $event_status->id ?>" class="radio">
                    <?= Form::radio("event_status", $event_status->id, Input::post("event_status", isset($event)?$event->status:''), array('id' => 'status'.$event_status->id)) ?> <?= $event_status->name ?>
                </label>
            </div>
        <?php endforeach ?>
        <?= Form::submit('event_status_change','変更する', array('class'=>'btn btn-success')); ?>
    </div>
</div>
<?= Form::close() ?>

<div class=''>
    <h3>イベント参加者</h3>
    <hr>
    <?= Form::open(array('method' => 'get', 'class' => '')) ?>
    <div class="user_search_condition col-xs-6">
        <div class='row'>
            <div class='col-xs-4'>
                <div class='form-inline'>
                    <label for="user_status-<?= Model_Event_Request::STATUS_RESERVED ?>" class="checkbox">
                        <?= Form::checkbox("condition[user_status][{Model_Event_Request::STATUS_RESERVED}]", Model_Event_Request::STATUS_RESERVED, Input::get("condition.user_status.{Model_Event_Request::STATUS_RESERVED}"), array('id' => 'user_status-'.Model_Event_Request::STATUS_RESERVED)) ?>
                        予約済み
                    </label>
                </div>
            </div>
            <div class='col-xs-4'>
                <div class='form-inline'>
                    <label for="user_status-<?= Model_Event_Request::STATUS_CANCEL_WAIT ?>" class="checkbox">
                        <?= Form::checkbox("condition[user_status][{Model_Event_Request::STATUS_CANCEL_WAIT}]", Model_Event_Request::STATUS_CANCEL_WAIT, Input::get("condition.user_status.{Model_Event_Request::STATUS_CANCEL_WAIT}"), array('id' => 'user_status-'.Model_Event_Request::STATUS_CANCEL_WAIT)) ?>
                        キャンセル待ち
                    </label>
                </div>
            </div>
            <div class='col-xs-4'>
                <div class='form-inline'>
                    <label for="user_status-<?= Model_Event_Request::STATUS_PARTICIPATED ?>" class="checkbox">
                        <?= Form::checkbox("condition[user_status][{Model_Event_Request::STATUS_PARTICIPATED}]", Model_Event_Request::STATUS_PARTICIPATED, Input::get("condition.user_status.{Model_Event_Request::STATUS_PARTICIPATED}"), array('id' => 'user_status-'.Model_Event_Request::STATUS_PARTICIPATED)) ?>
                        参加済み
                    </label>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class='col-xs-8'>
                <?= Form::input("condition[keyword]", Input::get("condition.keyword"), array('class' => 'form-control', 'placeholder' => '名前/電話番号/メールアドレス')) ?>
            </div>
            <div class='col-xs-4'>
                <?= Form::submit('search', '検索', array('class' => 'btn btn-primary btn-block')) ?>
            </div>
        </div>
    </div>
    <?= Form::close() ?>
    <?= Form::open(array('action' => Uri::create('admin/events/view/'.$event->id, array(), Input::get()), 'class' => 'form-inline','id'=>'user-request-frm')) ?>
    <div class="col-xs-6" style="text-align: right;">
        <div class='row form-inline'>
            <div>選択した参加者のステータスを
                <?= Form::select('user_status', Input::post('user_status'),
                    Config::get('master.REQUEST_STATUS_EFFECTIVE'),
                    array('class' => 'form-control')) ?> に変更する　
                <?= Form::submit('user_status_change', '実行する', array('class' => 'btn btn-primary')) ?>
            </div>
        </div>
        <?php if($event->approval == 1): ?>
        <div class='row form-inline' style="margin-top: 20px;">
            <div>選択した参加者の承認ステータスを
                <?= Form::select('approval_status', Input::post('approval_status'),
                    Config::get('master.APPROVAL_STATUS'),
                    array('id'=>'approval-status','class' => 'form-control')) ?> に変更する　　
                <button type="button" class="btn btn-primary" onclick="<?= ($event->approval == 1)?'changeAllApprovalStatus();':'return false;' ?>">実行する</button>
            </div>

        </div>
        <?php endif; ?>
    </div>
    <div class="col-xs-12" style="padding:0;"><hr></div>
    <div class="user_area">
    <table class="table" style="margin-top: 20px;">
        <thead>
            <tr>
                <th></th>
                <th>名前</th>
                <th>年齢</th>
                <th>性別</th>
                <th>会員ステータス</th>
                <th>申込日時</th>
                <th>問診</th>
                <th>ステータス</th>
                <th>承認</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tot=0;
             foreach ($event_requests as $key => $event_request): ?>
                <?php $event_user = $event_request->user ?>
                <?php if (empty($event_user)) continue; ?>
                <?php $there_are_requests = true; ?>
                <tr>
                    <td>

                    <?= Form::checkbox("target_requests[{$event_request->id}]", $event_user->id, Input::post("target_requests.{$event_request->id}")) ?></td>
                    <td><?php echo Html::anchor('admin/users/show/'.$event_user->id, $event_user->getName(),array("target" => "_blank")); ?></td>
                    <td><?= !empty($event_user->birthday)?floor(date_diff(date_create($event_user->birthday), date_create('today'))->y ):'0' ?></td>
                    <td><?= $event_user->getSex() ?></td>

                    <td>
                    <?= !empty($event_user->type)? Config::get('master.USER_TYPES')[$event_user->type]:'' ?>
                    </td>
                    <td><?= date('Y-m-d H:i',$event_request->created_at) ?></td>
                    <td>

                        <?php
                        $first = '';
                        $tooltips=[];
                        $anws= Model_Interview_Answer::findByEventRequestIdToArray($event_request->id);

                        ?>
                        <p data-toggle="tooltip" data-html="true">
                            <?php
                                if (count($anws )){
                                    ?>
                                    <a  class='showModal'  data-toggle="modal" data-target="#myModal-page_<?= $event_request->id ?>">あり</a>
                                    <div id="myModal-page_<?= $event_request->id ?>" class="modal fade" role="dialog" >
                                        <div class="modal-dialog " style="width:50%">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title ad-text-center ad-text-header">問診画面プレビュー</h4>
                                                </div>
                                                <div class="modal-body custom row">
                                                    <div class="col-xs-12 ad-none-padding">
                                                    <?php
                                                        foreach($anws as $row) {
                                                             if($row->interview_items->type == Model_Interview_Item::INTERVIEW_TEXT ||
                                                                $row->interview_items->type == Model_Interview_Item::INTERVIEW_TEXTAREA){
                                                            ?>
                                                                <div class="col-xs-4">
                                                                    <span ><?php echo $row->interview_items->item_name ?></span>
                                                                </div>
                                                                <div class="col-xs-8">
                                                                    <div class='wordwrap'>
                                                                    <?= $row->answer_text?>
                                                                    </div>
                                                                </div>
                                                                <p class="clearfix"></p>
                                                            <?php
                                                                } elseif($row->interview_items->type == Model_Interview_Item::INTERVIEW_RADIO ||
                                                                    $row->interview_items->type == Model_Interview_Item::INTERVIEW_CHECKBOX) {
                                                                    ?>
                                                                    <div class="col-xs-4">
                                                                        <span ><?php echo $row->interview_items->item_name ?></span>
                                                                    </div>
                                                                    <div class="col-xs-8">
                                                                        <?= str_replace(';','/',$row->answer_value);?>
                                                                        <?php
                                                                        if (!empty($row->answer_text)) {
                                                                            echo '<br/>'.$row->answer_text;
                                                                        }
                                                                         ?>
                                                                    </div>
                                                                    <p class="clearfix"></p>
                                                                    <?php
                                                           }
                                                        }
                                                    ?>
                                                    </div>
                                                </div>
                                                <div class="modal-footer ad-text-center">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    echo 'なし';
                                }
                             ?>
                        </p>
                    </td>
                    <td>
                        <?php
                        $erStatus = '';
                        /*
                        if(!in_array($event_request->status,[Model_Event_Request::STATUS_CANCEL_WAIT, Model_Event_Request::STATUS_PARTICIPATED, Model_Event_Request::STATUS_CANCEL])){
                            if($event->approval == 1){
                                if($event_request->approval == Model_Event_Request::APPROVAL) {
                                    $erStatus = '当選';
                                } else if($event_request->approval == Model_Event_Request::NON_APPROVED) {
                                    $erStatus = '落選';
                                } else if($event_request->approval == Model_Event_Request::APPROVAL_WAITING) {
                                    $erStatus = '審査中';
                                }
                            } else {
                                if($event_request->status == Model_Event_Request::STATUS_RESERVED) {
                                    $erStatus = $event_request->getStatus();
                                }
                            }
                        } else {
                            $erStatus = $event_request->getStatus();
                        }
                        */
                        if ($event_request->status == Model_Event_Request::STATUS_CANCEL_WAIT) {
                            $erStatus = 'キャンセル待ち';
                        } else if ($event_request->status == Model_Event_Request::STATUS_PARTICIPATED) {
                           $erStatus = '参加済み';
                        } else if ($event_request->status == Model_Event_Request::STATUS_CANCEL) {
                           if ($event_request->approval ==  Model_Event_Request::APPROVAL)
                            $erStatus = 'キャンセル（承認後）';
                        else 
                            $erStatus = 'キャンセル';
                        } else {
                            if ($event->approval == 0){
                                if($event_request->status == Model_Event_Request::STATUS_RESERVED) {
                                    $erStatus = '予約済';
                                }
                            } else {
                                if ($event_request->approval == Model_Event_Request::APPROVAL_WAITING) {
                                    $erStatus = '審査中';
                                } else if ($event_request->approval == Model_Event_Request::APPROVAL) {
                                    $erStatus = '当選';
                                } else if ($event_request->approval == Model_Event_Request::NON_APPROVED) {
                                    $erStatus = '落選';
                                }

                            }
                        }
                        echo $erStatus;
                        ?>
                    </td>
                    <td>
                        <?php
                            $start_date= date("Y-m-d H:i", strtotime($event->start_time));
                        ?>
                            <?php if ($start_date < $current_date->format('Y-m-d H:i') || $event_request->status==99 ||  $event_request->status ==31):?>

                            <?php  else :?>
                               <?php if($event_request->approval == 0 ): ?>
                                <?= Form::select('approval_status_' . $event_request->id, $event_request->approval,
                                    Config::get('master.APPROVAL_STATUS'),
                                    array(
                                        'id' => 'approval-status-' . $event_request->id,
                                        'class' => 'form-control',
                                        'onchange' => "updateIndividualApprovalStatus({$event_request->id}, this);",
                                        'data-old-status' => $event_request->approval
                                )) ?>
                                <?php elseif($event_request->approval == 1) :?>
                                    <select id="approval-status-<?= $event_request->id ?>" class="form-control" onchange="updateIndividualApprovalStatus('<?= $event_request->id ?>', this);" data-old-status="0" name="approval_status_<?= $event_request->id ?>">
                                        <option value="1" selected="selected">承認</option>
                                    </select>
                                <?php elseif($event_request->approval == 2) :?>
                                    <select id="approval-status-<?= $event_request->id ?>" class="form-control" onchange="updateIndividualApprovalStatus('<?= $event_request->id ?>', this);" data-old-status="0" name="approval_status_<?= $event_request->id ?>">
                                        <option value="2" selected="selected">非承認</option>
                                    </select>
                            <?php endif;?>
                        <?php endif;?>


                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    </div>
    <!-- Modal -->
    <div id="cancel-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">承認・非承認コメント入力フォーム</h4>
                </div>
                <div class="modal-body">
                    <div class="ad-show-time">
                        <p style="color:red;" id="modal-error-message"></p>
                    </div>
                    <p>コメント</p>
                    <?= Form::textarea("approval_cancel_comment", "", array('id'=>'approval-cancel-comment','class' => 'ad-textarea', 'placeholder' => 'コメント')) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submitAllStatus();">実行</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div id="confirm-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <div class="ad-show-time">
                        承認ステータス変更を実行します。よろしいですか？
                    </div>
                </div>
                <div class="modal-footer">
                    <?= Form::submit('all_approval_change', 'OK', array('class' => 'btn btn-primary')) ?>
                    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                </div>
            </div>

        </div>
    </div>

    <?= Form::close() ?>
</div>

<br>
<div class='row form-inline'>
  <?php if (strpos(Input::referrer(), '/edit_confirm/')): ?>
    <?php echo Html::anchor('admin/events/', 'イベント一覧に戻る', array('class'=>'btn btn-default')); ?>
  <?php else: ?>
    <a id="back-btn" class="btn btn-default" onclick="history.back();return false">
      <span>イベント一覧に戻る</span>
    </a>
  <?php endif; ?>

  <?php if (!empty($there_are_requests)): ?>
  <?php echo Html::anchor('admin/events/export_csv/'. $event->id .'?'. http_build_query(Input::get()),
    'CSVエクスポート', array('class'=>'btn btn-success')); ?>
  <?php endif; ?>
</div>
<?= Form::open(array('action' => Uri::create('admin/events/view/'.$event->id, array(), Input::get()), 'class' => 'form-inline', 'id'=>'individual-aproval-frm')) ?>
<?= Form::hidden("individual_approval_id","",array('id'=>'individual-approval-id')) ?>
<?= Form::hidden("individual_approval_value","",array('id'=>'individual-approval-value')) ?>
<!-- Modal -->
<div id="individual-cancel-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">承認・非承認コメント入力フォーム</h4>
            </div>
            <div class="modal-body">
                <div class="ad-show-time">
                    <p style="color:red;" id="individual-modal-error-message"></p>
                </div>
                <p>コメント</p>
                <?= Form::textarea("approval_cancel_comment", "", array('id'=>'individual-approval-cancel-comment','class' => 'ad-textarea', 'placeholder' => 'コメント')) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submitIndividualStatus();">実行</button>
                <button type="button" class="btn btn-default" onclick="revertIndividualStatus();">キャンセル</button>
            </div>
        </div>

    </div>
</div>
<!-- Modal -->
<div id="individual-confirm-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="ad-show-time">
                    承認ステータス変更を実行します。よろしいですか？
                </div>
            </div>
            <div class="modal-footer">
                <?= Form::submit('individual_approval_change', 'OK', array('class' => 'btn btn-primary')) ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
            </div>
        </div>

    </div>
</div>
<?= Form::close() ?>
<script>
    $(document).ready(function () {
       // $('[data-toggle="tooltip"]').tooltip();
    });
    function updateIndividualApprovalStatus(requestId, elm){
        if(elm.value == $(elm).attr('data-old-status')) return false;
        var val = elm.value;
        $('#individual-approval-id').val(requestId);
        $('#individual-approval-value').val(val);
        //$('#individual-approval-cancel-comment').val('');
        if(val == '1' || val == '2'){
            $('#individual-cancel-modal').modal("show");
        }else{
            $('#individual-confirm-modal').modal("show");
        }
        return true;
    }
    function changeAllApprovalStatus(elm){
        var val = $('#approval-status').val();
        //$('#approval-cancel-comment').val('');
        if(val == '1' || val == '2'){
            $('#cancel-modal').modal("show");
        }else{
            $('#confirm-modal').modal("show");
        }
        return true;
    }
    function revertIndividualStatus(){
        var elm = '#approval-status-' + $('#individual-approval-id').val();
        $(elm).val($(elm).attr('data-old-status'));
        $('#individual-approval-id').val('');
        $('#individual-approval-value').val('');
        $('#individual-cancel-modal').modal("toggle");
        return true;
    }
    function submitIndividualStatus(){
        $('#individual-modal-error-message').text('');
         $('#individual-confirm-modal').modal('show');
        /*
        if($('#individual-approval-cancel-comment').val().trim().length > 0){
            $('#individual-confirm-modal').modal('show');
        } else {
            $('#individual-modal-error-message').text('この項目は必須入力です。');
        }
        */
        return true;
    }
    function submitAllStatus(){
        $('#modal-error-message').text('');
         $('#confirm-modal').modal('show');
        /*
        if($('#approval-cancel-comment').val().trim().length > 0){
            $('#confirm-modal').modal('show');
        } else {
            $('#modal-error-message').text('この項目は必須入力です。');
        }
        */
        return true;
    }
</script>
