<?php

require_once '../database.php';

$search = $_GET['search'] ?? '';

if ($search) {
    $statement = $pdo->prepare('SELECT * FROM user WHERE firstname like :firstname ORDER BY id DESC');
    $statement->bindValue(':firstname', "%$search%");
} else {
    $statement = $pdo->prepare('SELECT * FROM user ORDER BY id DESC');
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
    <h1>Users</h1>
    <form action="" method="get">
    <div class="input-group mb-3">
      <input
        type="text"
        class="form-control"
        placeholder="Search User"
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
          <th scope="col">FirstName</th>
          <th scope="col">LastName</th>
          <th scope="col">Phone Number</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
          <th scope="col">User Type</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($procdata as $i => $item): ?>
          <tr>
          <th scope="row"><?php echo ++$i; ?></th>
          <td><?php echo $item['firstname']; ?></td>
          <td><?php echo $item['lastname']; ?></td>
          <td><?php echo $item['phonenumber']; ?></td>
          <td><?php echo $item['username']; ?></td>
          <td><?php echo $item['email']; ?></td>
          <td><?php echo $item['status']; ?></td>
          <td><?php echo $item['usertype']; ?></td>
          <td>
            <a href="customerDetails.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-success"> View User</a>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </body>
</html>

