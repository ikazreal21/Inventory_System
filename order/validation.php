<?php 
session_start();

// echo '<pre>';
// var_dump($_SESSION);
// echo '<pre>';

if ($_SESSION["usertype"] != "customer") {
    session_destroy();  
    header("location:../login.php");
}
