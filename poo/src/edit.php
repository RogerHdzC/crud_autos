<?php
require_once 'classes/Marca.php';
require_once 'classes/Modelo.php';
$action = 'Editar';
include_once 'head.php';
$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';
$item = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($type === 'marca') {
        $marca = new Marca();
        $marca->edit($id, $_POST['marca_name']);
        header("Location: index.php");
        exit;
    } elseif($type === 'modelo') {
        $modelo = new Modelo();
        $modelo->edit($id, $_POST['marca_id'], $_POST['modelo_name']);
        header("Location: index.php");
        exit;
    }
}

$marcas = (new Marca())->getAll();
if ($type === 'marca') {
    $marca = new Marca();
    $item = $marca->getById($id);
} elseif($type === 'modelo'){
    $modelo = new Modelo();
    $item = $modelo->getById($id);
}

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
                foreach ($marcas as $marca) {
                    $selected = $marca['marca_id'] == $item['marca_id'] ? 'selected' : '';
                    echo "<option value='{$marca['marca_id']}' {$selected}>{$marca['marca_name']}</option>";
                }
                ?>
            </select>
        <?php endif; ?>
        <button type="submit">Guardar Cambios</button>
        </form>
</body>
</html>