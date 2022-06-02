<?php

require_once '../database.php';
require_once '../admin/functions.php';
require_once 'validation.php';

$errors = [];

$title = '';
$desc = '';
$price = '';
$desc = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];
    $date = date('Y-m-d H:i:s');

    if (!$title) {
        $errors[] = 'Product Title is Required';
    }

    if (!$quantity) {
        $errors[] = 'Product Description is Required';
    }

    $total = $quantity * $price;

    if (!is_dir('../inventory/img')) {
        mkdir('../inventory/img');
    }

    if (empty($errors)) {
        $image = $_FILES['image'];
        $imagePath = '';

        if ($image) {
            $imagePath = '../inventory/img/'.randomString(8, 1).'/'.$image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);
        }

        $statement = $pdo->prepare("INSERT INTO tbl_product (PNAME, Pimage, PROD_DESC, PPRICE, PQUAN, PTOTAL, PDATE)
              VALUES (:PNAME, :Pimage, :PROD_DESC,:PPRICE, :PQUAN, :PTOTAL, :PDATE)"
        );

        $statement->bindValue(':PNAME', $title);
        $statement->bindValue(':Pimage', $imagePath);
        $statement->bindValue(':PROD_DESC', $desc);
        $statement->bindValue(':PPRICE', $price);
        $statement->bindValue(':PQUAN', $quantity);
        $statement->bindValue(':PTOTAL', $total);
        $statement->bindValue(':PDATE', $date);
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

    <title>Create Product</title>
  </head>
  <body>
    <h1>Create Product</h1>
    <p>
      <a href="productsList.php" class="btn btn-success">Go back</a>
    </p>
    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
          <div><?php echo $error; ?></div>
        <?php endforeach?>
      </div>
    <?php endif;?>
    <?php if (empty($errors) && !empty($title)): ?>
      <div class="alert alert-success">
          <div>New Product Added</div>
      </div>
    <?php endif;?>
    <form method="POST" action="" enctype="multipart/form-data">
      <div class="form-group mb-3">
        <label class="form-label">Product Img</label>
        <input
          type="file"
          class="form-control"
          name="image"
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
        <label class="form-label">Description</label>
        <textarea
          class="form-control"
          name="desc"
          value="<?php echo $desc; ?>"
          required
        ></textarea>
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Quantity</label>
        <input
          type="number"
          step=".01"
          class="form-control"
          name="quantity"
          value="<?php echo $quantity; ?>"
          required
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
          required
        />
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </body>
</html>
