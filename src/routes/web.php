<?php

use App\Routes\Router;

$router = new Router($pdo);

$router->get(['/', 'HomeController@index']);
$router->get(['/services', 'HomeController@services']);
$router->get(['/about', 'HomeController@about']);
$router->get(['/contact', 'HomeController@contact']);