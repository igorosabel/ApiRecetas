<?php
use OsumiFramework\OFW\Tools\OTools;

foreach ($values['list'] as $i => $recipe) {
	echo OTools::getComponent('model/recipe', [ 'recipe' => $recipe ]);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
