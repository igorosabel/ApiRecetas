<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\OFW\Plugins\OToken;
use OsumiFramework\App\DTO\LoginDTO;
use OsumiFramework\App\model\User;

#[OModuleAction(
	url: '/login'
)]
class loginAction extends OAction {
	/**
	 * Función para iniciar sesión en la aplicación
	 *
	 * @param LoginDTO $data Objeto con la información para iniciar sesión
	 * @return void
	 */
	public function run(LoginDTO $data):void {
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
			if ($u->find(['email' => $data->getEmail()])) {
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
}
