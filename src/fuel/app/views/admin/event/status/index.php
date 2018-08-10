<h2>Listing Event_statuses</h2>
<br>
<?php if ($event_statuses): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($event_statuses as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td>
				<?php echo Html::anchor('admin/event/status/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/event/status/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/event/status/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Event_statuses.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/event/status/create', 'Add new Event status', array('class' => 'btn btn-success')); ?>

</p>
