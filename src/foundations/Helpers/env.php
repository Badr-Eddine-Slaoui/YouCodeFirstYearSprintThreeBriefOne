<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();

foreach ($_ENV as $key => $value) {
    if (!is_array($value) && is_string($value)) {
        putenv("$key=$value");
    }
}