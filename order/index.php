<?php

require_once '../database.php';
require_once 'validation.php';

$search = $_GET['search'] ?? '';

if ($search) {
    $statement = $pdo->prepare('SELECT * FROM tbl_product WHERE PNAME like :PNAME ORDER BY PDATE DESC');
    $statement->bindValue(':PNAME', "%$search%");
} else {
    $statement = $pdo->prepare('SELECT * FROM tbl_product ORDER BY PDATE DESC');
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
    <h1>Products</h1>
    <p>
      <a href="viewcart.php" class="btn btn-success">View Cart</a>
    </p>
    <p>
      <a href="../logout.php" class="btn btn-info">Logout</a>
    </p>
    <form action="" method="get">
    <div class="input-group mb-3">
      <input
        type="text"
        class="form-control"
        placeholder="Search Product"
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
          <th scope="col">Image</th>
          <th scope="col">Name</th>
          <th scope="col">Price</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($procdata as $i => $item): ?>
          <tr>
          <th scope="row"><?php echo ++$i; ?></th>
          <td>
              <img src="<?php echo $item['Pimage']; ?>"  width="300" height="200">
          </td>
          <td><?php echo $item['PNAME']; ?></td>
          <td><?php echo $item['PPRICE']; ?></td>
          <td>
            <a href="cart.php?id=<?php echo $item['ID']; ?>" class="btn btn-sm btn-success"> Add to Cart</a>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </body>
</html>
