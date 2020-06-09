<?php declare(strict_types=1);
class Unit extends OModel {
	/**
	 * Configures current model object based on data-base table structure
	 */	function __construct() {
		$table_name  = 'unit';
		$model = [
			'id' => [
				'type'    => OCore::PK,
				'comment' => 'Id único de cada unidad'
			],
			'name' => [
				'type'     => OCore::TEXT,
				'nullable' => true,
				'default'  => null,
				'size'     => 50,
				'comment'  => 'Nombre de la unidad (gr, ml)'
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