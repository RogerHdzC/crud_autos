<?php
require_once 'classes/Marca.php';
require_once 'classes/Modelo.php';
require_once 'classes/Submodelo.php';
$action = 'Editar';

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';
$item = '';

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
    } elseif ($type === 'submodelo'){
        $submodelo_name = filter_var(trim($_POST['submodelo_name']), FILTER_SANITIZE_STRING);
        $modelo_id = filter_var($_POST['modelo_id'], FILTER_VALIDATE_INT);
        $submodelo_year = filter_var($_POST['submodelo_year'], FILTER_VALIDATE_INT);
        $submodelo_ac = isset($_POST['submodelo_ac']) ? filter_var((int)$_POST['submodelo_ac'], FILTER_VALIDATE_INT) : 0;
        if (!empty($submodelo_name) && $modelo_id && $submodelo_year && $submodelo_ac >= 0){
            $submodelo = new Submodelo();
            $submodelo->edit($id, $modelo_id, $submodelo_name, $submodelo_year, $submodelo_ac);
            header("Location: index.php");
            exit;
        }
        header("Location: index.php");
        exit;
    }
}

if ($type === 'marca') {
    $marca = new Marca();
    $item = $marca->getById($id);
} elseif ($type === 'modelo') {
    $modelo = new Modelo();
    $item = $modelo->getById($id);
    $marcas = (new Marca())->getAll();
} elseif ($type === 'submodelo') {
    $submodelo = new Submodelo();
    $item = $submodelo->getById($id);
    $modelos = (new Modelo())->getAll();
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
    <?php elseif ($type === 'submodelo'): ?>
            <label>Nombre del Submodelo:</label>
            <input type="text" name="submodelo_name" value="<?php echo $item['submodelo_name']; ?>" required>
            <label>Modelo:</label>
            <select name="modelo_id">
                <?php
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
<?php
$content = ob_get_clean();
include 'layout.php';
