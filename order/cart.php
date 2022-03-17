<?php
require_once '../database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
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
$price = $prod['PPRICE'];
$image = $prod['Pimage'];
$total = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = $_POST['quantity'];
    $date = date('Y-m-d H:i:s');

    $total = $quantity * $price;

    if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO tbl_cart (PROD_IMAGE, CUSTOMER_NAME, PROD_NAME,
            PROD_PRICE, PROD_QUANT, PROD_DATE, PROD_TOTAL, PROD_STATUS)
            VALUES (:PIMAGE, :CUSTOMER, :PNAME, :PPRICE, :PQUAN, :PDATE, :PTOTAL, :PROD_STATUS)"
        );

        $statement->bindValue(':PIMAGE', $image);
        $statement->bindValue(':CUSTOMER', '');
        $statement->bindValue(':PNAME', $title);
        $statement->bindValue(':PPRICE', $price);
        $statement->bindValue(':PQUAN', $quantity);
        $statement->bindValue(':PDATE', $date);
        $statement->bindValue(':PTOTAL', $total);
        $statement->bindValue(':PROD_STATUS', 'Cart');
        $statement->execute();
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

    <title>Add to Cart</title>
  </head>
  <body>
    <p>
        <a href="index.php" class="btn btn-success">Go back</a>
    </p>
    <h1><?php echo $prod['PNAME']; ?></h1>
    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
          <div><?php echo $error; ?></div>
        <?php endforeach?>
      </div>
    <?php endif;?>
    <?php if (empty($errors) && !empty($total)): ?>
      <div class="alert alert-success">
          <div>Added to Cart</div>
      </div>
    <?php endif;?>
    <form method="POST" action="" enctype="multipart/form-data">
      <div class="form-group mb-3">
        <?php if ($prod['Pimage']): ?>
        <img src="<?php echo $prod['Pimage'] ?>" class="product-img-view">
        <?php endif; ?>
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Product Name</label>
        <input
          type="text"
          class="form-control"
          name="title"
          value="<?php echo $title; ?>"
          disabled
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
          disabled
        />
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Quantity</label>
        <input
          type="number"
          step=".01"
          class="form-control"
          name="quantity"
        />
      </div>
      <button type="submit" class="btn btn-primary">Add to Cart</button>
    </form>
  </body>
</html>




