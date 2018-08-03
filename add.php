<?php
require_once("functions.php");
require_once ("list.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lot = $_POST;

    $required = ["lot-name", "category", "message", "lot-rate", "lot-step", "lot-date"];
    /*$dict = ["title" => "Название", "description" => "Описание", "file" => "Фото"];*/
    $errors = [];
    foreach ($required as $key) {
        if (empty($_POST[$key])) {
            $errors[$key] = "Это поле обязательно для заполнения";
        }
    }

    if(is_numeric($_POST["lot-rate"]) == false) {
        $errors["lot-rate"] = "Можно вводить только цифры";
    }

    if(is_numeric($_POST["lot-step"]) == false) {
        $errors["lot-step"] = "Можно вводить только цифры";
    }

    if($_POST["category"] == "Выберите категорию") {    // протестить
        $errors["category"] = "Необходимо выбрать подходящуб категорию";
    }

    if (isset($_FILES["lot_img"]["name"])) {
        $tmp_name = $_FILES["lot_img"]["tmp_name"];
        $path = $_FILES["lot_img"]["name"];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);   // возвращает mime-тип
        $file_type = finfo_file($finfo, $tmp_name);        // возвращает тип-файла

        if ($file_type != "image/jpeg" && $file_type != "image/png") {
            $errors["file"] = "Загрузите картинку в формате PNG, JPG или JPEG";
        }
        else {
            move_uploaded_file($tmp_name, "img/" . $path);
            $lot["url"] = $path;
        }
    }
    else {
        $errors["file"] = "Вы не загрузили файл";
    }

    if (count($errors)) {
        $page_content = includeTemplate("add-lot", ["lot" => $lot, "form-invalid" => "form--invalid",
            "errors" => $errors/*, 'dict' => $dict*/]);
    }
    else {
        $item = [
            "name" => $lot["lot-name"],
            "category" => $lot["category"],
            "price" => $lot["lot-rate"],
            "url" => "img/".$_FILES["lot_img"]["name"],
            "desc" => $lot["message"]
        ];
        array_push($list, $item);
        $num = count($list);
        $lot_content = includeTemplate("lot", ["list" => $list, "index" => $num]);
        $page_content = includeTemplate("layout", ["category" => $categories, "main_content" => $lot_content]);
    }
}
else {
    $add_lot = includeTemplate("add-lot", []);
    $page_content = includeTemplate("layout", ["category" => $categories, "main_content" => $add_lot, "user_name" => $_SESSION["user"]/*$_SESSION["user"]["name"]*/]);     // изначальная загрузка страницы

}

print $page_content;

