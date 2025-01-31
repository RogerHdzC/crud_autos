<?php
require_once 'classes/Marca.php';
require_once 'classes/Modelo.php';
require_once 'classes/Submodelo.php';
$action = 'Agregar';

$type = $_GET['type'] ?? '';
$type = filter_var($type, FILTER_SANITIZE_STRING);

$marca = new Marca();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($type === 'marca') {
        $marca_name = filter_var(trim($_POST['marca_name'] ?? ''), FILTER_SANITIZE_STRING);
        
        if (!empty($marca_name)) {
            $marca->add($marca_name);
            header("Location: index.php");
            exit;
        } else {
            echo "⚠️ Error: El nombre de la marca no puede estar vacío.";
        }
    } elseif ($type === 'modelo') {
        $modelo_name = filter_var(trim($_POST['modelo_name'] ?? ''), FILTER_SANITIZE_STRING);
        $marca_id = filter_var($_POST['marca_id'], FILTER_VALIDATE_INT);
        
        if (!empty($modelo_name) && $marca_id) {
            $modelo = new Modelo();
            $modelo->add($marca_id, $modelo_name);
            header("Location: index.php");
            exit;
        } else {
            echo "⚠️ Error: Todos los campos son obligatorios.";
        }
    } elseif ($type === 'submodelo') {
        $submodelo_name = filter_var(trim($_POST['submodelo_name']), FILTER_SANITIZE_STRING);
        $modelo_id = filter_var($_POST['modelo_id'], FILTER_VALIDATE_INT);
        $submodelo_year = filter_var($_POST['submodelo_year'], FILTER_VALIDATE_INT);
        $submodelo_ac = isset($_POST['submodelo_ac']) ? filter_var((int)$_POST['submodelo_ac'], FILTER_VALIDATE_INT) : 0;
        if (!empty($submodelo_name) && $modelo_id && $submodelo_year && $submodelo_ac >= 0){
            $submodelo = new Submodelo();
            $submodelo->add($modelo_id, $submodelo_name, $submodelo_year, $submodelo_ac);
            header("Location: index.php");
            exit;
        } else {
            echo "⚠️ Error: Todos los campos son obligatorios.";
        }
    }
}

if ($type === 'modelo') {
    $marcas = $marca->getAll();
} elseif ($type === 'submodelo'){
    $modelos = (new Modelo())->getAll();
}

ob_start();
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
            <?php foreach ($marcas as $marca): ?>
                <option value="<?= htmlspecialchars($marca['marca_id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <?= htmlspecialchars($marca['marca_name'], ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    <?php elseif ($type === 'submodelo'): ?>
            <label>Nombre del Submodelo:</label>
            <input type="text" name="submodelo_name" required>
            <label>Modelo:</label>
            <select name="modelo_id">
                <?php
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
<?php
$content = ob_get_clean();
include 'layout.php';