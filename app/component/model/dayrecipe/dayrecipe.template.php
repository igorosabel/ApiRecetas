<?php
use OsumiFramework\App\Component\Model\MealComponent;
use OsumiFramework\App\Component\Model\RecipeComponent;

if (is_null($values['dayrecipe'])) {
?>
null
<?php
}
else {
?>
{
	"weekDay": <?php echo $values['dayrecipe']->get('week_day') ?>,
	"meal": <?php echo strval(new MealComponent([ 'meal' => $values['dayrecipe']->getMeal() ])); ?>,
	"recipe": <?php echo strval(new RecipeComponent([ 'recipe' => $values['dayrecipe']->getRecipe() ])); ?>
}
<?php
}
?>
