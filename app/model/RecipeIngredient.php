<?php declare(strict_types=1);
class RecipeIngredient extends OModel {
	/**
	 * Configures current model object based on data-base table structure
	 */	function __construct() {
		$table_name  = 'recipe_ingredient';
		$model = [
			'id_recipe' => [
				'type'    => OCore::PK,
				'incr'    => false,
				'ref'     => 'recipe.id',
				'comment' => 'Id de la receta'
			],
			'id_ingredient' => [
				'type'    => OCore::PK,
				'incr'    => false,
				'ref'     => 'ingredient.id',
				'comment' => 'Id del ingrediente'
			],
			'order' => [
				'type'     => OCore::NUM,
				'nullable' => false,
				'default'  => null,
				'comment'  => ''
			],
			'created_at' => [
				'type'    => OCore::CREATED,
				'comment' => 'Fecha de creación del registro'
			],
			'updated_at' => [
				'type'     => OCore::UPDATED,
				'nullable' => true,
				'default'  => null,
				'comment'  => 'Fecha de modificación del registro'
			]
		];

		parent::load($table_name, $model);
	}
}