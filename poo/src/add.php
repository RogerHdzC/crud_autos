<?php
require_once 'classes/Marca.php';
require_once 'classes/Modelo.php';
$action = 'Agregar';
include_once 'head.php';
$type = $_GET['type'] ?? '';

$marca = new Marca();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($type === 'marca') {
        $marca->add($_POST['marca_name']);
        header("Location: index.php");
        exit;
    } elseif($type === 'modelo'){
        $modelo = new Modelo();
        $modelo->add($_POST['marca_id'], $_POST['modelo_name']);
        header("Location: index.php");
        exit;
    }
}
if($type === 'modelo'){
    $marcas = $marca->getAll();
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
                foreach ($marcas as $marca) {
                    echo "<option value='{$marca['marca_id']}'>{$marca['marca_name']}</option>";
                }
                ?>
            </select>
        <?php endif; ?>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
