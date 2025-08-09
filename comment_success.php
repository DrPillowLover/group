<?php
//header('Content-Type: text/html; charset=utf-8');
//exit('<meta http-equiv="Refresh" content="0; url="currentPage.php">');
//header('location:single.php?id='.$_GET['id']);



require './functions/DB.php';
global $conn;
$sql = " SELECT * FROM `articles` ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
header("Location:single.php?id=".$_GET['id']);

