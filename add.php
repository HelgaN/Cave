<?php
require_once("functions.php");

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

    if((int)$_POST["lot-rate"] !== number) {
        $errors["lot-rate"] = "Можно вводить только цифры";
    }

    if((int)$_POST["lot-step"] !== number) {
        $errors["lot-step"] = "Можно вводить только цифры";
    }

    if (isset($_FILES["lot_img"]["name"])) {
        $tmp_name = $_FILES["lot_img"]["tmp_name"];
        $path = $_FILES["lot_img"]["name"];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);   // возвращает mime-тип
        $file_type = finfo_file($finfo, $tmp_name);        // возвращает тип-файла
        if ($file_type !== "image/jpeg" || $file_type !== "image/png") {
            $errors["file"] = "Загрузите картинку в формате PNG, JPG или JPEG";
        }
        else {
            move_uploaded_file($tmp_name, "uploads/" . $path);
            $lot["path"] = $path;
        }
    }
    else {
        $errors["file"] = "Вы не загрузили файл";
    }

    if (count($errors)) {
        $page_content = includeTemplate("add-lot", ["lot" => $lot, "form-invalid" => "form--invalid",
            "errors" => $errors/*, 'dict' => $dict*/]);
        print $page_content;
    }
    else {
        $page_content = includeTemplate("lot.php", ["lot" => $lot]); //!!! сделать шаблон!!!
    }
}
else {
    $page_content = includeTemplate("add-lot", []);
    print $page_content;
}

/*$layout_content = includeTemplate("layout", [
    "main_content" => $page_content, []
    "categories" => [],
    "title"      => 'GifTube - Добавление гифки'
]);

/*print($layout_content);*/
