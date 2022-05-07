<?php
use OsumiFramework\OFW\Tools\OTools;

foreach ($values['list'] as $i => $dayrecipe) {
	echo OTools::getComponent('model/dayrecipe', [ 'dayrecipe' => $dayrecipe ]);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
