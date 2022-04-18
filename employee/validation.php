<?php 
session_start();

if ($_SESSION["usertype"] != "employee") {
    session_destroy();  
    header("location:login.php");
}
