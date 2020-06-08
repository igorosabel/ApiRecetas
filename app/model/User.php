<?php declare(strict_types=1);
class User extends OModel {
	/**
	 * Configures current model object based on data-base table structure
	 */	function __construct() {
		$table_name  = 'user';
		$model = [
			'id' => [
				'type'    => Base::PK,
				'comment' => 'Id único de cada usuario'
			],
			'email' => [
				'type'    => Base::TEXT,
				'nullable' => false,
				'default' => null,
				'size' => 100,
				'comment' => 'Email del usuario'
			],
			'pass' => [
				'type'    => Base::TEXT,
				'nullable' => false,
				'default' => null,
				'size' => 100,
				'comment' => 'Contraseña cifrada del usuario'
			],
			'name' => [
				'type'    => Base::TEXT,
				'nullable' => false,
				'default' => null,
				'size' => 50,
				'comment' => 'Nombre del usuario'
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