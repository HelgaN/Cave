<?php

require_once "functions.php";
require "list.php";

$name = "lots";
session_start();

$id = $_GET["id"];

$array = array();

if(isset($_COOKIE[$name])) {
    $array = unserialize($_COOKIE[$name]);
}

if($id == NULL) {
    $array[0] ="лось";      //убрать лося
} else {
    array_push($array, $id);
}



 // должен быть массив со значениями id

$expire = time()+60*60*24*30;   // срок действи 30 дней
$path = "/";

setcookie($name, serialize($array), $expire, $path);

if($_GET["id"]) {
    $id_lot = $_GET["id"];
} else {
    $id_lot = count($list);
}

$sql_lot = "SELECT * FROM lots WHERE lot_id ='$id_lot'";
$result_lot = mysqli_query($conn, $sql_lot);
$fetch_lot = mysqli_fetch_assoc($result_lot);

$category = ($categories[($fetch_lot["category_id"]) - 1]);
$title = $fetch_lot["title"];
$img = $fetch_lot["img_path"];
$desc = $fetch_lot["description"];
$price = $fetch_lot["start_price"];    // доработать с учетом ставок
$min_price = $price + $fetch_lot["step"];


$page_lot = includeTemplate("lot", array("list" => $list, "title" => $title, "img" => $img, "category" => $category, "desc" => $desc, "price" => formatNumber($price), "min_price" => formatNumber($min_price)));
$page_content = includeTemplate("layout", array("category" => $categories,"main_content" => $page_lot, "user_name" => $_SESSION["user"]/*$_SESSION["user"]["name"]*/));
print $page_content;


