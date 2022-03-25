<?php
session_start();
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['firstname'] != "" || $_POST['username'] != "" || $_POST['password'] != "") {
        try {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $phonenumber = $_POST['phonenumber'];
            $email = $_POST['email'];
            $usertype = 'user';
            $status = 'active';
            $statement = $pdo->prepare("INSERT INTO user (firstname, lastname, phonenumber,
            username, email, password, usertype, status)
            VALUES (:firstname, :lastname, :phonenumber, :username, :email, :password, :usertype, :status)"
            );

            $statement->bindValue(':firstname', $firstname);
            $statement->bindValue(':lastname', $lastname);
            $statement->bindValue(':phonenumber', $phonenumber);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':usertype', $usertype);
            $statement->bindValue(':status', $status);
            $statement->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $_SESSION['message'] = array("text" => "User successfully created.", "alert" => "info");
        $conn = null;
        header('location:login.php');
    } else {
        echo "
				<script>alert('Please fill up the required field!')</script>
				<script>window.location = 'registration.php'</script>
			";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
	</head>
<body>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">Registration</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<form action="" method="POST">
				<hr style="border-top:1px groovy #000;">
				<div class="form-group">
					<label>Firstname</label>
					<input type="text" class="form-control" name="firstname" />
				</div>
				<div class="form-group">
					<label>Lastname</label>
					<input type="text" class="form-control" name="lastname" />
				</div>
                <div class="form-group">
					<label>Phone Number</label>
					<input type="number" class="form-control" name="phonenumber" />
				</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name="username" />
				</div>
                <div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" />
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="password" />
				</div>
				<br />
				<div class="form-group">
					<button class="btn btn-primary form-control" name="register">Register</button>
				</div>
				<a href="login.php">Login</a>
			</form>
		</div>
	</div>
</body>
</html>
