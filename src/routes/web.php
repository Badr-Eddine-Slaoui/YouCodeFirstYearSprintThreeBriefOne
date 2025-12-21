<?php

$router->get(['/', 'HomeController@index'])->name('index');
$router->get(['/services', 'HomeController@services'])->name('services');
$router->get(['/about', 'HomeController@about'])->name('about');
$router->get(['/contact', 'HomeController@contact'])->name('contact');

$router->get(['/signup', 'AuthController@signup'])->name('signup');
$router->post(['/signup','AuthController@signupSubmit'])->name('signupSubmit');
$router->get(['/login', 'AuthController@login'])->name('login');
$router->post(['/login','AuthController@loginSubmit'])->name('loginSubmit');
$router->post(['/logout','AuthController@logout'])->name('logout')->middleware(['is_authed']);

$router->get(['/profile/{user}', 'UserController@profile'])->name('profile')->middleware(['is_authed']);
$router->post(['/profile/{user}', 'UserController@update'])->name('profileUpdate')->middleware(['is_authed']);