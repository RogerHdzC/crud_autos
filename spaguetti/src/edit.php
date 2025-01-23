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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($type === 'marca') {
        $marca_name = $_POST['marca_name'];
        $pdo->prepare("UPDATE marcas SET marca_name = ? WHERE marca_id = ?")->execute([$marca_name, $id]);
        header("Location: index.php");
    }
}

$item = $pdo->query("SELECT * FROM {$type}s WHERE {$type}_id = {$id}")->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/main.css">
    <title>Editar <?php echo ucfirst($type); ?></title>
</head>
<body>
    <h1>Editar <?php echo ucfirst($type); ?></h1>
    <form method="POST">
        <?php if ($type === 'marca'): ?>
            <label>Nombre de la Marca:</label>
            <input type="text" name="marca_name" value="<?php echo $item['marca_name']; ?>" required>
        <?php endif; ?>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
