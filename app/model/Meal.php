<?php declare(strict_types=1);
class Meal extends OModel {
	/**
	 * Configures current model object based on data-base table structure
	 */	function __construct() {
		$table_name  = 'meal';
		$model = [
			'id' => [
				'type'    => OCore::PK,
				'comment' => 'Id único de cada  comida'
			],
			'id_user' => [
				'type'     => OCore::NUM,
				'nullable' => false,
				'default'  => null,
				'ref'      => 'user.id',
				'comment'  => 'Id del usuario que hace la comida'
			],
			'name' => [
				'type'     => OCore::TEXT,
				'nullable' => true,
				'default'  => null,
				'size'     => 50,
				'comment'  => 'Nombre de la comida'
			],
			'enabled' => [
				'type'    => OCore::BOOL,
				'comment' => 'Indica si la comida está activa 1 o no 0'
			],
			'start_time' => [
				'type'     => OCore::TEXT,
				'nullable' => true,
				'default'  => null,
				'size'     => 5,
				'comment'  => 'Hora de inicio de la comida'
			],
			'end_time' => [
				'type'     => OCore::TEXT,
				'nullable' => true,
				'default'  => null,
				'size'     => 5,
				'comment'  => 'Fecha de fin de la comida'
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