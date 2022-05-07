<?php
use OsumiFramework\OFW\Tools\OTools;
if (is_null($values['shoppinglist'])) {
?>
null
<?php
}
else {
?>
{
	"id": <?php echo $values['shoppinglist']->get('id') ?>,
	"name": "<?php echo urlencode($values['shoppinglist']->get('name')) ?>",
	"list": [
<?php foreach ($values['shoppinglist']->getIngredients() as $sli): ?>
		{
			"order": <?php echo $sli->get('order') ?>,
			"amount": <?php echo $sli->get('amount') ?>,
			"ingredient": <?php echo OTools::getComponent('model/ingredient', [ 'ingredient' => $sli->getIngredient() ]) ?>
		}<?php if ($i<count($values['shoppinglist'])-1): ?>,<?php endif ?>
<?php endforeach ?>
	]
}
<?php
}
?>