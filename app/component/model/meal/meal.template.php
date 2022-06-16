<?php if (is_null($values['meal'])): ?>
null
<?php else: ?>
{
	"id": <?php echo $values['meal']->get('id') ?>,
	"name": "<?php echo is_null($values['meal']->get('name')) ? 'null' : urlencode($values['meal']->get('name')) ?>",
	"enabled": <?php echo $values['meal']->get('enabled') ? 'true' : 'false' ?>,
	"startTime": "<?php echo is_null($values['meal']->get('start_time')) ? 'null' : urlencode($values['meal']->get('start_time')) ?>",
	"endTime": "<?php echo is_null($values['meal']->get('end_time')) ? 'null' : urlencode($values['meal']->get('end_time')) ?>"
}
<?php endif ?>
