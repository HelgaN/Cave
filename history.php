<?php
require_once "functions.php";
require_once "list.php"; 

$title = "История просмотров";
if(isset($_COOKIE["lots"])){
    $data = unserialize($_COOKIE["lots"]);
}else{
    $data = false;
}

$history = includeTemplate("all-lots", array("title" => $title, "data" => $data));
$page_content = includeTemplate("layout", ["category" => $categories, "main_content" => $history]);
print $page_content;
