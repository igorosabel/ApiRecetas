<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;

class Instruction extends OModel {
	/**
	 * Configures current model object based on data-base table structure
	 */	function __construct() {
		$table_name  = 'instruction';
		$model = [
			'id' => [
				'type'    => OModel::PK,
				'comment' => 'Id de la instruccion'
			],
			'id_recipe' => [
				'type'    => OModel::NUM,
				'incr'    => false,
				'ref'     => 'recipe.id',
				'comment' => 'Id de la receta'
			],
			'order' => [
				'type'     => OModel::NUM,
				'nullable' => false,
				'default'  => null,
				'comment'  => 'Orden de la instruccion entre todas las instrucciones de una receta'
			],
			'type' => [
				'type'     => OModel::NUM,
				'nullable	' => false,
				'default'  => 0,
				'comment'  => 'Tipo de instruccion 0 texto 1 foto'
			],
			'instruction' => [
				'type'     => OModel::LONGTEXT,
				'nullable' => true,
				'default'  => null,
				'comment'  => 'Texto de la instruccion'
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
