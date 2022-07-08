<?php
use OsumiFramework\App\Component\Model\ShoppinglistComponent;

foreach ($values['list'] as $i => $shoppinglist) {
	$shoppinglist_component = new ShoppinglistComponent([ 'shoppinglist' => $shoppinglist ]);
	echo strval($shoppinglist_component);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
