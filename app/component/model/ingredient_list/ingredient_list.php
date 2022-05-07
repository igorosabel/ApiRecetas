<?php
use OsumiFramework\OFW\Tools\OTools;

foreach ($values['list'] as $i => $ingredient) {
	echo OTools::getComponent('model/ingredient', [ 'ingredient' => $ingredient ]);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
