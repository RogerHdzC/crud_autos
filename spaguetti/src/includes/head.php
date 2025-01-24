<?php
include_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Autos <?php if($action): echo ucfirst($action); ?> <?php echo ucfirst($type); endif ?> </title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
