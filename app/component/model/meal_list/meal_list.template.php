<?php
use OsumiFramework\App\Component\MealComponent;

foreach ($values['list'] as $i => $meal) {
	$meal_component = new MealComponent([ 'meal' => $meal ]);
	echo strval($meal_component);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
