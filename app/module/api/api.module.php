<?php declare(strict_types=1);

namespace OsumiFramework\App\Module;

use OsumiFramework\OFW\Routing\OModule;

#[OModule(
	actions: 'login, register, getMainData',
	type: 'json',
	prefix: '/api'
)]
class apiModule {}
