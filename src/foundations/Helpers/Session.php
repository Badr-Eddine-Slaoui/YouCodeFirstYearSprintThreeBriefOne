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

    public static function setLifetime(int $seconds){
        if (static::isStarted()) {
            return;
        }

        ini_set('session.gc_maxlifetime', $seconds);

        session_set_cookie_params([
            'lifetime' => $seconds,
            'path' => '/',
            'httponly' => true,
            'secure' => isset($_SERVER['HTTPS']),
            'samesite' => 'Lax'
        ]);
    }

}