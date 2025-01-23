<?php
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
$host = $_ENV['host'];
$db = $_ENV['db'];
$user = $_ENV['user'];
$password = $_ENV['password'];
$dsn = "mysql:host={$host};dbname={$db};charset=UTF8";
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';

if ($type && $id) {
    $pdo->prepare("DELETE FROM {$type}s WHERE {$type}_id = ?")->execute([$id]);
}

header("Location: index.php");
