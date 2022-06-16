<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;
use OsumiFramework\App\Model\Ingredient;

class RecipeIngredient extends OModel {
	function __construct() {
		$model = [
			'id_recipe' => [
				'type'    => OModel::PK,
				'incr'    => false,
				'ref'     => 'recipe.id',
				'comment' => 'Id de la receta'
			],
			'id_ingredient' => [
				'type'    => OModel::PK,
				'incr'    => false,
				'ref'     => 'ingredient.id',
				'comment' => 'Id del ingrediente'
			],
			'order' => [
				'type'     => OModel::NUM,
				'nullable' => false,
				'default'  => null,
				'comment'  => 'Orden del ingrediente entre todos los ingredientes de una receta'
			],
			'amount' => [
				'type'     => OModel::TEXT,
				'nullable' => true,
				'default'  => null,
				'comment'  => 'Cantidad del ingrediente a usar en la receta'
			],
			'created_at' => [
				'type'    => OModel::CREATED,
				'comment' => 'Fecha de creación del registro'
			],
			'updated_at' => [
				'type'     => OModel::UPDATED,
				'nullable' => true,
				'default'  => null,
				'comment'  => 'Fecha de modificación del registro'
			]
		];

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
