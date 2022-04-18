<?php 
session_start();

if ($_SESSION["usertype"] != "admin") {
    session_destroy();  
    header("location:login.php");
}
