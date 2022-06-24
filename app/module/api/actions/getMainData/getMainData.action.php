<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\OFW\Web\ORequest;
use OsumiFramework\App\model\User;
use OsumiFramework\App\Component\DayrecipeListComponent;
use OsumiFramework\App\Component\RecipeListComponent;
use OsumiFramework\App\Component\ShoppinglistListComponent;

#[OModuleAction(
	url: '/getMainData',
	filters: ['login'],
	components: ['model/dayrecipe_list', 'model/recipe_list', 'model/shoppinglist_list']
)]
class getMainDataAction extends OAction {
	/**
	 * Función para obtener los datos de main
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ORequest $req):void {
		$status = 'ok';
		$filter = $req->getFilter('login');
		$day_recipes    = new DayrecipeListComponent(['list' => []]);
		$recipes        = new RecipeListComponent(['list' => []]);
		$shopping_lists = new ShoppinglistListComponent(['list' => []]);

		if (is_null($filter) || $filter['status'] == 'error' || !array_key_exists('id', $filter)) {
			$status = 'error';
		}

		if ($status=='ok') {
			$u = new User();
			if ($u->find(['id' => $filter['id']])) {
				$day_recipes->setValue('list', $u->getDayRecipes());
				$recipes->setValue('list', $u->getRecipes());
				$shopping_lists->setValue('list', $u->getShoppingLists());
			}
			else {
				$status = 'error';
			}
		}

		$this->getTemplate()->add('status',         $status);
		$this->getTemplate()->add('day_recipes',    $day_recipes);
		$this->getTemplate()->add('recipes',        $recipes);
		$this->getTemplate()->add('shopping_lists', $shopping_lists);
	}
}
