<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;

class RecipeIngredient extends OModel {
	/**
	 * Configures current model object based on data-base table structure
	 */	function __construct() {
		$table_name  = 'recipe_ingredient';
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
				'comment'  => ''
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

		parent::load($table_name, $model);
	}
}