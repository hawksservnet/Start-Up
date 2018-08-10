<h2>Viewing #<?php echo $tag->id; ?></h2>

<p>
	<strong>Name:</strong>
	<?php echo $tag->name; ?></p>

<?php echo Html::anchor('admin/tag/edit/'.$tag->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/tag', 'Back'); ?>