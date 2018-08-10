<h2>メンバー詳細</h2>

<div class="row">

	<div class="col-sm-5">
		<table class="table">
			<tr>
				<th>
					<?php echo Form::label('ユーザーID', 'address', array('class'=>'control-label')); ?>
				</th>
				<td>
					<?= $user->id ?>
				</td>
			</tr>
			<tr>
				<th>
					<?php echo Form::label('名前', 'address', array('class'=>'control-label')); ?>
				</th>
				<td>
					<?= $user->name_last.$user->name_first; ?>
				</td>
			</tr>
			<tr>
				<th><?php echo Form::label('よみがな', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->hiragana_name_last.$user->hiragana_name_first; ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('メールアドレス', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->email; ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('電話番号', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->tel; ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('生年月', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->getBirthday(); ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('性別', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->sex==1?'男性':'女性'; ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('国籍', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->nationality; ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('郵便番号', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->zip; ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('都道府県', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->getPref(); ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('市区郡町村', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->city; ?></td>
			</tr>
		</table>
	</div>

	<div class="col-sm-5">
		<table class="table">
			<tr>
				<th><?php echo Form::label('所属組織名', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->organization; ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('役職', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->position; ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('職種', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->getJob(); ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('入館カードID', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->cardid; ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('起業についての興味', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->interest==1?'あり':'なし'; ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('起業の準備', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->getPreparation(); ?></td>
			</tr>

			<tr>
				<th><?php echo Form::label('DMによる案内', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->mailmagazine_info?'受け取る':'受け取らない' ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('アカウント種別', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->group?Config::get('master.USER_GROUP')[$user->group]:''; ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('登録日', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->created_at?date('Y/m/d', $user->created_at):'' ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('最終ログイン', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->last_login?date('Y/m/d', $user->last_login):'' ?></td>
			</tr>
		</table>
		<?php echo Html::anchor('admin/users/edit/'.$user->id, '会員情報編集', array('class' => 'btn btn-primary')); ?>
		<?php echo Html::anchor('admin/users/edit_pw/'.$user->id, 'パスワード設定', array('class' => 'btn btn-primary')); ?>
	</div>

	<div class="col-sm-2">
		<?php echo Form::label('会員種別', 'address', array('class'=>'control-label')); ?>
			<?= Form::open('admin/users/status_change/'.$user->id); ?>
				<?php foreach(Config::get('master.USER_TYPES') as $key=>$user_type): ?>
					<div class="radio">
						<label><?= Form::radio('type',$key,$user->type).$user_type; ?></label>
					</div>
				<?php endforeach; ?>
				<?= Form::submit('submit','変更する', array('class'=>'btn btn-success')); ?>
			<?= Form::close(); ?>
	</div>
</div>

<h3>イベント申込・参加履歴</h3>
<?php if (empty($user->event_requests)): ?>
<p>イベント申込・参加履歴はありません。</p>

<?php else: ?>
<table class="table">
	<tr>
		<th>イベント名称</th>
		<th>開催日</th>
		<th>参加状態</th>
		<th>申し込み日</th>
		<th>オーガナイザー</th>
		<th>詳細</th>
	</tr>
	<?php foreach($user->event_requests  as $event_request): ?>
		<tr>
			<td><?= $event_request->event->title; ?></td>
			<td><?= $event_request->event->start_date; ?></td>
			<td><?= $event_request->getStatus(); ?></td>
			<td><?= $event_request->event->start_date; ?></td>
			<td><?= $event_request->event->organizer; ?></td>
			<td><?php echo Html::anchor('admin/events/view/'.$event_request->event->id, '　詳細　', array('class' => 'btn btn-primary btn-xs')); ?></td>
		</tr>
	<?php endforeach; ?>

</table>
<?php endif; ?>

<h3>プレアントレ申請内容</h3>
<?php if (empty($preentre_request)): ?>
<p>申請はありません。</p>

<?php else: ?>
	<table class="table">
		<tr>
			<th>ステータス</th>
			<th>申請日</th>
			<th>承認日</th>
			<th>有効期限</th>
			<th>問診</th>
		</tr>
<?php foreach($user->preentre_requests  as $preentre_request2): ?>
	<tr>
	<td><b><?= $preentre_request2->getStatus(); ?></b></td><!-- ステータス -->
	<td><?= date('Y/m/d H:i:s', $preentre_request2->created_at) ?></td><!-- 申請日 -->
	<td><?php echo $preentre_request2->updated_at?date('Y/m/d H:i:s', $preentre_request2->updated_at):null; ?></td><!-- 承認日 -->
	<td><?php
	if (!empty($preentre_request2->updated_at)){
		$end_at = mktime(0, 0, 0, date('m', $preentre_request2->updated_at) + 4, 0, date('Y', $preentre_request2->updated_at));
		if(strtotime(date("Y/m/d")) < strtotime(date('Y/m/d', $end_at))){
			echo date('Y/m/d', $end_at);
		}else{
			echo "<font color='red'>".date('Y/m/d', $end_at)."</font>";
		}
	}
		?>  
	</td><!-- 有効期限 -->
　<td>
	<?php if ($preentre_request2->status == '31'): ?>
	継続のためなし
	<?php else: ?>
	<div class="row">
	    <div id="preentre">
	      <div class="col-sm-5">
              <dl class="clearfix">
                  <dt>起業への意思</dt>
                  <dd><?= $preentre_request2->getIntention() ?></dd>
              </dl>
              <dl class="clearfix">
                  <dt>どういった事業をお考えですか？</dt>
                  <dd><?= $preentre_request2->getBusinessType() ?></dd>
                  <dd><?= $preentre_request2->business_type_text ?></dd>
              </dl>
              <dl class="clearfix">
                  <dt>起業スタイルはどのようにお考えですか？</dt>
                  <dd><?= $preentre_request2->getBusinessStyle() ?></dd>
                  <dd><?= $preentre_request2->business_style_text ?></dd>
              </dl>
              <dl class="clearfix">
                  <dt>現在どういったお悩みを持っていますか？</dt>
                <?php foreach ($preentre_request2->getBusinessProblems() as $key => $problem): ?>
                  <dd class="<?= $preentre_request2->getBusinessProblemClass($key) ?>">
                    <?= $problem ?>
                  </dd>
                <?php endforeach; ?>
                  <dd><?= $preentre_request2->problem_text ?></dd>
              </dl>
              <dl class="clearfix">
                  <dt>希望するサービス</dt>
                <?php foreach ($preentre_request2->getWishes() as $key => $wish): ?>
                  <dd class="">
                    <?= $wish ?>
                  </dd>
                <?php endforeach; ?>
              </dl>
	      </div><!-- col-sm-5 -->
	    </div><!-- preentre -->
	</div><!-- row -->
	<?php endif; ?>
	</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

<hr>
<?php if ($from_index): // 検索クエリを消さないように戻る ?>
  <a id="back-btn" class="btn btn-default" onclick="history.back();return false">
    <span>ユーザー一覧に戻る</span>
  </a>
<?php else: ?>
  <?php echo Html::anchor('admin/users', 'ユーザー一覧に戻る', array('class'=>'btn btn-default')); ?>
<?php endif; ?>
