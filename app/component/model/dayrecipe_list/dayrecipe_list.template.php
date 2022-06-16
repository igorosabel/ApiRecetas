<?php
use OsumiFramework\App\Component\DayrecipeComponent;

foreach ($values['list'] as $i => $dayrecipe) {
	$day_recipe = new DayrecipeComponent([ 'dayrecipe' => $dayrecipe ]);
	echo strval($day_recipe);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
