<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

define('BASE_PATH', dirname(__DIR__) . '/public');


if (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())
        ->usePutenv()
        ->bootEnv(dirname(__DIR__).'/.env');
}

passthru('php bin/console doctrine:database:create --env=test --no-interaction --if-not-exists');
passthru('php bin/console doctrine:migrations:migrate --env=test --no-interaction');