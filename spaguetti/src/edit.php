<?php
$action = 'Editar';
include_once 'includes/head.php';

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($type === 'marca') {
        $marca_name = $_POST['marca_name'];
        $pdo->prepare("UPDATE marcas SET marca_name = ? WHERE marca_id = ?")->execute([$marca_name, $id]);
        header("Location: index.php");
    } elseif ($type === 'modelo') {
        $modelo_name = $_POST['modelo_name'];
        $marca_id = $_POST['marca_id'];
        $pdo->prepare("UPDATE modelos SET modelo_name = ?, marca_id = ? WHERE modelo_id = ?")->execute([$modelo_name, $marca_id, $id]);
        header("Location: index.php");
    } elseif ($type === 'submodelo') {
        $submodelo_name = $_POST['submodelo_name'];
        $modelo_id = $_POST['modelo_id'];
        $submodelo_year = $_POST['submodelo_year'];
        $submodelo_ac = $_POST['submodelo_ac'];
        $pdo->prepare("UPDATE submodelos SET submodelo_name = ?, modelo_id = ?, submodelo_year = ?, submodelo_ac = ? WHERE submodelo_id = ?")
            ->execute([$submodelo_name, $modelo_id, $submodelo_year, $submodelo_ac, $id]);
        header("Location: index.php");
    }
}

$item = $pdo->query("SELECT * FROM {$type}s WHERE {$type}_id = {$id}")->fetch(PDO::FETCH_ASSOC);
?>


    <h1>Editar <?php echo ucfirst($type); ?></h1>
    <form method="POST">
        <?php if ($type === 'marca'): ?>
            <label>Nombre de la Marca:</label>
            <input type="text" name="marca_name" value="<?php echo $item['marca_name']; ?>" required>
        <?php elseif ($type === 'modelo'): ?>
            <label>Nombre del Modelo:</label>
            <input type="text" name="modelo_name" value="<?php echo $item['modelo_name']; ?>" required>
            <label>Marca:</label>
            <select name="marca_id">
                <?php
                $marcas = $pdo->query("SELECT * FROM marcas")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($marcas as $marca) {
                    $selected = $marca['marca_id'] == $item['marca_id'] ? 'selected' : '';
                    echo "<option value='{$marca['marca_id']}' {$selected}>{$marca['marca_name']}</option>";
                }
                ?>
            </select>
        <?php elseif ($type === 'submodelo'): ?>
            <label>Nombre del Submodelo:</label>
            <input type="text" name="submodelo_name" value="<?php echo $item['submodelo_name']; ?>" required>
            <label>Modelo:</label>
            <select name="modelo_id">
                <?php
                $modelos = $pdo->query("SELECT * FROM modelos")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($modelos as $modelo) {
                    $selected = $modelo['modelo_id'] == $item['modelo_id'] ? 'selected' : '';
                    echo "<option value='{$modelo['modelo_id']}' {$selected}>{$modelo['modelo_name']}</option>";
                }
                ?>
            </select>
            <label>Año:</label>
            <input type="number" name="submodelo_year" value="<?php echo $item['submodelo_year']; ?>" required>
            <label>Aire Acondicionado:</label>
            <label class="switch">
                <input type="checkbox" name="submodelo_ac" value="1" <?php echo $item['submodelo_ac'] ? 'checked' : ''; ?>>
                <span class="slider round"></span>
            </label>
        <?php endif; ?>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
