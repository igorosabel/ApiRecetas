<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;
use OsumiFramework\OFW\DB\OModelGroup;
use OsumiFramework\OFW\DB\OModelField;

class Ingredient extends OModel {
	function __construct() {
		$model = new OModelGroup(
			new OModelField(
				name: 'id',
				type: OMODEL_PK,
				comment: 'Id único de cada ingrediente'
			),
			new OModelField(
				name: 'id_user',
				type: OMODEL_NUM,
				nullable: true,
				default: null,
				ref: 'user.id',
				comment: 'Id del usuario que crea el ingrediente o nulo si es de la aplicación'
			),
			new OModelField(
				name: 'name',
				type: OMODEL_TEXT,
				nullable: false,
				default: null,
				size: 50,
				comment: 'Nombre del ingrediente'
			),
			new OModelField(
				name: 'created_at',
				type: OMODEL_CREATED,
				comment: 'Fecha de creación del registro'
			),
			new OModelField(
				name: 'updated_at',
				type: OMODEL_UPDATED,
				nullable: true,
				default: null,
				comment: 'Fecha de última modificación del registro'
			)
		);

		parent::load($model);
	}
}
