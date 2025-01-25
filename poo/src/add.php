<?php
require_once 'classes/Marca.php';
$action = 'Agregar';
include_once 'head.php';
$type = $_GET['type'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($type === 'marca') {
        $marca = new Marca();
        $marca->add($_POST['marca_name']);
        header("Location: index.php");
        exit;
    }
}
?>

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
