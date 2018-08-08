<?php

require_once "functions.php";
require_once "list.php";
require_once "connection.php";

$search = $_GET["search"] || "";   // возвращает true или false

$lots_s = [];

 if ($search) {
    $sql_s = "SELECT lot_id, categories.name, title, start_price, img_path, dt_end FROM lots
JOIN categories ON lots.category_id = categories.category_id
 
 WHERE MATCH(title, description) AGAINST(?)";

    $stmt_s = mysqli_prepare($conn, $sql_s);
     mysqli_stmt_bind_param($stmt_s, "s", $_GET["search"]);

    mysqli_stmt_execute($stmt_s);
    $result_s = mysqli_stmt_get_result($stmt_s);

    $lots_s = mysqli_fetch_all($result_s, MYSQLI_ASSOC);
    }

    $rest_time = getRestTime();
    $search_text = $_GET["search"];

$page_search = includeTemplate("search", ["lots" => $lots_s, "rest_time" => $rest_time, "search" => $search_text]);

$page_content = includeTemplate("layout", array("category" => $categories,"main_content" => $page_search, "user_name" => $_SESSION["user"]/*$_SESSION["user"]["name"]*/));
print $page_content;
