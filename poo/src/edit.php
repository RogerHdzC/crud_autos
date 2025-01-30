<?php
require_once 'classes/Marca.php';
require_once 'classes/Modelo.php';
$action = 'Editar';

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';
$item = '';

$marcas = (new Marca())->getAll();

// Validar que el ID sea un número entero válido
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
    die("ID inválido.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($type === 'marca') {
        $marca_name = filter_var(trim($_POST['marca_name']), FILTER_SANITIZE_STRING);
        
        if (!empty($marca_name)) {
            $marca = new Marca();
            $marca->edit($id, $marca_name);
            header("Location: index.php");
            exit;
        } else {
            echo "⚠️ Error: El nombre de la marca no puede estar vacío.";
        }
    } elseif ($type === 'modelo') {
        $modelo_name = filter_var(trim($_POST['modelo_name']), FILTER_SANITIZE_STRING);
        $marca_id = filter_var($_POST['marca_id'], FILTER_VALIDATE_INT);
        
        if (!empty($modelo_name) && $marca_id) {
            $modelo = new Modelo();
            $modelo->edit($id, $marca_id, $modelo_name);
            header("Location: index.php");
            exit;
        } else {
            echo "⚠️ Error: Todos los campos son obligatorios.";
        }
    }
}

if ($type === 'marca') {
    $marca = new Marca();
    $item = $marca->getById($id);
} elseif ($type === 'modelo') {
    $modelo = new Modelo();
    $item = $modelo->getById($id);
}
ob_start();
?>

<h1>Editar <?php echo ucfirst($type); ?></h1>
<form method="POST">
    <?php if ($type === 'marca'): ?>
        <label>Nombre de la Marca:</label>
        <input type="text" name="marca_name" value="<?= htmlspecialchars($item['marca_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
    <?php elseif ($type === 'modelo'): ?>
        <label>Nombre del Modelo:</label>
        <input type="text" name="modelo_name" value="<?= htmlspecialchars($item['modelo_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
        <label>Marca:</label>
        <select name="marca_id">
            <?php foreach ($marcas as $marca): ?>
                <option value="<?= $marca['marca_id']; ?>" <?= ($marca['marca_id'] == $item['marca_id']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($marca['marca_name'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    <?php endif; ?>
    <button type="submit">Guardar Cambios</button>
</form>
<?php
$content = ob_get_clean();
include 'layout.php';
