<?php

require_once '../database.php';
require_once '../admin/functions.php';
require_once 'validation.php';
require_once '../mail.php';

$statement = $pdo->prepare('SELECT * FROM tbl_cart where CUSTOMER_NAME = :username ORDER BY PROD_DATE DESC');

$statement->bindValue(':username', $_SESSION["username"]);
$statement->execute();
$procdata = $statement->fetchAll(PDO::FETCH_ASSOC);

$checker = '';
if (!$procdata) {
  $checker = 'disabled';
}

// echo '<pre>';
// var_dump($procdata);
// echo '<pre>';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $itemArr = [];
    $quantity = 0;
    $productTotal =   0;
    foreach ($procdata as $i => $products) {
      ++$i;
      $quantity += $i;
      $itemArr[] = $products['PROD_ID'];
      $productTotal += $products['PROD_TOTAL'];


      $statement = $pdo->prepare('DELETE FROM tbl_cart WHERE PROD_ID = :id');
      $statement->bindValue(':id', $products['PROD_ID']);
      $statement->execute();
    }

    $itemArrs = json_encode($itemArr);
    $customername = $_SESSION["username"];
    $orderStatus = 'for_approval';
    $date = date('Y-m-d H:i:s');
    $serial = randomString(8, 2);

    

    if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO tbl_orders (Customer_Name, NumberofProd, ProdTotal, Order_Status, orderDate, orderArray, orderSerial)
          VALUES (:CustomerName, :NumberProd, :ProdTotal, :orderstatus, :orderDate, :orderArray, :orderSerial)"
        );

        $statement->bindValue(':CustomerName', $customername);
        $statement->bindValue(':NumberProd', $quantity);
        $statement->bindValue(':ProdTotal', $productTotal);
        $statement->bindValue(':orderstatus', $orderStatus);
        $statement->bindValue(':orderDate', $date);
        $statement->bindValue(':orderArray', $itemArrs);
        $statement->bindValue(':orderSerial', $serial);
        $statement->execute();

        $mail->addAddress($_SESSION['email'], $customername);
        $mail->isHTML(true); 
        $mail->Subject = 'Order Succesfully Placed';
        $mail->Body    = 'Your Order is not process with a serial <b>'.$serial.'</b><br>
        you can continue shopping at Navitopia<br>';
        // $mail->Body += 'Happy Shopping';
        if (!$mail->send()) {
          echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
          echo 'Message sent!';
        }

        header("location:order_success.php");
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

    <title>Navitopia</title>
  </head>
  <body>
    <h1>Checkout</h1>
    <p>
      <a href="index.php" class="btn btn-success">Go Back</a>
    </p>
    <form style="display: inline-block;" method="POST">
      <button type="submit" class="btn btn-sm btn-success" <?php echo $checker ?> >Place Order</button>
    </form>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Image</th>
          <th scope="col">Name</th>
          <th scope="col">Quantity</th>
          <th scope="col">Total</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($procdata as $i => $item): ?>
          <tr>
          <th scope="row"><?php echo ++$i; ?></th>
          <td>
              <img src="<?php echo $item['PROD_IMAGE']; ?>"  width="300" height="200">
          </td>
          <td><?php echo $item['PROD_NAME']; ?></td>
          <td><?php echo $item['PROD_QUANT']; ?></td>
          <td><?php echo $item['PROD_TOTAL']; ?></td>
          <td>
            <form style="display: inline-block;" method="POST" action="delete.php">
              <input type="hidden" name="id" value="<?php echo $item['PROD_ID']; ?>">
              <button type="submit" class="btn btn-sm btn-danger"> DELETE</button>
            </form>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>

  </body>
</html>
