<?php
require "DB.php";
global $conn;
require "jdf.php";
//require 'http.php';

function checkRegisterEmpty($name, $email, $password, $passwordConfirm)
{
    if (!empty($name) && $name != ""
        && !empty($email) && $email != ""
        && !empty($password) && $password != ""
        && !empty($passwordConfirm) && $passwordConfirm != "") {
        return true;
    }
}

function checkEditEmpty($name, $password, $passwordConfirm)
{
    if (!empty($name) && $name != ""
        && !empty($password) && $password != ""
        && !empty($passwordConfirm) && $passwordConfirm != "") {
        return true;
    }
}
function checkLoginEmpty($email, $password)
{
    if (!empty($email) && $email != ""
        && !empty($password) && $password != "") {
        return true;
    }
}

function login($email, $password)
{
    $sql = " SELECT * FROM `users` WHERE email = ? ";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user->password)) {
        session_start();
        $_SESSION['email'] = $user->email;
        return true;
    } else {
        return false;
    }
}

function checkPassword($password, $passwordConfirm)
{
    if ($password === $passwordConfirm && strlen($password) >= 4) {
        return true;
    }
}

function checkUniqueUser($email)
{
    $sql = " SELECT * FROM users WHERE email = ? ";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if (!$user) {
        return true;
    }
}

function createNewUser($name, $email, $password, $image)
{
    $sql = " INSERT INTO users (name, email, password, image , created_at, created_at_miladi) VALUES (?, ?, ?, ?, ?, now())";
    $nowTime = jdate("YmdF");
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $email, $hashed_password, $image, $nowTime]);
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
