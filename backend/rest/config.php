<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

class Config {
    public static function DB_NAME() {
        return Config::get_env("DB_NAME", "webfinal");
    }
    public static function DB_PORT() {
        return Config::get_env("DB_PORT", 3306);
    }
    public static function DB_USER() {
        return Config::get_env("DB_USER", 'webfinal_24');
    }
    public static function DB_PASSWORD() {
        return Config::get_env("DB_PASSWORD", 'web24finPWD');
    }
    public static function DB_HOST() {
        return Config::get_env("DB_HOST", 'db1.ibu.edu.ba');
    }
    public static function get_env($name, $default){
        return isset($_ENV[$name]) && trim($_ENV[$name]) != "" ? $_ENV[$name] : $default;
    }
}

?>