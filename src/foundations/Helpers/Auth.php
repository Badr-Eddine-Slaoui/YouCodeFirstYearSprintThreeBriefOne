<?php

namespace Foundations\Helpers;

use Foundations\DB\GoldDigger\Model;

class Auth{
    protected static array $config;

    protected static function config(): array
    {
        if (!isset(static::$config)) {
            static::$config = require __DIR__ . "/../../config/auth.php";
        }

        return static::$config;
    }
}