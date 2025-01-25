<?php
require_once __DIR__ . '/Config.php';

class Database {
    private $pdo;

    public function connect() {
        if ($this->pdo === null) {
            try {
                $host = Config::get('host');
                $db = Config::get('db');
                $user = Config::get('user');
                $password = Config::get('password');

                if (!$host || !$db || !$user || !$password) {
                    throw new Exception("Faltan variables de configuración.");
                }

                $dsn = "mysql:host={$host};dbname={$db};charset=utf8";
                $this->pdo = new PDO($dsn, $user, $password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}
