<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;

class DayRecipe extends OModel {
	/**
	 * Configures current model object based on data-base table structure
	 */	function __construct() {
		$table_name  = 'day_recipe';
		$model = [
			'week_day' => [
				'type'    => OModel::PK,
				'incr'    => false,
				'comment' => 'Dia de la semana (1-7)'
			],
			'id_meal' => [
				'type'    => OModel::PK,
				'incr'    => false,
				'ref'     => 'meal.id',
				'comment' => 'Id de la comida'
			],
			'id_recipe' => [
				'type'    => OModel::PK,
				'incr'    => false,
				'ref'     => 'recipe.id',
				'comment' => 'Id de la receta'
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
}