<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;

class Ingredient extends OModel {
	function __construct() {
		$model = [
			'id' => [
				'type'    => OModel::PK,
				'comment' => 'Id único de cada ingrediente'
			],
			'id_user' => [
				'type'     => OModel::NUM,
				'nullable' => true,
				'default'  => null,
				'ref'      => 'user.id',
				'comment'  => 'Id del usuario que crea el ingrediente o nulo si es de la aplicación'
			],
			'name' => [
				'type'     => OModel::TEXT,
				'nullable' => false,
				'default'  => null,
				'size'     => 50,
				'comment'  => 'Nombre del ingrediente'
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
