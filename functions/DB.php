<?php

global $conn;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iman_hashemi_codeyad";

try {
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password , $options);
return $conn;
}catch (PDOException $e){
    echo 'Connection failed'.$e->getMessage();
}