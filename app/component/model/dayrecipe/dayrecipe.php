<?php
use OsumiFramework\OFW\Tools\OTools;

if (is_null($values['dayrecipe'])) {
?>
null
<?php
}
else {
?>
{
	"weekDay": <?php echo $values['dayrecipe']->get('week_day') ?>,
	"meal": <?php echo OTools::getComponent('model/meal', [ 'meal' => $values['dayrecipe']->getMeal() ]) ?>,
	"recipe": <?php echo OTools::getComponent('model/recipe', [ 'recipe' => $values['dayrecipe']->getRecipe() ]) ?>
}
<?php
}
?>
