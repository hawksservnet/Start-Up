<h2>カテゴリマスタ管理</h2>
<?php if ($categories): ?>
<div class="table-responsive">
<table class="table">
	<thead>
		<tr>
			<th width="70%">カテゴリ名</th>
			<th>登録日</th>
			<th>編集日</th>
			<th>イベント数</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($categories as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->created_at?date('Y/m/d', $item->created_at):null; ?></td>
			<td><?php echo $item->updated_at?date('Y/m/d', $item->updated_at):null; ?></td>
			<td><?php echo $item->getEventNum(); ?></td>
			<td>
				<?php echo Html::anchor('admin/category/edit/'.$item->id, '編集', array('class' => 'btn btn-primary btn-xs')); ?>
				<?php echo Html::anchor('admin/category/delete/'.$item->id, '削除', array('class' => 'btn btn-danger btn-xs','onclick' => "return confirm('本当に削除しますか？')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>
</div>

<?php else: ?>
<p>No Categories.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/category/create', '新規追加', array('class' => 'btn btn-success')); ?>

</p>
