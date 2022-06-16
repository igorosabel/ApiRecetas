<?php if (is_null($values['recipe'])): ?>
null
<?php else: ?>
{
	"id": <?php echo $values['recipe']->get('id') ?>,
	"name": "<?php echo urlencode($values['recipe']->get('name')) ?>",
	"time": <?php echo $values['recipe']->get('time') ?>
}
<?php endif ?>
