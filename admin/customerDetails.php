<?php

require_once '../database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}


$statement = $pdo->prepare('SELECT * FROM user WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$prod = $statement->fetch(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($prod);
// echo '<pre>';


$errors = [];

$firstname = $prod['firstname'];
$lastname = $prod['lastname'];
$username = $prod['username'];
$phonenumber = $prod['phonenumber'];
$email = $prod['email'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $status = $_POST['status'];

    if (empty($errors)) {
        $statement = $pdo->prepare("UPDATE user set status = :status WHERE id = :id");

        $statement->bindValue(':status', $status);
        $statement->bindValue(':id', $id);
        $statement->execute();

        header('Location: customerList.php');
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

    <title>View User</title>
  </head>
  <body>
    <p>
      <a href="customerList.php" class="btn btn-secondary">Go back</a>
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
        <label class="form-label">First Name</label>
        <input
          type="text"
          class="form-control"
          name="title"
          disabled
          value="<?php echo $firstname; ?>"
        />
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Last Name</label>
        <input
        type="text"
          class="form-control"
          name="title"
          disabled
          value="<?php echo $lastname; ?>"
        />
      </div>
      <div class="form-group mb-3">
        <label class="form-label">Username</label>
        <input
        type="text"
          class="form-control"
          name="title"
          disabled
          value="<?php echo $username; ?>"
        />
      </div>      
      <div class="form-group mb-3">
        <label class="form-label">Phone Number</label>
        <input
          type="number"
          disabled
          value="<?php echo $phonenumber; ?>"
        />
      </div>            
      <div class="form-group mb-3">
        <label class="form-label">Product Price</label>
        <input
          type="email"
          disabled
          value="<?php echo $email; ?>"
        />
      </div>
      <select class="form-select" aria-label="Default select example" name="status">
        <option selected value="active">acitve</option>
        <option value="deactivate">deactivate</option>
      </select>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </body>
</html>
