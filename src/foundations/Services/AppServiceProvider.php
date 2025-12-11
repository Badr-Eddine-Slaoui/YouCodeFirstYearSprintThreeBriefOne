<?php

namespace Foundations\Services;

use Foundations\DB\Database;
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
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
        $dotenv->load();

        foreach ($_ENV as $key => $value) {
            putenv("$key=$value");
        }

        require_once __DIR__.'/../../config/app.php';

        $router = $container->get(Router::class);

        $GLOBALS['app'] = $container;

        require_once __DIR__.'/../../routes/web.php';

        $router->dispatch();

        $db = new Database() ;
    }
}