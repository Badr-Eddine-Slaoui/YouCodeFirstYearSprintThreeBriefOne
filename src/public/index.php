<?php

use Foundations\DI\Container;
use Foundations\Services\AppServiceProvider;

require_once __DIR__.'/../vendor/autoload.php';

$appProvider = new AppServiceProvider();
$container = new Container();
$appProvider->register($container);
$appProvider->boot($container);