<?php

namespace Foundations\Helpers;

class Session{

    public static function isStarted(){
        return session_status() === PHP_SESSION_ACTIVE;
    }

    public static function start(){
        if (self::isStarted()) {
            return;
        }

        session_start();
    }

}