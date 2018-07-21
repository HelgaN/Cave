<?php

$item1 = [
    "name" => "2014 Rossignol District Snowboard",
    "category" => "Доски и лыжи",
    "price" => "10999",
    "url" => "img/lot-1.jpg"
];

$item2 = [
    "name" => "DC Ply Mens 2016/2017 Snowboard",
    "category" => "Доски и лыжи",
    "price" => "159999",
    "url" => "img/lot-2.jpg"
];

$item3 = [
    "name" => "Крепления Union Contact Pro 2015 года размер L/XL",
    "category" => "Крепления",
    "price" => "8000",
    "url" => "img/lot-3.jpg"
];

$item4 = [
    "name" => "Ботинки для сноуборда DC Mutiny Charocal",
    "category" => "Ботинки",
    "price" => "10999",
    "url" => "img/lot-4.jpg"
];

$item5 = [
    "name" => "Куртка для сноуборда DC Mutiny Charocal",
    "category" => "Одежда",
    "price" => "7500",
    "url" => "img/lot-5.jpg"
];

$item6 = [
    "name" => "Маска Oakley Canopy",
    "category" => "Разное",
    "price" => "5400",
    "url" => "img/lot-6.jpg"
];

$list = [$item1, $item2, $item3, $item4, $item5, $item6];
$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];


function formatNumber($number) {
    $num = ceil($number);
    if ($num > 1000) {
        $num = number_format($num, 0, ".", " ");
    }

    $num . "&#8399";
    return $num;
}

require "functions.php";

$main_content = includeTemplate("index", $list, []);
$layout = includeTemplate("layout", $categories, $main_content);

print $layout;







