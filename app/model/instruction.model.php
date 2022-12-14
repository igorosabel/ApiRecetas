<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;
use OsumiFramework\OFW\DB\OModelGroup;
use OsumiFramework\OFW\DB\OModelField;

class Instruction extends OModel {
	function __construct() {
		$model = new OModelGroup(
			new OModelField(
				name: 'id',
				type: OMODEL_PK,
				comment: 'Id de la instruccion'
			),
			new OModelField(
				name: 'id_recipe',
				type: OMODEL_NUM,
				incr: false,
				ref: 'recipe.id',
				comment: 'Id de la receta'
			),
			new OModelField(
				name: 'order',
				type: OMODEL_NUM,
				nullable: false,
				default: null,
				comment: 'Orden de la instruccion entre todas las instrucciones de una receta'
			),
			new OModelField(
				name: 'type',
				type: OMODEL_NUM,
				nullable: false,
				default: 0,
				comment: 'Tipo de instruccion 0 texto 1 foto'
			),
			new OModelField(
				name: 'instruction',
				type: OMODEL_LONGTEXT,
				nullable: true,
				default: null,
				comment: 'Texto de la instruccion'
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
