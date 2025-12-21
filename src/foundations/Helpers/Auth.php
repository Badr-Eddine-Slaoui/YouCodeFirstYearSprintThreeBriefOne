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

    public static function login(string $email, string $password): bool{
        if(empty($email) || empty($password)){
            return false;
        }
        
        $config = static::config();
        $guard = $config["defaults"]["guard"];
        $driver = $config["guards"][$guard]["driver"];
        $provider = $config["guards"][$guard]["provider"];
        $providerDriver = $config["providers"][$provider]["driver"];
        
        if($providerDriver === "golddigger"){
            $model = $config["providers"][$provider]["model"];

            $user = $model::query()->where(["email" => $email])->first();

            if(empty($user)){
                return false;
            }
            
            if(!password_verify($password, $user->password)){
                return false;
            }

            if($driver == "session"){
                Session::set("user_id", $user->id);
                Session::regenerate();
                return true;
            }
        }

        return false;

    }
}