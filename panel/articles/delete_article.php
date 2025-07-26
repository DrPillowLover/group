<?php
require "../../functions/http.php";

require "../../functions/categories.php";
require "../../functions/DB.php";
global $conn;

$getID = $_GET['id'];

deleteCat($getID);
header('Location: category_list.php');