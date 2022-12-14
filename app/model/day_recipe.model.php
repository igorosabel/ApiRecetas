<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;
use OsumiFramework\OFW\DB\OModelGroup;
use OsumiFramework\OFW\DB\OModelField;
use OsumiFramework\App\Model\Meal;
use OsumiFramework\App\Model\Recipe;

class DayRecipe extends OModel {
  function __construct() {
		$model = new OModelGroup(
			new OModelField(
				name: 'id',
        type: OMODEL_PK,
        comment: 'Id único de cada comida'
			),
			new OModelField(
				name: 'week_day',
        type: OMODEL_NUM,
        nullable: false,
				comment: 'Dia de la semana (1-7)'
			),
			new OModelField(
				name: 'id_meal',
        type: OMODEL_NUM,
        ref: 'meal.id',
				comment: 'Id de la comida'
			),
			new OModelField(
				name: 'id_recipe',
        type: OMODEL_NUM,
        nullable: true,
				default: null,
				comment: 'Id de la receta'
			),
			new OModelField(
				name: 'id_user',
        type: OMODEL_NUM,
        ref: 'user.id',
				comment: 'Id del usuario'
			),
      new OModelField(
				name: 'created_at',
				type: OMODEL_CREATED,
				comment: 'Fecha de creación del registro'
			),
			new OModelField(
				name: 'updated_at',
				type: OMODEL_UPDATED,
				nullable: true,
				default: null,
				comment: 'Fecha de última modificación del registro'
			)
		);

		parent::load($model);
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
