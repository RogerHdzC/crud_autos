<?php
require_once 'classes/Marca.php';
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
    }
}
if ($type === 'marca') {
    $marca = new Marca();
    $item = $marca->getById($id);
}

?>

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