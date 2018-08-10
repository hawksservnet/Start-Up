<?php echo Form::open(array("class"=>"")); ?>
	<div class="row">
		<div class="col-xs-6">
			<fieldset>
				<div class="form-group">
					<?php echo Form::label('カテゴリ名', 'name', array('class'=>'control-label')); ?>

						<?php echo Form::input('name', Input::post('name', isset($category) ? $category->name : ''), array('class' => 'form-control', 'placeholder'=>'Name')); ?>

				</div>
			</fieldset>
		</div>
	</div>
	<div class="row">
    <div class="col-xs-4"></div>
    <div class="col-xs-4">
      <?php if (empty($category->id)): ?>
    		<div class=""><?php echo Form::submit('submit', '登録・確認する', array('class' => 'btn btn-primary')); ?></div>
      <?php else: ?>
    		<div class=""><?php echo Form::submit('submit', '編集・確認する', array('class' => 'btn btn-primary')); ?></div>
      <?php endif; ?>
    </div>
	</div>
<?php echo Form::close(); ?>
