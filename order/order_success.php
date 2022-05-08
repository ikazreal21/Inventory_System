<?php  
 //login_success.php  
 session_start();  
 if(isset($_SESSION["username"]))  
 {  
    echo "<script>alert('Order Successfully Place Check Your Email for Details'); window.location = 'index.php';</script>";
 }  
 else  
 {  
      header("location:order.php");  
 }  
 ?>  