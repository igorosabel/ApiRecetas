<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;
use OsumiFramework\App\Model\Meal;
use OsumiFramework\App\Model\Recipe;

class DayRecipe extends OModel {
	/**
	 * Configures current model object based on data-base table structure
	 */	function __construct() {
		$table_name  = 'day_recipe';
		$model = [
			'id' => [
				'type'    => OModel::PK,
				'comment' => 'Id único de cada comida'
			],
			'week_day' => [
				'type'    => OModel::NUM,
				'nullable' => false,
				'comment' => 'Dia de la semana (1-7)'
			],
			'id_meal' => [
				'type'    => OModel::NUM,
				'ref'     => 'meal.id',
				'comment' => 'Id de la comida'
			],
			'id_recipe' => [
				'type'    => OModel::NUM,
				'nullable' => true,
				'default' => null,
				'comment' => 'Id de la receta'
			],
			'id_user' => [
				'type'    => OModel::NUM,
				'ref'     => 'user.id',
				'comment' => 'Id del usuario'
			],
			'created_at' => [
				'type'    => OModel::CREATED,
				'comment' => 'Fecha de creación del registro'
			],
			'updated_at' => [
				'type'     => OModel::UPDATED,
				'nullable' => true,
				'default'  => null,
				'comment'  => 'Fecha de última modificación del registro'
			]
		];

		parent::load($table_name, $model);
	}

	private ?Meal $meal = null;

	/**
	 * Obtiene la comida
	 *
	 * @return Meal Comida
	 */
	public function getMeal(): Meal {
		if (is_null($this->meal)) {
			$this->loadMeal();
		}
		return $this->meal;
	}

	/**
	 * Guarda la comida
	 *
	 * @param Meal $m Comida
	 *
	 * @return void
	 */
	public function setMeal(Meal $m): void {
		$this->meal = $m;
	}

	/**
	 * Carga la comida
	 *
	 * @return void
	 */
	public function loadMeal(): void {
		$m = new Meal();
		$m->find(['id' => $this->get('id_meal')]);
		$this->setMeal($m);
	}

	private ?Recipe $recipe = null;

	/**
	 * Obtiene la receta
	 *
	 * @return Recipe Receta
	 */
	public function getRecipe(): ?Recipe {
		if (is_null($this->recipe) && !is_null($this->get('id_recipe'))) {
			$this->loadRecipe();
		}
		return $this->recipe;
	}

	/**
	 * Guarda la receta
	 *
	 * @param Recipe $r Receta
	 *
	 * @return void
	 */
	public function setRecipe(Recipe $r): void {
		$this->recipe = $r;
	}

	/**
	 * Carga la receta
	 *
	 * @return void
	 */
	public function loadRecipe(): void {
		$r = new Recipe();
		$r->find(['id' => $this->get('id_recipe')]);
		$this->setRecipe($r);
	}
}
