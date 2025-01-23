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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($type === 'marca') {
        $marca_name = $_POST['marca_name'];
        $pdo->prepare("INSERT INTO marcas (marca_name) VALUES (?)")->execute([$marca_name]);
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/main.css">
    <title>Agregar <?php echo ucfirst($type); ?></title>
</head>
<body>
    <h1>Agregar <?php echo ucfirst($type); ?></h1>
    <form method="POST">
        <?php if ($type === 'marca'): ?>
            <label>Nombre de la Marca:</label>
            <input type="text" name="marca_name" required>
        <?php endif; ?>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
