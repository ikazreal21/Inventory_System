<?php

require_once '../database.php';
require_once 'validation.php';

$id = $_POST['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

$statement = $pdo->prepare('DELETE FROM tbl_cart WHERE PROD_ID = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: index.php');

