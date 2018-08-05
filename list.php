<?php

require_once "connection.php";

$sql_l = "SELECT * FROM lots ORDER BY dt_add ASC";/*"SELECT * FROM lots WHERE dt_end is NULL ORDER BY dt_add DESC";*/
$result_l = mysqli_query($conn, $sql_l);
$list = mysqli_fetch_all($result_l, MYSQLI_ASSOC);

/*
$item1 = [
    "name" => "2014 Rossignol District Snowboard",
    "category" => "Доски и лыжи",
    "price" => "10999",
    "url" => "img/lot-1.jpg",
    "desc" => "Легкий маневренный сноуборд,
    готовый дать жару в любом парке, растопив
    снег мощным щелчкоми четкими дугами.
    Стекловолокно Bi-Ax, уложенное в двух направлениях,
    наделяет этот снаряд отличной гибкостью и отзывчивостью,
    а симметричная геометрия в сочетании с классическим прогибом
    кэмбер позволит уверенно держать высокие скорости.
    А если к концу катального дня сил совсем не останется,
    просто посмотрите на Вашу доску и улыбнитесь,
    крутая графика от Шона Кливера еще
    никого не оставляла равнодушным."
];

$item2 = [
    "name" => "DC Ply Mens 2016/2017 Snowboard",
    "category" => "Доски и лыжи",
    "price" => "159999",
    "url" => "img/lot-2.jpg",
    "desc" => ""
];

$item3 = [
    "name" => "Крепления Union Contact Pro 2015 года размер L/XL",
    "category" => "Крепления",
    "price" => "8000",
    "url" => "img/lot-3.jpg",
    "desc" => ""
];

$item4 = [
    "name" => "Ботинки для сноуборда DC Mutiny Charocal",
    "category" => "Ботинки",
    "price" => "10999",
    "url" => "img/lot-4.jpg",
    "desc" => ""
];

$item5 = [
    "name" => "Куртка для сноуборда DC Mutiny Charocal",
    "category" => "Одежда",
    "price" => "7500",
    "url" => "img/lot-5.jpg",
    "desc" => ""
];

$item6 = [
    "name" => "Маска Oakley Canopy",
    "category" => "Разное",
    "price" => "5400",
    "url" => "img/lot-6.jpg",
    "desc" => ""
];

$list = [$item1, $item2, $item3, $item4, $item5, $item6];*/

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];

