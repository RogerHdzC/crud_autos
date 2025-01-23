<?php
    require __DIR__ . '/../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
    $host = $_ENV['host'];
    $db = $_ENV['db'];
    $user = $_ENV['user'];
    $password = $_ENV['password'];
    $dsn = "mysql:host={$host};dbname={$db};charset=UTF8";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Autos</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="container">
        <h1>CRUD de Autos</h1>

        <!-- Tabla de Marcas -->
        <div>
            <h2>Marcas</h2>
            <button onclick="window.location.href='add.php?type=marca'">Agregar Marca</button>
            <table class="table-info-auto">
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pdo = new PDO($dsn, $user, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $marcas = $pdo->query("SELECT * FROM marcas")->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($marcas as $marca) {
                        echo "<tr>
                                <td>{$marca['marca_name']}</td>
                                <td>
                                    <button class='edit' onclick=\"window.location.href='edit.php?type=marca&id={$marca['marca_id']}'\">Editar</button>
                                    <button class='delete' onclick=\"window.location.href='delete.php?type=marca&id={$marca['marca_id']}'\">Eliminar</button>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Tabla de Modelos -->
        <div>
            <h2>Modelos</h2>
            <button onclick="window.location.href='add.php?type=modelo'">Agregar Modelo</button>
            <table class="table-info-auto">
                <thead>
                    <tr>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $modelos = $pdo->query("SELECT modelos.modelo_id, modelos.modelo_name, marcas.marca_name 
                                            FROM modelos 
                                            JOIN marcas ON modelos.marca_id = marcas.marca_id")->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($modelos as $modelo) {
                        echo "<tr>
                                <td>{$modelo['modelo_name']}</td>
                                <td>{$modelo['marca_name']}</td>
                                <td>
                                    <button class='edit' onclick=\"window.location.href='edit.php?type=modelo&id={$modelo['modelo_id']}'\">Editar</button>
                                    <button class='delete' onclick=\"window.location.href='delete.php?type=modelo&id={$modelo['modelo_id']}'\">Eliminar</button>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
