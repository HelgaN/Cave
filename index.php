<?php

/*$is_auth = (bool) rand(0, 1);
$user_name = 'Константин';
$user_avatar = 'img/user.jpg';*/
$page_title = "Главная";
require "list.php";

function formatNumber($number) {     // дубль в lot.php (template)
    $num = ceil($number);
    if ($num > 1000) {
        $num = number_format($num, 0, ".", " ");
    }

    $num . "&#8399";
    return $num;
};

require "functions.php";

date_default_timezone_set ( "Europe/Moscow");
$rest_time = getRestTime();

$main_content = includeTemplate("index", array("list" => $list, "rest_time" => $rest_time));

$layout = includeTemplate("layout", array("category" => $categories,
    "is_auth" => $is_auth, "user_name" => $user_name,
    "user_avatar" => $user_avatar, "title" => $page_title, "main_content" => $main_content));

print $layout;



















