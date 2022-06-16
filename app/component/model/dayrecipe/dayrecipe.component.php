<?php declare(strict_types=1);

namespace OsumiFramework\App\Component;

use OsumiFramework\OFW\Core\OComponent;

class DayrecipeComponent extends OComponent {
  private string $depends = 'model/meal, model/recipe';
}
