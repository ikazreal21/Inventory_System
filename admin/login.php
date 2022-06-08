<?php
session_start();

require_once '../database.php';

if(ISSET($_SESSION["username"])){
    header('location:index.php');
  }

try
{
    if (isset($_POST["login"])) {
        if (empty($_POST["username"]) || empty($_POST["password"])) {
            $message = '<label>All fields are required</label>';
        } else {
            $query = "SELECT * FROM user WHERE username = :username AND password = :password AND status = 'active' AND usertype = 'admin'";
            $statement = $pdo->prepare($query);
            $statement->execute(
                array(
                    'username' => $_POST["username"],
                    'password' => $_POST["password"],
                )
            );
            $count = $statement->rowCount();
            if ($count > 0) {
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["usertype"] = 'admin';
                header("location:login_success.php");
            } else {
                $message = '<label>Wrong Data or Your Account is Deactivated</label>';
            }
        }
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
?>
 <!DOCTYPE html>
 <html>
      <head>
           <title>Navitopia</title>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      </head>
      <body>
           <br />
           <div class="container" style="width:500px;">
                <?php
if (isset($message)) {
    echo '<label class="text-danger">' . $message . '</label>';
}
?>
                <h3 align="">Navitopia Store Admin Pannel</h3><br />
                <form method="post">
                     <label>Username</label>
                     <input type="text" name="username" class="form-control" />
                     <br />
                     <label>Password</label>
                     <input type="password" name="password" class="form-control" />
                     <br />
                     <input type="submit" name="login" class="btn btn-info" value="Login" />
                </form>
                <a href="index.php">Admin Page</a>
           </div>
           <br />
      </body>
 </html>