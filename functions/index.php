<pre>
<?php
require "DB.php";
global $conn;
function getCats()
{
    $sql = "SELECT * FROM categories ORDER BY `id` DESC";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $result = $stmt->fetchAll();
}

function getArticlesForNav()
{
    $sql = "SELECT * FROM `articles` ORDER BY `id` DESC limit 3";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $result = $stmt->fetchAll();
}

function articleLimit($offset)
{
    $sql = "SELECT * FROM `articles` ORDER BY `id` DESC limit 2 offset $offset";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$offset]);
    return $stmt->fetchAll();
}

function getArticles()
{
    $sql = "SELECT * FROM `articles` ORDER BY `id` DESC";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $result = $stmt->fetchAll();
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

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$sql = "select count(*) from `articles`";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();


print_r($result[0]);

//var_dump($result);

?>
    </pre>
