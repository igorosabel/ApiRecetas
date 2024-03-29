<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;
use OsumiFramework\OFW\DB\OModelGroup;
use OsumiFramework\OFW\DB\OModelField;
use OsumiFramework\App\Model\ShoppingListIngredient;

class ShoppingList extends OModel {
	function __construct() {
		$model = new OModelGroup(
			new OModelField(
				name: 'id',
				type: OMODEL_PK,
				comment: 'Id único de cada lista de la compra'
			),
			new OModelField(
				name: 'id_user',
				type: OMODEL_NUM,
				nullable: true,
				default: null,
				ref: 'user.id',
				comment: 'Id del usuario que crea la lista de la compra'
			),
			new OModelField(
				name: 'name',
				type: OMODEL_TEXT,
				nullable: false,
				default: 'null',
				size: 50,
				comment: 'Nombre de la lista de la compra'
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

	private ?array $ingredients = null;

	/**
	 * Obtiene el listado de ingredientes de una lista de la compra
	 *
	 * @return array Listado de ingredientes
	 */
	public function getIngredients(): array {
		if (is_null($this->ingredients)) {
			$this->loadIngredients();
		}
		return $this->ingredients;
	}

	/**
	 * Guarda la lista de ingredientes
	 *
	 * @param array $i Lista de ingredientes
	 *
	 * @return void
	 */
	public function setIngredients(array $i): void {
		$this->ingredients = $i;
	}

	/**
	 * Carga la lista de ingredientes de una lista de la compra
	 *
	 * @return void
	 */
	public function loadIngredients(): void {
		$db = new ODB();
		$sql = "SELECT * FROM `shopping_list_ingredient` WHERE `id_shopping_list` = ? ORDER BY `order`";
		$db->query($sql, [$this->get('id')]);
		$list = [];

		while ($res=$db->next()) {
			$sli = new ShoppingListIngredient();
			$sli->update($res);
			$sli->loadIngredient();
			array_push($list, $sli);
		}

		$this->setIngredients($list);
	}
}
