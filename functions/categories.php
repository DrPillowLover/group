<?php
require "DB.php";
global $conn;
require "jdf.php";
//require 'http.php';



function checkEditEmpty($cat)
{
    if (!empty($cat) && $cat != "") {
        return true;
    }
}


function checkUniqueCat($cat)
{
    $sql = " SELECT * FROM `categories` WHERE title = ? ";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$cat]);
    $user = $stmt->fetch();
    if (!$user) {
        return true;
    }
}

function createNewCat($title)
{
    $sql = " INSERT INTO `categories` (title, created_at, created_at_miladi) VALUES (?, ?, now())";
    $nowTime = jdate("YmdF");
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$title, $nowTime]);
}

function getCatsList()
{
    $sql = " SELECT * FROM `categories` ";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function deleteCat($id)
{
    $sql = " DELETE FROM `categories` WHERE id = ? ";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
}

function getCatById($id)
{
    $sql = " SELECT * FROM `categories` WHERE id = ? ";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();

}

function updateCat($id, $title)
{
    $sql = " UPDATE `categories` SET `title` = ?, `updated_at` = ?, `updated_at_miladi` = now() WHERE id = ? ";
    global $conn;
    $nowTime = jdate("YmdF");
    $stmt = $conn->prepare($sql);
    $stmt->execute([$title, $nowTime, $id]);
}
