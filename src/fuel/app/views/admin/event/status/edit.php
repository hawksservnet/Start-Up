<h2>Editing Event_status</h2>
<br>

<?php echo render('admin/event/status/_form'); ?>
<p>
	<?php echo Html::anchor('admin/event/status/view/'.$event_status->id, 'View'); ?> |
	<?php echo Html::anchor('admin/event/status', 'Back'); ?></p>
