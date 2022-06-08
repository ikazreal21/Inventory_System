<?php

require_once '../database.php';
require_once '../admin/functions.php';
require_once 'validation.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: productsList.php');
    exit;
}

$statement = $pdo->prepare('SELECT * FROM tbl_orders WHERE Order_ID = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$prod = $statement->fetch(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($prod);
// echo '<pre>';

$errors = [];

$orderid = $prod['Order_ID'];
$customername = $prod['Customer_Name'];
$numofprod = $prod['NumberofProd'];
$orderStatus = $prod['Order_Status'];
$orderSerial = $prod['orderSerial'];
$total = $prod['ProdTotal'];
$orderArr = json_decode($prod['orderArray']);
$prodDetial = [];

// echo '<pre>';
// var_dump($orderArr);
// echo '<pre>';


foreach ($orderArr as $i => $products) {
    $statement = $pdo->prepare('SELECT * FROM tbl_product WHERE ID = :id');
    $statement->bindValue(':id', $products);
    $statement->execute();
    $productdetail = $statement->fetch(PDO::FETCH_ASSOC);

    $prodDetial[] = $productdetail;
  }
    // echo '<pre>';
    // var_dump($prodDetial);
    // echo '<pre>';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
      $status = $_POST['order_status'];
      if (empty($errors)) {
        $statement = $pdo->prepare("UPDATE tbl_orders set Order_Status = :OrderStatus WHERE Order_ID = :id");

        $statement->bindValue(':OrderStatus', $status);
        $statement->bindValue(':id', $id);
        $statement->execute();

        header('Location: orderTracking.php');
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

    <title>Order View</title>
  </head>
  <body>
    <p>
      <a href="orderTracking.php" class="btn btn-secondary">Go back</a>
    </p>
    <h6>Order ID:  <?php echo $orderid; ?></h6>
    <h6>Order Number of Products:  <?php echo $numofprod; ?></h6>
    <?php if ($orderStatus == 'for_approval'): ?>
      <h6>Order Status: For Approval</h6>
    <?php endif;?>
    <?php if ($orderStatus == 'processing'): ?>
      <h6>Order Status: Processing</h6>
    <?php endif;?>
    <?php if ($orderStatus == 'Delivered'): ?>
      <h6>Order Status: Delivered</h6>
    <?php endif;?>
    <h6>Product Total: <?php echo $total; ?></h6>
    <h6>Order Serial: <?php echo $orderSerial; ?></h6>
    <h6>Update: </h6>
    <div style="width:200px; margin:6px;">
      <form action="" method="POST">
      <select class="form-select form-select-sm mb-2" aria-label=".form-select-sm example" name="order_status">
					<option selected value="for_approval">For Approval</option>
					<option value="processing">Processing</option>
					<option value="delivered">Delivered</option>
			</select>
      <div class="form-group">
        <button class="btn btn-primary form-control btn-sm" name="update">Update</button>
      </div>
      </form>
    </div>
    <h4>Product List:</h3>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Product Image</th>
          <th scope="col">Product Name</th>
          <th scope="col">Price</th>
          <th scope="col">Order Date</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($prodDetial as $i => $item): ?>
          <tr>
          <th scope="row"><?php echo ++$i; ?></th>
          <td>
              <img src="<?php echo $item['Pimage']; ?>"  width="300" height="200">
          </td>
          <td><?php echo $item['PNAME']; ?></td>
          <td><?php echo $item['PPRICE']; ?></td>
          <td><?php echo $item['PDATE']; ?></td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </body>
</html>
