<?php
use OsumiFramework\App\Component\Model\IngredientComponent;

foreach ($values['list'] as $i => $ingredient) {
	$ingredient_component = new IngredientComponent([ 'ingredient' => $ingredient ]);
	echo strval($ingredient_component);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
