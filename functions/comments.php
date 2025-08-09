<?php
require "DB.php";
global $conn;
require "jdf.php";
session_start();

function checkCommentEmpty($text)
{
    if (!empty($text)) {
        return true;
    }else{
        return false;
    }
}
function checkLogin()
{
    if (isset($_SESSION['id'])) {
        return true;
    }else{
        return false;
    }
}

function submitComment($comment)
{
    global $conn;
    $article_id = $_GET['id'];
    $user_id = $_SESSION['id'];
    $nowTime = jdate("YmdF");
    $sql = "INSERT INTO `comments` (text, article_id, user_id, created_at, created_at_miladi) VALUES (?, ?, ?, ?, now())";
    $stmt = $conn->prepare($sql);
    $stmt -> execute([$comment, $article_id, $user_id, $nowTime]);
    header("location:comment_success.php?id=".$article_id);
}
function getComments($article_id)
{
    $sql = "SELECT * FROM `comments` WHERE article_id = ? ORDER BY id DESC";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt -> execute([$article_id]);
    return $stmt->fetchAll();
}

function getUserByIdCOM($id)
{
    $sql = "SELECT * FROM users WHERE id = ?";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt -> execute([$id]);
    return $stmt->fetch();
}
//var_dump($_SESSION);