<?php if (empty($user->id)): ?>
  <h2>メンバー登録確認</h2>
<?php else: ?>
  <h2>メンバー情報編集確認</h2>
<?php endif; ?>
<div class="row">

	<div class="col-sm-5">
		<table class="table">
			<tr>
				<th>
					<?php echo Form::label('名前', 'address', array('class'=>'control-label')); ?>
				</th>
				<td>
					<?= $user->name_last.$user->name_first; ?>
				</td>
			</tr>
			<tr>
				<th><?php echo Form::label('ふりがな', 'address', array('class'=>'control-label')); ?></th>
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
				<th><?php echo Form::label('市町村区', 'address', array('class'=>'control-label')); ?></th>
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
				<td><?= $user->mailmagazine_info?'受け取る':'受け取らない'; ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('アカウント種別', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->group?Config::get('master.USER_GROUP')[$user->group]:''; ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('会員種別', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->type?Config::get('master.USER_TYPES')[$user->type]:''; ?></td>
			</tr>
		</table>
	</div>
  
</div>

<form method="post">
  <div class="row">
    <div class="col-xs-4">
      <?php if (empty($user->id)): ?>
      <?php   echo Html::anchor('admin/users/add', '戻る', array('class'=>'btn btn-default')); ?>
      <?php else: ?>
      <?php   echo Html::anchor('admin/users/edit/'. $user->id, '戻る', array('class'=>'btn btn-default')); ?>
      <?php endif; ?>
    </div>
    <div class="col-xs-4">
      <div class="form-action"><button class="btn btn-primary btn-lg btn-block" type="submit">登録する</button></div>
    </div>
  </div>
</form>
