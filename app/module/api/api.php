<?php declare(strict_types=1);

namespace OsumiFramework\App\Module;

use OsumiFramework\OFW\Core\OModule;
use OsumiFramework\OFW\Web\ORequest;
use OsumiFramework\OFW\Routing\ORoute;
use OsumiFramework\OFW\Plugins\OToken;
use OsumiFramework\App\Model\User;
use OsumiFramework\App\DTO\LoginDTO;
use OsumiFramework\App\DTO\RegisterDTO;
use OsumiFramework\App\Service\mealsService;

#[ORoute(
	type: 'json',
	prefix: '/api'
)]
class api extends OModule {
	private ?mealsService $meals_service = null;

	function __construct() {
		$this->meals_service = new mealsService();
	}

	/**
	 * Función para iniciar sesión en la aplicación
	 *
	 * @param LoginDTO $data Objeto con la información para iniciar sesión
	 * @return void
	 */
	#[ORoute('/login')]
	public function login(LoginDTO $data): void {
		$status = 'ok';
		$id     = 'null';
		$name   = '';
		$email  = '';
		$token  = '';

		if (!$data->isValid()) {
			$status = 'error';
		}

		if ($status=='ok') {
			$u = new User();
			if ($u->find(['email'=>$data->getEmail()])) {
				if (password_verify($data->getPass(), $u->get('pass'))) {
					$id = $u->get('id');
					$name = $u->get('name');
					$email = $u->get('email');

					$tk = new OToken($this->getConfig()->getExtra('secret'));
					$tk->addParam('id',   $id);
					$tk->addParam('email', $email);
					$tk->addParam('exp', time() + (24 * 60 * 60));
					$token = $tk->getToken();
				}
				else {
					$status = 'error';
				}
			}
			else {
				$status = 'error';
			}
		}

		$this->getTemplate()->add('status', $status);
		$this->getTemplate()->add('id',     $id);
		$this->getTemplate()->add('name',   $name);
		$this->getTemplate()->add('email',  $email);
		$this->getTemplate()->add('token',  $token);
	}

	/**
	 * Función para registrarse en la aplicación
	 *
	 * @param RegisterDTO $data Objeto con la información para registrar un nuevo usuario
	 * @return void
	 */
	#[ORoute('/register')]
	public function register(RegisterDTO $data): void {
		$status = 'ok';
		$id    = 'null';
		$name  = '';
		$email = '';
		$token = '';

		if (!$data->isValid()) {
			$status = 'error';
		}

		if ($status=='ok') {
			$u = new User();
			if ($u->find(['name'=>$data->getName()])) {
				$status = 'error-user';
			}
			else {
				if ($u->find(['email'=>$data->getEmail()])) {
					$status = 'error-email';
				}
				else {
					$u->set('name',  $data->getName());
					$u->set('email', $data->getEmail());
					$u->set('pass',  password_hash($data->getPass(), PASSWORD_BCRYPT));
					$u->save();

					$this->meals_service->createMealsForUser($u);

					$id = $u->get('id');
					$name = $u->get('name');
					$email = $u->get('email');

					$tk = new OToken($this->getConfig()->getExtra('secret'));
					$tk->addParam('id',   $id);
					$tk->addParam('name', $name);
					$tk->addParam('exp', time() + (24 * 60 * 60));
					$token = $tk->getToken();
				}
			}
		}

		$this->getTemplate()->add('status', $status);
		$this->getTemplate()->add('id',     $id);
		$this->getTemplate()->add('name',   $name);
		$this->getTemplate()->add('email',  $email);
		$this->getTemplate()->add('token',  $token);
	}
	
	/**
	 * Función para obtener los datos de main
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	#[ORoute(
		'/getMainData',
		filter: 'loginFilter'
	)]
	public function getMainData(ORequest $req): void {
		$status = 'ok';
		$filter = $req->getFilter('loginFilter');
		$day_recipes    = [];
		$recipes        = [];
		$shopping_lists = [];

		if (is_null($filter) || $filter['status'] == 'error' || !array_key_exists('id', $filter)) {
			$status = 'error';
		}

		if ($status=='ok') {
			$u = new User();
			if ($u->find(['id' => $filter['id']])) {
				$day_recipes    = $u->getDayRecipes();
				$recipes        = $u->getRecipes();
				$shopping_lists = $u->getShoppingLists();
			}
			else {
				$status = 'error';
			}
		}

		$this->getTemplate()->add('status', $status);
		$this->getTemplate()->addComponent('day_recipes',    'model/dayrecipe_list',    ['list' => $day_recipes,    'extra' => 'nourlencode']);
		$this->getTemplate()->addComponent('recipes',        'model/recipe_list',       ['list' => $recipes,        'extra' => 'nourlencode']);
		$this->getTemplate()->addComponent('shopping_lists', 'model/shoppinglist_list', ['list' => $shopping_lists, 'extra' => 'nourlencode']);
	}
}
