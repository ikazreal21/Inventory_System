<?php  
 //login_success.php  
 session_start();  
 if(isset($_SESSION["username"]))  
 {  
    echo "<script>alert('Login Successfully'); window.location = 'index.php';</script>";
 }  
 else  
 {  
      header("location:login.php");  
 }  
 ?>  