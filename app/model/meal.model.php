<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;

class Meal extends OModel {
	function __construct() {
		$model = [
			'id' => [
				'type'    => OModel::PK,
				'comment' => 'Id único de cada  comida'
			],
			'id_user' => [
				'type'     => OModel::NUM,
				'nullable' => false,
				'default'  => null,
				'ref'      => 'user.id',
				'comment'  => 'Id del usuario que hace la comida'
			],
			'name' => [
				'type'     => OModel::TEXT,
				'nullable' => true,
				'default'  => null,
				'size'     => 50,
				'comment'  => 'Nombre de la comida'
			],
			'enabled' => [
				'type'    => OModel::BOOL,
				'default' => true,
				'comment' => 'Indica si la comida está activa 1 o no 0'
			],
			'start_time' => [
				'type'     => OModel::TEXT,
				'nullable' => true,
				'default'  => null,
				'size'     => 5,
				'comment'  => 'Hora de inicio de la comida'
			],
			'end_time' => [
				'type'     => OModel::TEXT,
				'nullable' => true,
				'default'  => null,
				'size'     => 5,
				'comment'  => 'Fecha de fin de la comida'
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

		parent::load($model);
	}
}
