<?php

require_once '../database.php';
require_once 'validation.php';

$statement = $pdo->prepare('SELECT * FROM tbl_cart where CUSTOMER_NAME = :username ORDER BY PROD_DATE DESC');

$statement->bindValue(':username', $_SESSION["username"]);
$statement->execute();
$procdata = $statement->fetchAll(PDO::FETCH_ASSOC);

$checker = '';
if (!$procdata) {
  $checker = 'disabled';
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
    <h1>Cart</h1>
    <p>
      <a href="index.php" class="btn btn-success">Go Back</a>
    </p>
    <p>
        <a href="order.php" class="btn btn-success" <?php echo $checker ?> >Checkout</a>
    </p>
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
              <input type="hidden" name="id" value="<?php echo $item['CART_ID']; ?>">
              <button type="submit" class="btn btn-sm btn-danger"> DELETE</button>
            </form>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>

  </body>
</html>
