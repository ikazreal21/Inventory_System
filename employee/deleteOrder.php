<?php

require_once '../database.php';
require_once 'validation.php';

$id = $_POST['id'] ?? null;

if (!$id) {
    header('Location: orderTracking.php');
    exit;
}

$statement = $pdo->prepare('DELETE FROM tbl_orders WHERE Order_ID = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: orderTracking.php');

