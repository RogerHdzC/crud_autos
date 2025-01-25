<?php

require_once __DIR__ . '/../../vendor/autoload.php'; // Asegúrate de ajustar la ruta si es diferente
use Dotenv\Dotenv;

class Database
{
    private $pdo;

    public function connect()
    {
        if ($this->pdo == null) {
            try {
                $dotenv = Dotenv::createImmutable(__DIR__);
                $dotenv->load();

                $host = $_ENV['host'];
                $db = $_ENV['db'];
                $user = $_ENV['user'];
                $password = $_ENV['password'];

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
