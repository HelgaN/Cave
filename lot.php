<?php

require_once "functions.php";
require "list.php";
$name = "lots";

$id = $_GET["id"];

$array = array();

if(isset($_COOKIE[$name])) {
    $array = unserialize($_COOKIE[$name]);
}

if($id == NULL) {
    $array = "";
} else {
    array_push($array, $id);
}



 // должен быть массив со значениями id

$expire = time()+60*60*24*30;   // срок действи 30 дней
$path = "/";

setcookie($name, serialize($array), $expire, $path);

$page_lot = includeTemplate("lot", array("list" => $list));
$page_content = includeTemplate("layout", array("category" => $categories,"main_content" => $page_lot));
print $page_content;

