<?php
include_once 'includes/db.php';

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';

if ($type && $id) {
    $pdo->prepare("DELETE FROM {$type}s WHERE {$type}_id = ?")->execute([$id]);
}

header("Location: index.php");
