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

    public static function setSavePath(string $path){
        if (static::isStarted()) {
            return;
        }

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        session_save_path($path);
    }

}