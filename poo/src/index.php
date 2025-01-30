<?php
require_once 'classes/Marca.php';
require_once 'classes/Modelo.php';
$marca = new Marca();
$modelo = new Modelo();
$marcas = $marca->getAll();
$modelos = $modelo->getAllWithMarca();
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
<?php
$content = ob_get_clean();
include 'layout.php';