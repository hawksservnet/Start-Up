<h2>Viewing #<?php echo $event_status->id; ?></h2>

<p>
	<strong>Name:</strong>
	<?php echo $event_status->name; ?></p>

<?php echo Html::anchor('admin/event/status/edit/'.$event_status->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/event/status', 'Back'); ?>