<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use Dotenv\Dotenv;

class Config {
    private static $envLoaded = false;

    public static function get($key) {
        if (!self::$envLoaded) {
            $dotenv = Dotenv::createImmutable(__DIR__);
            $dotenv->load();
            self::$envLoaded = true;
        }
        return $_ENV[$key] ?? null;
    }
}
