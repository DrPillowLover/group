<?php
require "../../functions/http.php";

require "../../functions/articles.php";
require "../../functions/DB.php";
global $conn;

$getID = $_GET['id'];

deleteArticle($getID);
header('Location: article_list.php');