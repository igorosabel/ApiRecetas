<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;
use OsumiFramework\OFW\DB\OModelGroup;
use OsumiFramework\OFW\DB\OModelField;

class Meal extends OModel {
	function __construct() {
		$model = new OModelGroup(
			new OModelField(
				name: 'id',
				type: OMODEL_PK,
				comment: 'Id único de cada comida'
			),
			new OModelField(
				name: 'id_user',
				type: OMODEL_NUM,
				nullable: false,
				default: null,
				ref: 'user.id',
				comment: 'Id del usuario que hace la comida'
			),
			new OModelField(
				name: 'name',
				type: OMODEL_TEXT,
				nullable: true,
				default: null,
				size: 50,
				comment: 'Nombre de la comida'
			),
			new OModelField(
				name: 'enabled',
				type: OMODEL_BOOL,
				default: true,
				comment: 'Indica si la comida está activa 1 o no 0'
			),
			new OModelField(
				name: 'start_time',
				type: OMODEL_TEXT,
				nullable: true,
				default: null,
				size: 5,
				comment: 'Hora de inicio de la comida'
			),
			new OModelField(
				name: 'end_time',
				type: OMODEL_TEXT,
				nullable: true,
				default: null,
				size: 5,
				comment: 'Fecha de fin de la comida'
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
