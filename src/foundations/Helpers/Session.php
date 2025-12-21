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

    public static function get($key, $default = null){
        static::start();
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return $default;
        }
    }

    public static function set($key, $value){
        static::start();
        $_SESSION[$key] = $value;
    }

    public static function delete($key){
        static::start();
        unset($_SESSION[$key]);
    }

    public static function has($key){
        static::start();
        return isset($_SESSION[$key]) || isset($_SESSION["_flash"][$key]);
    }

    public static function forget(){
        static::start();
        $_SESSION = [];
    }

    public static function destroy(){
        static::start();
        static::forget();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
    }

}