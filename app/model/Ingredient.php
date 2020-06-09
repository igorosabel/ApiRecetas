<?php declare(strict_types=1);
class Ingredient extends OModel {
	/**
	 * Configures current model object based on data-base table structure
	 */	function __construct() {
		$table_name  = 'ingredient';
		$model = [
			'id' => [
				'type'    => OCore::PK,
				'comment' => 'Id único de cada ingrediente'
			],
			'id_user' => [
				'type'     => OCore::NUM,
				'nullable' => true,
				'default'  => null,
				'ref'      => 'user.id',
				'comment'  => 'Id del usuario que crea el ingrediente o nulo si es de la aplicación'
			],
			'amount' => [
				'type'     => OCore::NUM,
				'nullable' => false,
				'default'  => null,
				'comment'  => 'Cantidad del ingrediente'
			],
			'id_unit' => [
				'type'     => OCore::NUM,
				'nullable' => false,
				'default'  => null,
				'ref'      => 'unit.id',
				'comment'  => 'Id de la unidad de medida'
			],
			'name' => [
				'type'     => OCore::TEXT,
				'nullable' => false,
				'default'  => null,
				'size'     => 50,
				'comment'  => 'Nombre del ingrediente'
			],
			'id_group' => [
				'type'     => OCore::NUM,
				'nullable' => true,
				'default'  => null,
				'ref'      => 'group.id',
				'comment'  => 'Id del grupo de alimentos'
			],
			'created_at' => [
				'type'    => OCore::CREATED,
				'comment' => 'Fecha de creación del registro'
			],
			'updated_at' => [
				'type'     => OCore::UPDATED,
				'nullable' => true,
				'default'  => null,
				'comment'  => 'Fecha de última modificación del registro'
			]
		];

		parent::load($table_name, $model);
	}
}