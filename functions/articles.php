<?php
require "DB.php";
global $conn;
require "jdf.php";
//require 'http.php';

function checkArticleEmpty($title, $body, $category)
{
    if (!empty($title) && $title != ""
        && !empty($body) && $body != ""
        && !empty($category) && $category != ""
        && isset($_FILES)) {
        return true;
    }
}

function checkEditEmpty($title, $body, $image)
{
    if (!empty($title) && $title != ""
        && !empty($body) && $body != ""
        && isset($image)) {
        return true;
    }
}

function getUserIdBySession()
{
    session_start();
    global $conn;
    $sql = " SELECT * FROM `users` WHERE `email` = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['email']]);
    $id = $stmt->fetch();
    return $id->id;
}
function getCatById($id)
{
    global $conn;
    $sql = "SELECT * FROM `categories` where `id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt-> execute([$id]);
    $category = $stmt-> fetch();
    return $category;
}

function getCatsList()
{
    $sql = " SELECT * FROM `categories` ";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}
function getArticles()
{
    $sql = "SELECT * FROM `articles` ORDER BY `id` DESC";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}
function limit_words($string, $word_limit)
{
    $words = explode(" ", $string);
    return implode(" ", array_splice($words, 0, $word_limit));
}
function createNewArticle($title, $body, $image, $keywords, $category)
{
    $sql = " INSERT INTO articles (title, body, image, keywords, user_id , category_id , created_at, created_at_miladi) VALUES (?, ?, ?, ?, ?, ?, ?, now())";
    $nowTime = jdate("YmdF");
    global $conn;
    session_start();
    $id = $_SESSION['id'];
    $stmt = $conn->prepare($sql);
    $stmt->execute([$title, $body, $image, $keywords, $id, $category, $nowTime]);
}

function getUsersList()
{
    $sql = " SELECT * FROM `users` ";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();
    return $users;
}

function deleteArticle($id)
{
    $sql = " DELETE FROM `articles` WHERE id = ? ";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
}

function getArticleById($id)
{
    $sql = " SELECT * FROM `articles` WHERE id = ? ";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return  $stmt->fetch();
}
function getUserById($id)
{
    $sql = "select * from `users` WHERE id = ? ";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function updateArticle($title, $body, $image, $category, $id)
{
    $sql = "UPDATE `articles` SET title = ? , body = ?, image = ?, category_id = ?, updated_at = ? , Updated_at_miladi = now()  WHERE id = ?";
    $nowTime = jdate("YmdF");
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$title, $body, $image , $category, $nowTime, $id]);
}