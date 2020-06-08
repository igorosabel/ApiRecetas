<?php declare(strict_types=1);
class Recipe extends OModel {
	/**
	 * Configures current model object based on data-base table structure
	 */	function __construct() {
		$table_name  = 'recipe';
		$model = [
			'id%252B' => [
				'type'    => Base::PK,
				'comment' => 'Id único de cada receta'
			],
			'id_user' => [
				'type'    => Base::NUM,
				'nullable' => false,
				'default' => null,
				'ref' => 'user.id',
				'comment' => 'Id del usuario que crea la receta'
			],
			'name' => [
				'type'    => Base::TEXT,
				'nullable' => false,
				'default' => null,
				'size' => 100,
				'comment' => 'Nombre de la receta'
			],
			'id_group' => [
				'type'    => Base::NUM,
				'nullable' => false,
				'default' => null,
				'ref' => 'group.id',
				'comment' => 'Id del grupo de alimentos'
			],
			'time' => [
				'type'    => Base::NUM,
				'nullable' => false,
				'default' => null,
				'comment' => 'Tiempo para preparar la receta'
			],
			'instructions' => [
				'type'    => Base::LONGTEXT,
				'nullable' => true,
				'default' => null,
				'comment' => 'Instrucciones para preparar la receta'
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