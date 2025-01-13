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