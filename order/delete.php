<?php

require_once '../database.php';
require_once 'validation.php';

$id = $_POST['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

$statement = $pdo->prepare('SELECT * FROM tbl_cart WHERE CART_ID = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$prod2 = $statement->fetch(PDO::FETCH_ASSOC);
$quantity2 = $prod2["PROD_QUANT"];
$product_id = $prod2["Product_id"];


$statement = $pdo->prepare('SELECT * FROM tbl_product WHERE ID = :id');
$statement->bindValue(':id', $product_id);
$statement->execute();
$prod = $statement->fetch(PDO::FETCH_ASSOC);
$quantity = $prod["PQUAN"];

$updatequantity = '';
$updatequantity = $quantity2 + $quantity;


$statement = $pdo->prepare('UPDATE tbl_product set PQUAN = :PQUAN WHERE ID = :id');
$statement->bindValue(':PQUAN', $updatequantity);
$statement->bindValue(':id', $product_id);
$statement->execute();

$statement = $pdo->prepare('DELETE FROM tbl_cart WHERE CART_ID = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: index.php');

