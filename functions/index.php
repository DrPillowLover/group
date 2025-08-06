
<?php
require "DB.php";
global $conn;
function getCats()
{
    $sql = "SELECT * FROM categories ORDER BY `id` DESC";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getArticlesForNav()
{
    $sql = "SELECT * FROM `articles` ORDER BY `id` DESC limit 3";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}


function getArticles()
{
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
//    1/2
    global $results_per_page;
    $start_from = ($page - 1) * $results_per_page;
    $sql = "SELECT * FROM `articles` ORDER BY `id` DESC LIMIT $start_from, $results_per_page";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function numberOfPages()
{
//    2/2
    global $results_per_page;
    global $conn;
    $sql = "SELECT * FROM `articles`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $numberOfRow = $stmt->rowCount();
    return ceil($numberOfRow / $results_per_page);
}

function getCatTitle($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `categories` WHERE `id` = ?");
    $stmt->execute([$id]);
    $title = $stmt->fetch();
    return $title->title;
}

function limit_words($string, $word_limit)
{
    $words = explode(" ", $string);
    return implode(" ", array_splice($words, 0, $word_limit));
}

function getArticleById($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `articles` WHERE `id` = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function countArticles($category_id)
{
    $sql = "SELECT COUNT(*) FROM `articles` WHERE `category_id` = ?";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$category_id]);
    return $stmt->fetchColumn();
}




