<?php
require_once 'classes/Marca.php';
require_once 'classes/Modelo.php';
require_once 'classes/Submodelo.php';
$marca = new Marca();
$modelo = new Modelo();
$submodelo = new Submodelo();
$marcas = $marca->getAll();
$modelos = $modelo->getAllWithMarca();
$submodelos = $submodelo->getAllWithModelo();
ob_start();
?>
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
                    <?php foreach ($marcas as $marca): ?>
                        <tr>
                            <td><?= htmlspecialchars($marca['marca_name']); ?></td>
                            <td>
                                <button class='edit' onclick="window.location.href='edit.php?type=marca&id=<?= $marca['marca_id'] ?>'">Editar</button>
                                <button class='delete' onclick="window.location.href='delete.php?type=marca&id=<?= $marca['marca_id'] ?>'">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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
        <!-- Tabla de Submodelos -->
        <div>
            <h2>Submodelos</h2>
            <button onclick="window.location.href='add.php?type=submodelo'">Agregar Submodelo</button>
            <table class="table-info-auto">
                <thead>
                    <tr>
                        <th>Submodelo</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>AC</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($submodelos as $submodelo) {
                        $ac = $submodelo['submodelo_ac'] ? 'Sí' : 'No';
                        echo "<tr>
                                <td>{$submodelo['submodelo_name']}</td>
                                <td>{$submodelo['modelo_name']}</td>
                                <td>{$submodelo['submodelo_year']}</td>
                                <td>{$ac}</td>
                                <td>
                                    <button class='edit' onclick=\"window.location.href='edit.php?type=submodelo&id={$submodelo['submodelo_id']}'\">Editar</button>
                                    <button class='delete' onclick=\"window.location.href='delete.php?type=submodelo&id={$submodelo['submodelo_id']}'\">Eliminar</button>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
$content = ob_get_clean();
include 'layout.php';