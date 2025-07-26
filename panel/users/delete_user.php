<?php
require "../../functions/http.php";

require "../../functions/users.php";
require "../../functions/DB.php";
global $conn;

$getID = $_GET['id'];

deleteUser($getID);
header('Location: user_list.php');