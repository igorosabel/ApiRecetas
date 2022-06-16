<?php if (is_null($values['ingredient'])): ?>
null
<?php else: ?>
{
	"id": <?php echo $values['ingredient']->get('id') ?>,
	"name": "<?php echo urlencode($values['ingredient']->get('name')) ?>"
}
<?php endif ?>