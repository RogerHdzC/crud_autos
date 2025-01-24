<?php
$action = 'Agregar';
include_once 'includes/head.php';

$type = $_GET['type'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($type === 'marca') {
        $marca_name = $_POST['marca_name'];
        $pdo->prepare("INSERT INTO marcas (marca_name) VALUES (?)")->execute([$marca_name]);
        header("Location: index.php");
    } elseif ($type === 'modelo') {
        $modelo_name = $_POST['modelo_name'];
        $marca_id = $_POST['marca_id'];
        $pdo->prepare("INSERT INTO modelos (modelo_name, marca_id) VALUES (?, ?)")->execute([$modelo_name, $marca_id]);
        header("Location: index.php");
    } elseif ($type === 'submodelo') {
        $submodelo_name = $_POST['submodelo_name'];
        $modelo_id = $_POST['modelo_id'];
        $submodelo_year = $_POST['submodelo_year'];
        $submodelo_ac = $_POST['submodelo_ac'];
        $pdo->prepare("INSERT INTO submodelos (submodelo_name, modelo_id, submodelo_year, submodelo_ac) VALUES (?, ?, ?, ?)")
            ->execute([$submodelo_name, $modelo_id, $submodelo_year, $submodelo_ac]);
        header("Location: index.php");
    }
}
?>
    <h1>Agregar <?php echo ucfirst($type); ?></h1>
    <form method="POST">
        <?php if ($type === 'marca'): ?>
            <label>Nombre de la Marca:</label>
            <input type="text" name="marca_name" required>
        <?php elseif ($type === 'modelo'): ?>
            <label>Nombre del Modelo:</label>
            <input type="text" name="modelo_name" required>
            <label>Marca:</label>
            <select name="marca_id">
                <?php
                $marcas = $pdo->query("SELECT * FROM marcas")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($marcas as $marca) {
                    echo "<option value='{$marca['marca_id']}'>{$marca['marca_name']}</option>";
                }
                ?>
            </select>
        <?php elseif ($type === 'submodelo'): ?>
            <label>Nombre del Submodelo:</label>
            <input type="text" name="submodelo_name" required>
            <label>Modelo:</label>
            <select name="modelo_id">
                <?php
                $modelos = $pdo->query("SELECT * FROM modelos")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($modelos as $modelo) {
                    echo "<option value='{$modelo['modelo_id']}'>{$modelo['modelo_name']}</option>";
                }
                ?>
            </select>
            <label>Año:</label>
            <input type="number" name="submodelo_year" required>
            <label>Aire Acondicionado:</label>
            <label class="switch">
                <input type="checkbox" name="submodelo_ac" value="1">
                <span class="slider round"></span>
            </label>
        <?php endif; ?>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
