<?php
require_once 'classes/Marca.php';
require_once 'classes/Modelo.php';
$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';

if ($type && $id) {
    if($type === "marca"){
        $marca = new Marca();
        $marca->delete($id);
        header("Location: index.php");
        exit;
    } elseif($type === "modelo"){
        $modelo = new Modelo();
        $modelo->delete($id);
        header("Location: index.php");
        exit;
    } 
}
