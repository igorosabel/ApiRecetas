<?php declare(strict_types=1);

namespace OsumiFramework\App\Service;

use OsumiFramework\OFW\Core\OService;
use OsumiFramework\App\Model\User;
use OsumiFramework\App\Model\Meal;
use OsumiFramework\App\Model\DayRecipe;

class mealsService extends OService {
	/**
	 * Load service tools
	 */
	function __construct() {
		$this->loadService();
	}

	/**
	 * Función para crear la lista de comidas a un usuario nuevo que se acaba de registrar
	 *
	 * @param User $u Usuario que se acaba de registrar
	 *
	 * @return void
	 */
	public function createMealsForUser(User $u): void {
		$list = [
			['name' => 'Desayuno', 'start_time' => '08:00', 'end_time' => '09:00'],
			['name' => 'Comida',   'start_time' => '14:00', 'end_time' => '15:00'],
			['name' => 'Cena',     'start_time' => '22:00', 'end_time' => '23:00']
		];

		for ($i=1; $i<=7; $i++) {
			foreach ($list as $item) {
				$meal = new Meal();
				$meal->set('id_user',    $u->get('id'));
				$meal->set('name',       $item['name']);
				$meal->set('enabled',    true);
				$meal->set('start_time', $item['start_time']);
				$meal->set('end_time',   $item['end_time']);
				$meal->save();

				$day_recipe = new DayRecipe();
				$day_recipe->set('week_day', $i);
				$day_recipe->set('id_meal', $meal->get('id'));
				$day_recipe->set('id_recipe', null);
				$day_recipe->set('id_user', $u->get('id'));
				$day_recipe->save();
			}
		}
	}
}