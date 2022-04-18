<?php 
session_start();

if ($_SESSION["usertype"] != "customer") {
    session_destroy();  
    header("location:../login.php");
}
