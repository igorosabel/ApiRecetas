<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;
use OsumiFramework\OFW\DB\OModelGroup;
use OsumiFramework\OFW\DB\OModelField;
use OsumiFramework\App\Model\Ingredient;

class RecipeIngredient extends OModel {
	function __construct() {
		$model = new OModelGroup(
			new OModelField(
				name: 'id_recipe',
				type: OMODEL_PK,
				incr: false,
				ref: 'recipe.id',
				comment: 'Id de la receta'
			),
			new OModelField(
				name: 'id_ingredient',
				type: OMODEL_PK,
				incr: false,
				ref: 'ingredient.id',
				comment: 'Id del ingrediente'
			),
			new OModelField(
				name: 'order',
				type: OMODEL_NUM,
				nullable: false,
				default: null,
				comment: 'Orden del ingrediente entre todos los ingredientes de una receta'
			),
			new OModelField(
				name: 'amount',
				type: OMODEL_TEXT,
				nullable: true,
				default: null,
				comment: 'Cantidad del ingrediente a usar en la receta'
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

	private ?Ingredient $ingredient = null;

	/**
	 * Obtiene el ingrediente
	 *
	 * @return Ingredient Ingrediente
	 */
	public function getIngredient(): Ingredient {
		if (is_null($this->ingredient)) {
			$this->loadIngredient();
		}
		return $this->ingredient;
	}

	/**
	 * Guarda el ingrediente
	 *
	 * @param Ingredient $i Ingrediente
	 *
	 * @return void
	 */
	public function setIngredient(Ingredient $i): void {
		$this->ingredient = $i;
	}

	/**
	 * Carga el ingrediente
	 *
	 * @return void
	 */
	public function loadIngredient(): void {
		$i = new Ingredient();
		$i->find(['id' => $this->get('id_ingredient')]);
		$this->setIngredient($i);
	}
}
