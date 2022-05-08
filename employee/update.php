<?php

require_once '../database.php';
require_once '../admin/functions.php';
require_once 'validation.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: productsList.php');
    exit;
}

$statement = $pdo->prepare('SELECT * FROM tbl_product WHERE ID = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$prod = $statement->fetch(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($prod);
// echo '<pre>';

$errors = [];

$title = $prod['PNAME'];
$quantity = $prod['PQUAN'];
$price = $prod['PPRICE'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    if (!is_dir('../inventory/img')) {
        mkdir('../inventory/img');
    }

    if (!$title) {
        $errors[] = 'Product Title is Required';
    }

    if (!$quantity) {
        $errors[] = 'Product Quantity is Required';
    }

    $total = $quantity * $price;

    if (empty($errors)) {
        $image = $_FILES['image'] ?? null;
        $imagePath = $prod['Pimage'];

        if ($prod['Pimage']) {
            unlink($prod['Pimage']);
        }

        if ($image && $image['tmp_name']) {
            $imagePath = '../inventory/img/' . randomString(8, 1) . '/' . $image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);
        }
        $statement = $pdo->prepare("UPDATE tbl_product set PNAME = :PNAME, Pimage = :Pimage,
        PPRICE = :PPRICE, PQUAN = :PQUAN, PTOTAL = :PTOTAL WHERE ID = :id");

        $statement->bindValue(':PNAME', $title);
        $statement->bindValue(':Pimage', $imagePath);
        $statement->bindValue(':PPRICE', $price);
        $statement->bindValue(':PQUAN', $quantity);
        $statement->bindValue(':PTOTAL', $total);
        $statement->bindValue(':id', $id);
        $statement->execute();

        header('Location: productsList.php');
    }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />

    <title>Update Product</title>
  </head>
  <body>
    <h1>Update Product <?php echo $prod['PNAME']; ?></h1>
    <p>
      <a href="productsList.php" class="btn btn-secondary">Go back</a>
    </p>
    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
          <div><?php echo $error; ?></div>
        <?php endforeach?>
      </div>
    <?php endif;?>
    <form method="POST" action="" enctype="multipart/form-data">
      <div class="form-group mb-3">
        <label class="form-label">Product Image</label>
        <input
          type="file"
          class="form-control"
          name="image"
          value="<?php echo $prod['Pimage']; ?>"
        />
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Product Name</label>
        <input
          type="text"
          class="form-control"
          name="title"
          value="<?php echo $title; ?>"
        />
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Product Quantity</label>
        <input
          type="number"
          step=".01"
          class="form-control"
          name="quantity"
          value="<?php echo $quantity; ?>"
        />
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Product Price</label>
        <input
          type="number"
          step=".01"
          class="form-control"
          name="price"
          value="<?php echo $price; ?>"
        />
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </body>
</html>
