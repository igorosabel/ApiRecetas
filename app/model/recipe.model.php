<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;
use OsumiFramework\App\Model\RecipeIngredient;
use OsumiFramework\App\Model\Instruction;

class Recipe extends OModel {
	function __construct() {
		$model = [
			'id' => [
				'type'    => OModel::PK,
				'comment' => 'Id único de cada receta'
			],
			'id_user' => [
				'type'    => OModel::NUM,
				'nullable' => false,
				'default'  => null,
				'ref'      => 'user.id',
				'comment'  => 'Id del usuario que crea la receta'
			],
			'name' => [
				'type'     => OModel::TEXT,
				'nullable' => false,
				'default'  => null,
				'size'     => 100,
				'comment'  => 'Nombre de la receta'
			],
			'time' => [
				'type'     => OModel::NUM,
				'nullable' => false,
				'default'  => null,
				'comment'  => 'Tiempo para preparar la receta'
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

	private ?array $ingredients = null;

	/**
	 * Obtiene el listado de ingredientes de una receta
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
	 * Carga la lista de ingredientes de una receta
	 *
	 * @return void
	 */
	public function loadIngredients(): void {
		$db = new ODB();
		$sql = "SELECT * FROM `recipe_ingredient` WHERE `id_recipe` = ? ORDER BY `order`";
		$db->query($sql, [$this->get('id')]);
		$list = [];

		while ($res=$db->next()) {
			$ri = new RecipeIngredient();
			$ri->update($res);
			$ri->loadIngredient();
			array_push($list, $ri);
		}

		$this->setIngredients($list);
	}

	private ?array $instructions = null;

	/**
	 * Obtiene el listado de instrucciones de una receta
	 *
	 * @return array Listado de instrucciones
	 */
	public function getInstructions(): array {
		if (is_null($this->instructions)) {
			$this->loadInstructions();
		}
		return $this->instructions;
	}

	/**
	 * Guarda la lista de instrucciones
	 *
	 * @param array $i Lista de instrucciones
	 *
	 * @return void
	 */
	public function setInstructions(array $i): void {
		$this->instructions = $i;
	}

	/**
	 * Carga la lista de instrucciones de una receta
	 *
	 * @return void
	 */
	public function loadInstructions(): void {
		$db = new ODB();
		$sql = "SELECT * FROM `instruction` WHERE `id_recipe` = ? ORDER BY `order`";
		$db->query($sql, [$this->get('id')]);
		$list = [];

		while ($res=$db->next()) {
			$i = new Instruction();
			$i->update($res);
			array_push($list, $i);
		}

		$this->setInstructions($list);
	}
}
