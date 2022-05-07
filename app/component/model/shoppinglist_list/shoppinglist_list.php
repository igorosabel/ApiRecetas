<?php
use OsumiFramework\OFW\Tools\OTools;

foreach ($values['list'] as $i => $shoppinglist) {
	echo OTools::getComponent('model/shoppinglist', [ 'shoppinglist' => $shoppinglist ]);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
