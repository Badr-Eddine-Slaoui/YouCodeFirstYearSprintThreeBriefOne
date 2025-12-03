<?php

use App\DI\Container;
use App\Services\AppServiceProvider;

require_once __DIR__.'/vendor/autoload.php';

$appProvider = new AppServiceProvider();
$container = new Container();
$appProvider->register($container);
$appProvider->boot($container);