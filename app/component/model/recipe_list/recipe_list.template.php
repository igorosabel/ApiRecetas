<?php
use OsumiFramework\App\Component\Model\RecipeComponent;

foreach ($values['list'] as $i => $recipe) {
	$recipe_component = new RecipeComponent([ 'recipe' => $recipe ]);
	echo strval($recipe_component);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
