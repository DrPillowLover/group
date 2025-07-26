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
function getArticleAuthor($user_id){
    global $conn;
    $sql = " SELECT * FROM `users` WHERE 'id' = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetch();
}

function getArticles()
{
    $sql = "SELECT * FROM `articles` ";
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
function createNewArticle($title, $body, $image, $category)
{
    $sql = " INSERT INTO articles (title, body, image, user_id , category_id , created_at, created_at_miladi) VALUES (?, ?, ?, ?, ?, ?, now())";
    $nowTime = jdate("YmdF");
    global $conn;
    $id = getUserIdBySession();
    $stmt = $conn->prepare($sql);
    $stmt->execute([$title, $body, $image, $id, $category, $nowTime]);
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

function deleteUser($id)
{
    $sql = " DELETE FROM `users` WHERE id = ? ";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
}

function getUserById($id)
{
    $sql = " SELECT * FROM `users` WHERE id = ? ";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $user = $stmt->fetch();
    return $user;
}

function updateUser($id, $name, $password, $image)
{
    $sql = " UPDATE `users` SET `name` = ?, `password` = ?, `image` = ?, `updated_at` = ?, `updated_at_miladi` = now() WHERE id = ? ";
    global $conn;
    $nowTime = jdate("YmdF");
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $hashed_password, $image, $nowTime, $id]);


}
