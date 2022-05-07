<?php
use OsumiFramework\OFW\Tools\OTools;

foreach ($values['list'] as $i => $meal) {
	echo OTools::getComponent('model/meal', [ 'meal' => $meal ]);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
