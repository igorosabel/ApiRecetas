<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;
use OsumiFramework\OFW\DB\OModelGroup;
use OsumiFramework\OFW\DB\OModelField;
use OsumiFramework\OFW\DB\ODB;
use OsumiFramework\App\Model\Recipe;
use OsumiFramework\App\Model\DayRecipe;
use OsumiFramework\App\Model\ShoppingList;

class User extends OModel {
	function __construct() {
		$model = new OModelGroup(
			new OModelField(
				name: 'id',
				type: OMODEL_PK,
				comment: 'Id único de cada usuario'
			),
			new OModelField(
				name: 'email',
				type: OMODEL_TEXT,
				nullable: false,
				default: null,
				size: 100,
				comment: 'Email del usuario'
			),
			new OModelField(
				name: 'pass',
				type: OMODEL_TEXT,
				nullable: false,
				default: null,
				size: 100,
				comment: 'Contraseña cifrada del usuario'
			),
			new OModelField(
				name: 'name',
				type: OMODEL_TEXT,
				nullable: false,
				default: null,
				size: 50,
				comment: 'Nombre del usuario'
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

	private ?array $day_recipes = null;

	/**
	 * Obtiene el listado de comidas de un usuario
	 *
	 * @return array Listado de comidas
	 */
	public function getDayRecipes(): array {
		if (is_null($this->day_recipes)) {
			$this->loadDayRecipes();
		}
		return $this->day_recipes;
	}

	/**
	 * Guarda la lista de comidas
	 *
	 * @param array $dr Lista de comidas
	 *
	 * @return void
	 */
	public function setDayRecipes(array $dr): void {
		$this->day_recipes = $dr;
	}

	/**
	 * Carga la lista de comidas de un usuario
	 *
	 * @return void
	 */
	public function loadDayRecipes(): void {
		$db = new ODB();
		$sql = "SELECT dr.* FROM `day_recipe` dr, `meal` m WHERE dr.`id_meal` = m.`id` AND dr.`id_user` = ? ORDER BY dr.`week_day` ASC, m.`start_time` ASC";
		$db->query($sql, [$this->get('id')]);
		$list = [];

		while ($res=$db->next()) {
			$dr = new DayRecipe();
			$dr->update($res);
			array_push($list, $dr);
		}

		$this->setDayRecipes($list);
	}

	private ?array $recipes = null;

	/**
	 * Obtiene el listado de recetas de un usuario
	 *
	 * @return array Listado de recetas
	 */
	public function getRecipes(): array {
		if (is_null($this->recipes)) {
			$this->loadRecipes();
		}
		return $this->recipes;
	}

	/**
	 * Guarda la lista de recetas
	 *
	 * @param array $r Lista de recetas
	 *
	 * @return void
	 */
	public function setRecipes(array $r): void {
		$this->recipes = $r;
	}

	/**
	 * Carga la lista de recetas de un usuario
	 *
	 * @return void
	 */
	public function loadRecipes(): void {
		$db = new ODB();
		$sql = "SELECT * FROM `recipe` WHERE `id_user` = ? ORDER BY `updated_at` DESC";
		$db->query($sql, [$this->get('id')]);
		$list = [];

		while ($res=$db->next()) {
			$r = new Recipe();
			$r->update($res);
			array_push($list, $r);
		}

		$this->setRecipes($list);
	}

	private ?array $shopping_lists = null;

	/**
	 * Obtiene el listado de listas de compras de un usuario
	 *
	 * @return array Listado de listas de compras
	 */
	public function getShoppingLists(): array {
		if (is_null($this->shopping_lists)) {
			$this->loadShoppingLists();
		}
		return $this->shopping_lists;
	}

	/**
	 * Guarda la lista de listas de comprass
	 *
	 * @param array $sl Lista de listas de compras
	 *
	 * @return void
	 */
	public function setShoppingLists(array $sl): void {
		$this->shopping_lists = $sl;
	}

	/**
	 * Carga la lista de listas de compras de un usuario
	 *
	 * @return void
	 */
	public function loadShoppingLists(): void {
		$db = new ODB();
		$sql = "SELECT * FROM `shopping_list` WHERE `id_user` = ? ORDER BY `updated_at` DESC";
		$db->query($sql, [$this->get('id')]);
		$list = [];

		while ($res=$db->next()) {
			$sl = new ShoppingList();
			$sl->update($res);
			array_push($list, $sl);
		}

		$this->setShoppingLists($list);
	}
}
