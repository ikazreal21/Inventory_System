<?php

require_once '../database.php';
require_once 'validation.php';

$search = $_GET['search'] ?? '';

if ($search) {
    $statement = $pdo->prepare('SELECT * FROM tbl_orders where orderSerial like :PNAME ORDER BY orderDate');
    $statement->bindValue(':PNAME', "%$search%");
} else {
    $statement = $pdo->prepare('SELECT * FROM tbl_orders ORDER BY orderDate DESC');
}

$statement->execute();
$procdata = $statement->fetchAll(PDO::FETCH_ASSOC);
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
    <h1>Orders</h1>
    <p>
      <a href="index.php" class="btn btn-success">Go Back</a>
    </p>
    <form action="" method="get">
    <div class="input-group mb-3">
      <input
        type="text"
        class="form-control"
        placeholder="Search Order By Serial"
        name="search"
        value="<?php echo $search; ?>"
      />
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
      </div>
    </div>
    </form>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col"># of Products</th>
          <th scope="col">Product Total</th>
          <th scope="col">Order Date</th>
          <th scope="col">Customer Name</th>
          <th scope="col">Serial</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($procdata as $i => $item): ?>
          <tr>
          <td><?php echo $item['Order_ID']; ?></td>
          <td><?php echo $item['NumberofProd']; ?></td>
          <td><?php echo $item['ProdTotal']; ?></td>
          <td><?php echo $item['orderDate']; ?></td>
          <td><?php echo $item['Customer_Name']; ?></td>
          <td><?php echo $item['orderSerial']; ?></td>
          <td>
          <a href="orderdetails.php?id=<?php echo $item['Order_ID']; ?>" class="btn btn-sm btn-primary"> View</a>
          <form style="display: inline-block;" method="POST" action="deleteOrder.php">
              <input type="hidden" name="id" value="<?php echo $item['Order_ID']; ?>">
              <button type="submit" class="btn btn-sm btn-danger"> DELETE</button>
          </form>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>

  </body>
</html>
