<?php declare(strict_types=1);

namespace OsumiFramework\App\Module;

use OsumiFramework\OFW\Core\OModule;
use OsumiFramework\OFW\Web\ORequest;
use OsumiFramework\OFW\Routing\ORoute;
use OsumiFramework\OFW\Plugins\OToken;
use OsumiFramework\App\Model\User;
use OsumiFramework\App\DTO\LoginDTO;
use OsumiFramework\App\DTO\RegisterDTO;

#[ORoute(
	type: 'json',
	prefix: '/api'
)]
class api extends OModule {
	/**
	 * Función para iniciar sesión en la aplicación
	 *
	 * @param LoginDTO $data Objeto con la información para iniciar sesión
	 * @return void
	 */
	#[ORoute('/login')]
	public function login(LoginDTO $data): void {
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
}
