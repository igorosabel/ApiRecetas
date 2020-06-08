<?php declare(strict_types=1);
class RecipeIngredient extends OModel {
	/**
	 * Configures current model object based on data-base table structure
	 */	function __construct() {
		$table_name  = 'recipe_ingredient';
		$model = [
			'id_recipe' => [
				'type'    => Base::PK,
				'incr' => false,
				'ref' => 'recipe.id',
				'comment' => 'Id de la receta'
			],
			'id_ingredient' => [
				'type'    => Base::PK,
				'incr' => false,
				'ref' => 'ingredient.id',
				'comment' => 'Id del ingrediente'
			],
			'order' => [
				'type'    => Base::NUM,
				'nullable' => false,
				'default' => null,
				'comment' => ''
			],
			'created_at' => [
				'type'    => Base::CREATED,
				'comment' => 'Fecha de creación del registro'
			],
			'updated_at' => [
				'type'    => Base::UPDATED,
				'nullable' => true,
				'default' => null,
				'comment' => 'Fecha de modificación del registro'
			]
		];

		parent::load($table_name, $model);
	}
}