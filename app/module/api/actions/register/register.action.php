<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\OFW\Plugins\OToken;
use OsumiFramework\App\DTO\RegisterDTO;
use OsumiFramework\App\model\User;

#[OModuleAction(
	url: '/register',
	services: ['meals']
)]
class registerAction extends OAction {
	/**
	 * Función para registrarse en la aplicación
	 *
	 * @param RegisterDTO $data Objeto con la información para registrar un nuevo usuario
	 * @return void
	 */
	public function run(RegisterDTO $data):void {
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
}
