<?php
include_once 'includes/head.php';
?>
    <div class="container">
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
                    <?php
                    $pdo = new PDO($dsn, $user, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $marcas = $pdo->query("SELECT * FROM marcas")->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($marcas as $marca) {
                        echo "<tr>
                                <td>{$marca['marca_name']}</td>
                                <td>
                                    <button class='edit' onclick=\"window.location.href='edit.php?type=marca&id={$marca['marca_id']}'\">Editar</button>
                                    <button class='delete' onclick=\"window.location.href='delete.php?type=marca&id={$marca['marca_id']}'\">Eliminar</button>
                                </td>
                              </tr>";
                    }
                    ?>
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
                    $modelos = $pdo->query("SELECT modelos.modelo_id, modelos.modelo_name, marcas.marca_name 
                                            FROM modelos 
                                            JOIN marcas ON modelos.marca_id = marcas.marca_id")->fetchAll(PDO::FETCH_ASSOC);

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
                    $submodelos = $pdo->query("SELECT submodelos.submodelo_id, submodelos.submodelo_name, submodelos.submodelo_year, submodelos.submodelo_ac, 
                                                      modelos.modelo_name 
                                               FROM submodelos 
                                               JOIN modelos ON submodelos.modelo_id = modelos.modelo_id")->fetchAll(PDO::FETCH_ASSOC);

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
</body>
</html>
