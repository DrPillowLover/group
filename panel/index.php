<?php
require "../functions/users.php";
require "../functions/http.php";
require "../functions/DB.php";
session_start();
if (!isset( $_SESSION['id']) ){
    header("location:../auth/login.php");
}
require "./layout/head.php";
require "./layout/navigation.php";
require "./layout/header.php";
require "./layout/main.php";
require "./layout/footer.php";
?>