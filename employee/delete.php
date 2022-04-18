<?php

require_once '../database.php';
require_once 'validation.php';


$id = $_POST['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

$statement = $pdo->prepare('DELETE FROM tbl_product WHERE ID = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: productsList.php');
