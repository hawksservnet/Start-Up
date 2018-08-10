<h2>イベント問診設定</h2>
<div class="col-xs-6 ad-show-time">
	<p  style="color:red;" id="error-message-area" ></p>
</div>
<?php
    $initType = Input::post("interview_types", !empty($interview)?$interview->type:1);
?>
<?= Form::open(array('action' => Uri::create("admin/events/interview/" . $event_id . "/" . (!empty($id) ? $id:''), Input::get()), 'id'=>'event-interview-frm')) ?>
<?= Form::hidden("id",!empty($id) ? $id:0) ?>
<?= Form::hidden("event_id",$event_id) ?>
	<div class="row">
		<div class="col-xs-12 row">
			<div class="form-group clearfix">
				<div class="col-xs-1">
					<span class="ad-text-header ad-aline">
						タイプ
					</span>
				</div>
				<div class="col-xs-11">
					<div class="col-xs-5">
						<?= Form::select('interview_types', $initType,
							Config::get('master.INTERVIEW_TYPE'),
							array('id'=>'interview-types','class' => 'form-control')) ?>
					</div>
				</div>
			</div>
			<div id="ad-name" class="form-group clearfix ">
				<div class="col-xs-1">
					<span class="ad-text-header ad-aline" id="item-name-header">
						項目名
					</span>
				</div>
				<div class="col-xs-11">
					<div class="col-xs-5">
						<input type="text" maxlength="255" value="<?= Input::post("item_name", !empty($interview)?$interview->item_name:'') ?>" class="form-control" name="item_name" id="item-name">

					</div>
				</div>
			</div>
            <?php
            $list_text = "";
            if(!empty($interview->interview_lists)){
                foreach($interview->interview_lists as $interview_list){
                    if(!empty($list_text)) $list_text = $list_text . PHP_EOL;
                    $list_text = $list_text . $interview_list->list_text;
                }
            }
            ?>
			<div id="ad-textarea"  class="form-group clearfix" style="<?= ($initType == 2 || $initType == 3)?'':'display:none;' ?>">
				<div class="col-xs-1">
					<span class="ad-text-header ad-aline" id="list-text-header">
						選択肢
					</span>
				</div>
				<div class="col-xs-11">
					<div class="col-xs-5">
						<textarea onchange="onListTextChange($(this));" rows="5" cols="25" class="ad-textarea-custom" name="list_text" id="list-text" value="<?= Input::post("list_text", !empty($list_text)?$list_text:'') ?>"><?= Input::post("list_text", !empty($list_text)?$list_text:'') ?></textarea>
					</div>
				</div>
			</div>
			<div id="ad-other" class="form-group clearfix" style="<?= ($initType == 2 || $initType == 3)?'':'display:none;' ?>">
				<div class="col-xs-1">
					<span class="ad-text-header ad-aline">
						その他
					</span>
				</div>
				<div class="col-xs-11">
					<div class="col-xs-5">
						<div class="form-inline">
							<label class="radio ad-radio">
								<input type="radio" name="other_check" value="1" id="status1" <?= Input::post('other_check', !empty($interview) && $interview->other_check == 1 )? 'checked="checked"':'' ?>>
								使う </label>
							<label class="radio ad-radio">
								<input type="radio" name="other_check" value="0" id="status2" <?= Input::post('other_check', !empty($interview) && $interview->other_check == 1 )? '':'checked="checked"' ?>>
								使わない </label>
						</div>
					</div>
				</div>
			</div>
			<div id="ad-number-max" class="form-group clearfix" style="<?= ($initType == 3)?'':'display:none;' ?>">
				<div class="col-xs-1 ad-padding-right-none">
					<span class="ad-text-header ad-aline" id="select-max-header">
						最大選択数
					</span>
				</div>
				<div class="col-xs-11 ">
					<div class="col-xs-5">
						<div class="col-xs-6 row">
                            <input type="text" id="select-max" onchange="onSelectMaxChange($(this));" maxlength="3" value="<?= Input::post("select_max", !empty($interview)?(!empty($interview->select_max)?$interview->select_max:'' ):'') ?>" class="form-control ad-select" name="select_max">
                        </div>
						<div class="col-xs-6 ">
							<span class="ad-aline">
								個
							</span>
						</div>
					</div>
				</div>
			</div>
			<div id="ad-checkbox" class="form-group clearfix">
				<div class="col-xs-1 ad-padding-right-none">
					<span class="ad-text-header ad-aline">
						必須
					</span>
				</div>
				<div class="col-xs-11 ">
					<div class="col-xs-5">
                        <?= Form::checkbox('required', 1, Input::post("item_name", !empty($interview)?$interview->required:0)) ?>
					</div>
				</div>
			</div>

		</div>

		<div class="col-xs-12">
			<div class="form-action ad-form-center">
                <?php if(!empty($id) && $id > 0): ?>
                <button class="btn btn-primary btn-lg ad-btn-lg" type="button" onclick="$('#delete-confirm-modal').modal('show');return true;">削除</button>
                <?php endif; ?>
                <button class="btn btn-primary btn-lg ad-btn-lg" type="button" onclick="submitUpdateForm();">更新</button>
				<a class="btn btn-primary btn-lg ad-btn-lg" href="<?= Uri::create("admin/events/edit/" . $event_id); ?>">戻る</a>
			</div>
		</div>
	</div>
<!-- Modal -->
<div id="update-confirm-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="ad-show-time">
                    問診データ登録を実行します。よろしいですか？
                </div>
            </div>
            <div class="modal-footer">
                <?= Form::submit('update_interview', 'OK', array('class' => 'btn btn-primary')) ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
            </div>
        </div>

    </div>
</div>
<?= Form::close() ?>
<?php if(!empty($id)): ?>
    <?= Form::open(array('action' => Uri::create("admin/events/interview/" . $event_id . "/" . $id), 'id'=>'event-interview-delete-frm')) ?>
    <?= Form::hidden("delete_interview_id",$id) ?>
    <?= Form::hidden("delete_interview_event_id",$event_id) ?>
    <!-- Modal -->
    <div id="delete-confirm-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <div class="ad-show-time">
                        問診を削除します。よろしいですか？
                    </div>
                </div>
                <div class="modal-footer">
                    <?= Form::submit('delete_interview', 'OK', array('class' => 'btn btn-primary')) ?>
                    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                </div>
            </div>

        </div>
    </div>
    <?= Form::close() ?>
<?php endif; ?>
<script>
$(document).ready(function () {
    $('#interview-types').on('change', function() {
        if ( this.value == '1' || this.value == '4')
        {
            $("#ad-textarea").fadeOut();
            $("#ad-other").fadeOut();
            $("#ad-number-max").fadeOut();
            return
        }
        if ( this.value == '2')
        {
            $("#ad-textarea").fadeIn();
            $("#ad-other").fadeIn();
            $("#ad-number-max").fadeOut();
            return
        }
        else
        {
            $("#ad-textarea").fadeIn();
            $("#ad-other").fadeIn();
            $("#ad-number-max").fadeIn();
            return
        }
    });

});
function onSelectMaxChange(elm){
    var emp = elm.val().replace(/[^0-9]/g, "");
    elm.val(emp);
    return true;
}
function onListTextChange(elm){
    var lines = [];
    $.each(elm.val().split(/\n/), function(i, line){
        if(line && line.trim().length > 0){
            lines.push(line);
        }
    });
    elm.val(lines.join("\n"));
}
function submitUpdateForm(){
    $('#error-message-area').text('');
    $('.ad-text-header').css('color','#333');
    var interview_type = $('#interview-types').val();
    var requiredValid = true;
    var maxSelectValid = true;
    var listTextLines = 0;
    if($('#item-name').val().trim().length < 1){
        requiredValid = false;
        $('#item-name-header').css('color','red');
    }
    if(interview_type == '2' || interview_type == '3') {
        if($('#list-text').val().trim().length < 1){
            requiredValid = false;
            $('#list-text-header').css('color','red');
        }
        if (interview_type == '3') {
            /*
            if ($('#select-max').val().trim().length < 1) {
                requiredValid = false;
                $('#select-max-header').css('color', 'red');
            }*/
            if (requiredValid) {
                listTextLines = $('#list-text').val().split(/\n/).length;
                var selectMax = parseInt($('#select-max').val());
                if( selectMax == 0 || selectMax > listTextLines){
                    maxSelectValid = false;
                    $('#select-max-header').css('color', 'red');
                }
            }
        }
    }
    if(requiredValid && maxSelectValid){
        $('#update-confirm-modal').modal('show');
        return true;
    }else{
        if(!requiredValid){
            $('#error-message-area').text('この項目は必須入力です。');
        } else {
            var msg = '1は' + listTextLines + '以下で入力してください。';
            $('#error-message-area').text(msg);
        }
        return false;
    }
    return false;
}
</script>