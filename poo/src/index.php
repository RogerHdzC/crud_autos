<?php
require_once 'classes/Marca.php';
$marca = new Marca();
$marcas = $marca->getAll();
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
<?php
$content = ob_get_clean();
include 'layout.php';