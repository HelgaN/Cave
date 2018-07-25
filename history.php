<?php
require_once "functions.php";

$title = "История просмотров";
if(isset($_COOKIE["lots"])){
    $data = unserialize($_COOKIE["lots"]);
}else{
    $data = false;
}

$page_content = includeTemplate("all-lots", array("title" => $title, "data" => $data));
print $page_content;
