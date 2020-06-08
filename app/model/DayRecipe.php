<?php declare(strict_types=1);
class DayRecipe extends OModel {
	/**
	 * Configures current model object based on data-base table structure
	 */	function __construct() {
		$table_name  = 'day_recipe';
		$model = [
			'week_day' => [
				'type'    => Base::PK,
				'incr' => false,
				'comment' => 'Dia de la semana (1-7)'
			],
			'id_meal' => [
				'type'    => Base::PK,
				'incr' => false,
				'ref' => 'meal.id',
				'comment' => 'Id de la comida'
			],
			'id_recipe' => [
				'type'    => Base::PK,
				'incr' => false,
				'ref' => 'recipe.id',
				'comment' => 'Id de la receta'
			],
			'created_at' => [
				'type'    => Base::CREATED,
				'comment' => 'Fecha de creación del registro'
			],
			'updated_at' => [
				'type'    => Base::UPDATED,
				'nullable' => true,
				'default' => null,
				'comment' => 'Fecha de última modificación del registro'
			]
		];

		parent::load($table_name, $model);
	}
}