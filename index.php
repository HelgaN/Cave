<?php
session_start();

$user_name = $_SESSION["user"];/*$_SESSION["user"]["name"];*/

if(isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    $_SESSION["message"] = null;
}

/*$is_auth = (bool) rand(0, 1);
$user_name = 'Константин';
$user_avatar = 'img/user.jpg';*/
$page_title = "Главная";
require "list.php";
require "functions.php";

date_default_timezone_set ( "Europe/Moscow");
$rest_time = getRestTime();

$main_content = includeTemplate("index", array("list" => $list, "rest_time" => $rest_time, "categories" => $categories));

$layout = includeTemplate("layout", array("category" => $categories,
    "is_auth" => $is_auth, "user_name" => $user_name,
    "user_avatar" => $user_avatar, "title" => $page_title, "main_content" => $main_content, "message" => $message));

print $layout;























