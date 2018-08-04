<?php
require_once("functions.php");
require_once ("list.php");
require_once "connection.php";
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

    if (file_exists($_FILES["lot_img"]["name"])) {
        print (($_FILES["lot_img"]["name"]));
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
    }/*
    else {
        $errors["file"] = "Вы не загрузили файл";
    }  Уточнить обязательно ли загружать фото */

    if (count($errors)) {
        $page_errors = includeTemplate("add-lot", ["lot" => $lot, "form-invalid" => "form--invalid",
            "errors" => $errors/*, 'dict' => $dict*/]);
        $page_content = includeTemplate("layout", ["category" => $categories, "main_content" => $page_errors, "user_name" => $_SESSION["user"]/*$_SESSION["user"]["name"]*/]);
    }
    else {
        /*$item = [
            "name" => $lot["lot-name"],
            "category" => $lot["category"],
            "price" => $lot["lot-rate"],
            "url" => "img/".$_FILES["lot_img"]["name"],
            "desc" => $lot["message"]
        ];
        array_push($list, $item);
        $num = count($list);*/
        $id_category = 1;
        while ($category_name = current($categories)) {   // определяет id категории
            if ($category_name == $lot["category"]) {
                break;
            }
            $id_category++;
            next($categories);
        }

        $user_name = $_SESSION["user"];

        $sql_user = "SELECT user_id FROM users WHERE name ='$user_name'";
        $result_user = mysqli_query($conn, $sql_user);
        $value = mysqli_fetch_assoc($result_user);
        $value_id = ($value["user_id"]);

        $name_item = $lot["lot-name"];
        $price_item = $lot["lot-rate"];
        $step_item = $lot["lot-step"];
        $url_item = "img/".$_FILES["lot_img"]["name"];
        $desc_item = $lot["message"];
        $time_start = date("Y-m-j H:i:s");
        $time_end = $lot["lot-date"];
        $null = NULL;

        $sql_lot_add = "INSERT INTO lots(category_id, user_id_seller, user_id_buyer, dt_add, title, description, img_path, start_price, dt_end, step, fav_count)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql_lot_add);
        mysqli_stmt_bind_param($stmt, "sssssssssss", $id_category, $value_id, $null, $time_start, $name_item, $desc_item, $url_item, $price_item, $time_end, $step_item, $null);
        mysqli_stmt_execute($stmt);

        $lot_content = includeTemplate("lot", ["list" => $list, "index" => $num]);
        $page_content = includeTemplate("layout", ["category" => $categories, "main_content" => $lot_content]);
    }
}
else {
    $add_lot = includeTemplate("add-lot", []);
    $page_content = includeTemplate("layout", ["category" => $categories, "main_content" => $add_lot, "user_name" => $_SESSION["user"]/*$_SESSION["user"]["name"]*/]);     // изначальная загрузка страницы

}

print $page_content;

