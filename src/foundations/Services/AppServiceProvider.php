<?php

namespace Foundations\Services;

use Foundations\DB\Database;
use Foundations\DI\Container;
use Foundations\Routes\Router;

class AppServiceProvider {

    public function register(Container $container)
    {
        $container->resolve([
            Database::class,
            Router::class
        ]);
    }

    public function boot(Container $container)
    {
        $router = $container->get(Router::class);

        $GLOBALS['app'] = $container;

        require_once __DIR__.'/../../routes/web.php';

        require_once __DIR__.'/../../config/app.php';

        require_once __DIR__.'/../../config/database.php';


        $router->dispatch();
    }
}