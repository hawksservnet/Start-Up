<h2>プレアントレ申請確認</h2>

<h3 class="">申請内容</h3>

<div class="row">
  <div class="col-sm-5">
        <div id="preentre" class="section-container">
            <div class="section-inner">
                <div class="section-contents">
                                <dl class="clearfix">
                                    <dt>起業への意思</dt>
                                    <dd><?= $preentre_request->getIntention() ?></dd>
                                </dl>
                                <dl class="clearfix">
                                    <dt>どういった事業をお考えですか？</dt>
                                    <dd><?= $preentre_request->getBusinessType() ?></dd>
                                    <dd><?= $preentre_request->business_type_text ?></dd>
                                </dl>
                                <dl class="clearfix">
                                    <dt>起業スタイルはどのようにお考えですか？</dt>
                                    <dd><?= $preentre_request->getBusinessStyle() ?></dd>
                                    <dd><?= $preentre_request->business_style_text ?></dd>
                                </dl>
                                <dl class="clearfix">
                                    <dt>現在どういったお悩みを持っていますか？</dt>
                                  <?php foreach ($preentre_request->getBusinessProblems() as $key => $problem): ?>
                                    <dd class="<?= $preentre_request->getBusinessProblemClass($key) ?>">
                                      <?= $problem ?>
                                    </dd>
                                  <?php endforeach; ?>
                                    <dd><?= $preentre_request->problem_text ?></dd>
                                </dl>
                                <dl class="clearfix">
                                    <dt>希望するサービス</dt>
                                  <?php foreach ($preentre_request->getWishes() as $key => $wish): ?>
                                    <dd class="">
                                      <?= $wish ?>
                                    </dd>
                                  <?php endforeach; ?>
                                </dl>
                </div><!-- /.section-contents -->
            </div><!-- /.section-inner -->
        </div><!-- /.section-container -->
  </div>
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
				<th><?php echo Form::label('都道府県', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->getPref(); ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('市区郡町村', 'address', array('class'=>'control-label')); ?></th>
				<td><?= $user->city; ?></td>
			</tr>
		</table>
  </div>
</div>
<hr />
<?php if ($preentre_request->status == 1): // 申請中 ?>
  <div class="preentre-approval">
    <?php echo Form::label('プレアントレ承認', 'review', array('class'=>'control-label')); ?>
      <?= Form::open('admin/preentre/requests/review/'. $preentre_request->id); ?>
      <div class="form-inline">
        <label class="radio-inline"><?= Form::radio('approval',11,isset($user)?$user->interest:''); ?> 承認する</label>
        <label class="radio-inline"><?= Form::radio('approval',21,isset($user)?$user->interest:''); ?> 承認しない</label>
      </div>
      <br />
      <?= Form::submit('submit','登録', array('class'=>'btn btn-success')); ?>
    <?= Form::close(); ?>
  </div>
<?php else: ?>
  <div class="preentre-status">
    <dl>
      <dt>ステータス</dt>
      <dd><?php echo $preentre_request->getStatus(); ?></dd>
    </dl>
  </div>
<?php endif; ?>
<hr />
<?php echo Html::anchor('admin/preentre/requests', 'プレアントレ申請一覧', array('class'=>'btn btn-default')); ?>
