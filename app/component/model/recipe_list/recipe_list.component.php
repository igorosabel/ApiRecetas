<?php declare(strict_types=1);

namespace OsumiFramework\App\Component;

use OsumiFramework\OFW\Core\OComponent;

class RecipeListComponent extends OComponent {
	public array $depends = ['model/recipe'];
}
