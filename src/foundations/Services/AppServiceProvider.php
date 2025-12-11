<?php

namespace Foundations\Services;

use Foundations\DI\Container;
use Foundations\Routes\Router;
use Dotenv\Dotenv;

class AppServiceProvider {

    public function register(Container $container)
    {   
        $container->resolve([
            Router::class
        ]);
    }

    public function boot(Container $container)
    {

        require_once __DIR__.'/../../config/app.php';

        $router = $container->get(Router::class);

        $GLOBALS['app'] = $container;

        require_once __DIR__.'/../../routes/web.php';

        $router->dispatch();
    }
}