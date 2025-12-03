<?php

$router->get(['/', 'HomeController@index'])->name('index');
$router->get(['/services', 'HomeController@services'])->name('services');
$router->get(['/about', 'HomeController@about'])->name('about');
$router->get(['/contact', 'HomeController@contact'])->name('contact');