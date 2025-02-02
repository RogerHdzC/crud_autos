# Crud de Autos

Este proyecto tiene como objetivo desarrollar un CRUD (Crear, Leer, Actualizar, Eliminar) para gestionar autos. El desarrollo se realizará en tres etapas, cada una con un enfoque diferente para aprender y comparar distintas técnicas de desarrollo:

1. **Código espagueti**: Implementación inicial con código estructurado sin orientación a objetos.
2. **Orientación a objetos (OOP)**: Refactorización del código para aplicar principios de programación orientada a objetos.
3. **Modelo-Vista-Controlador (MVC)**: Refactorización final para estructurar el proyecto con el patrón de diseño MVC.

El proyecto utilizará exclusivamente **PHP**, **JavaScript** y **CSS puro**.

## Requerimientos mínimos

### Linux
- **PHP** 8.3
- **MySQL** o **MariaDB**

### Windows
- **Windows Subsystem for Linux (WSL)** con **Ubuntu 24.04**
- **PHP** 8.3
- **MySQL**

## Tecnologías utilizadas
- **PHP**: Backend
- **JavaScript**: Interactividad en el frontend
- **CSS**: Estilización
- **HTML**: Frontend
- **LucidChart**: Diseño del UML y diagrama relacional *Es de paga, su versión gratuita tiene varias limitaciones*
- **dbDiagram**: Diseño del diagrama entidad relación *Es de paga, su versión gratuita tiene varias limitaciones*

## Estructura del proyecto

### Etapa 1: [Código espagueti](spaguetti/readme.md)
- Una sola capa de código donde las funcionalidades estarán implementadas directamente en los archivos PHP.
- Separación mínima de lógica, estructura y estilo.

### Etapa 2: [Orientación a objetos (OOP)](poo/readme.md)
- Introducción de clases para manejar la lógica de la aplicación.
- Métodos específicos para cada operación del CRUD.

### Etapa 3: Modelo-Vista-Controlador (MVC)
- Separación de responsabilidades:
  - **Modelo**: Gestión de datos y operaciones con la base de datos.
  - **Vista**: Presentación de datos al usuario.
  - **Controlador**: Manejo de la lógica de la aplicación y comunicación entre modelo y vista.

## Configuración inicial

### Linux
1. Instala **PHP 8.3** y **MySQL** o **MariaDB**:
   ```bash
   sudo apt update
   sudo apt install --no-install-recommends php8.3
   sudo apt-get install -y php8.3-cli php8.3-common php8.3-mysql php8.3-zip php8.3-curl php8.3-bcmath
   curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
   HASH=`curl -sS https://composer.github.io/installer.sig`
   php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
   ```
   El output debería de ser **Installer verified**
   ```bash
   sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
   ```
   **Installar mysql**
   ```bash
   mysql-server
   sudo apt install mysql-server
   sudo systemctl status mysql 
   ```
   Si esta inactivo ejecutar
   ```bash
   sudo systemctl start mysql
   sudo mysql_secure_installation
   ```
   Root: y
   Password: Depende de ustedes, en caso de que les pida incluir un password hacerlo, en el caso contrario podran hacer login con
   ```bash
   sudo mysql -u root
   ```
   Anonymus: y
   Root login: y
   Test db: y
   Reload privileges: y
   *Estas son recomendaciones basada en el artículo https://linuxgenie.net/install-mysql-ubuntu-24-04/ *
   
2. Verifica las versiones:
   ```bash
   php -v
   composer
   mysql --version
   ```

### Windows
1. Instala **WSL** y configura **Ubuntu 24.04**:
   - Sigue la guía oficial de instalación de WSL en [Microsoft Docs](https://learn.microsoft.com/en-us/windows/wsl/install).
   - Ubuntu
   
   ![Screenshot de la microsoft store](imgs/ss-microsoft-store-ubuntu.png)
2. Dentro de WSL, instala **PHP 8.3** y **MySQL** como se indica en la sección de Linux.

### Prueba la instalación de php
1. Crea un folder llamado MiPrimerArchivoPhp
   ```bash
   mkdir MiPrimerArchivoPhp 
   ```
2. Dentro del folder crea un archivo llamado index.php
   ```bash
   cd MiPrimerArchivoPhp
   nano index.php
   ```
   Copia y pega el siguiente texto
   ```nano
   <?php 
      echo "Hola Mundo";
   ```
   Para salir de nano presiona `ctr+o` luego enter, y finalmente presiona `ctrl+x`
3. Inicia un server de desarrollo de php
   ```bash
   php -S localhost:3000 
   ```
4. En el browser navega a `localhost:3000`, debería estar viendo:

![ss-hola-mundo](imgs/ss-hola-mundo.png)

### Test de la configuración de PHP & Mysql

   1. Crea esto en mysql con tu usario personal (NO ROOT) en la base de datos de autos

   ```sql
      CREATE TABLE `tbl_personal` (
      `id` int(11) NOT NULL,
      `nombres` varchar(50) NOT NULL,
      `apellidos` varchar(200) DEFAULT NULL,
      `profesion` varchar(150) DEFAULT NULL,
      `estado` varchar(100) DEFAULT NULL,
      `fregis` date DEFAULT NULL
      ) ENGINE=MyISAM DEFAULT CHARSET=utf8;


      INSERT INTO `tbl_personal` (`id`, `nombres`, `apellidos`, `profesion`, `estado`, `fregis`) VALUES
      (1, 'Zoila', 'Nina', 'Sistemas', 'Perú', '2019-08-20'),
      (2, 'Luis ', 'Fontis', 'Administrador', 'Argentina', '2019-08-19'),
      (3, 'Maria ', 'Cotrina', 'Sistemas', 'Ecuador', '2019-08-21'),
      (4, 'Jenifer ', 'Carrillo', 'Analista', 'Chile', '2019-08-21'),
      (5, 'Milagros ', 'Ferrer', 'Economista', 'Colombia', '2019-08-16');

      ALTER TABLE `tbl_personal`
      ADD PRIMARY KEY (`id`);


      ALTER TABLE `tbl_personal`
      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;COMMIT;
   ```
   2. Instala las dependencias necesarias de php con composer
   ```bash
    composer require vlucas/phpdotenv
   ```
   Crea un archivo llamado `.env`
   ```env
   host = 'localhost'
   db = 'changeme'
   user = 'changeme'
   password = 'changeme#'
   ```
   3. Dentro de tu index.php agrega el siguiente código
   ```php
   <?php
      require __DIR__ . '/vendor/autoload.php';
      $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
      $dotenv->safeLoad();
      $host = $_ENV['host'];
      $db = $_ENV['db'];
      $user = $_ENV['user'];
      $password = $_ENV['password'];
      $dsn = "mysql:host={$host};dbname={$db};charset=UTF8";
      try {
         $pdo = new PDO($dsn, $user, $password);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         if ($pdo) {
            echo "Connected to the $db database successfully!";
         }
      } catch (PDOException $e) {
         echo $e->getMessage();
      }
      echo "<br>";
      echo "<br>";
      $sql = "SELECT * FROM tbl_personal"; 
      $query = $pdo -> prepare($sql); 
      $query -> execute(); 
      $results = $query -> fetchAll(PDO::FETCH_OBJ); 

      if($query -> rowCount() > 0)   { 
      foreach($results as $result) { 
      echo "<tr>
      <td>".$result -> nombres."</td>
      <td>".$result -> apellidos."</td>
      <td>".$result -> profesion."</td>
      <td>".$result -> estado."</td>
      <td>".$result -> fregis."</td>
      </tr>";
      echo "<br>";

         }
      }


   ?>
   ```
   4. Deberías de ver algo así

   ![ss-php-mysql](imgs/ss-php-mysql.png)
   
#### Explicación del código
Aquí tienes una documentación detallada del código proporcionado:

---

## Descripción del Código
El código se conecta a una base de datos MySQL utilizando PDO (PHP Data Objects) y realiza una consulta para obtener todos los registros de la tabla `tbl_personal`. Los resultados se muestran en un formato HTML básico.

---

### Explicación por Secciones

#### **Carga de Variables de Entorno**
```php
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
```
- Incluye el archivo `autoload.php` generado por Composer, necesario para utilizar las dependencias instaladas.
- Carga las variables de entorno desde un archivo `.env` ubicado en el mismo directorio que el script.
- `safeLoad()` carga las variables de entorno de forma segura, sin lanzar errores si el archivo `.env` no existe.

---

#### **Obtención de Configuración de la Base de Datos**
```php
$host = $_ENV['host'];
$db = $_ENV['db'];
$user = $_ENV['user'];
$password = $_ENV['password'];
```
- Obtiene las configuraciones de conexión a la base de datos (host, nombre de la base de datos, usuario y contraseña) desde las variables de entorno.

---

#### **Conexión a la Base de Datos**
```php
$dsn = "mysql:host={$host};dbname={$db};charset=UTF8";
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($pdo) {
        echo "Connected to the $db database successfully!";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
```
- Crea un Data Source Name (DSN) con los parámetros de conexión.
- Intenta establecer una conexión a la base de datos usando la clase `PDO`:
  - Si tiene éxito, muestra un mensaje confirmando la conexión.
  - En caso de error, captura la excepción (`PDOException`) y muestra el mensaje de error correspondiente.
- Establece el modo de error de PDO a `ERRMODE_EXCEPTION`, para manejar errores de manera controlada.

---

#### **Consulta y Visualización de Datos**
```php
$sql = "SELECT * FROM tbl_personal"; 
$query = $pdo -> prepare($sql); 
$query -> execute(); 
$results = $query -> fetchAll(PDO::FETCH_OBJ);
```
- Define una consulta SQL para seleccionar todos los registros de la tabla `tbl_personal`.
- Prepara la consulta SQL con `prepare()` para mejorar la seguridad contra inyecciones SQL.
- Ejecuta la consulta con `execute()`.
- Recupera los resultados como un array de objetos (`PDO::FETCH_OBJ`).

---

#### **Muestra los Resultados**
```php
if($query -> rowCount() > 0) { 
    foreach($results as $result) { 
        echo "<tr>
        <td>".$result->nombres."</td>
        <td>".$result->apellidos."</td>
        <td>".$result->profesion."</td>
        <td>".$result->estado."</td>
        <td>".$result->fregis."</td>
        </tr>";
        echo "<br>";
    }
}
```
- Comprueba si la consulta devolvió algún registro (`rowCount()`).
- Itera sobre los resultados y los muestra en formato de filas (`<tr>`) de una tabla HTML.
- Cada registro muestra los valores de las columnas: `nombres`, `apellidos`, `profesion`, `estado`, y `fregis`.

---
## Diseño de la base de datos

El diseño de la base de datos está documentado en el siguiente archivo: [Diseño de Base de Datos](bd/bd.md)
