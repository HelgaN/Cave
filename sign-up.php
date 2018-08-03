<?php

require "functions.php";
require "list.php";
require_once "connection.php";

$page_content = includeTemplate("sign-up", []);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $form = $_POST;
    $require = ["email", "password", "name", "message"];
    $errors = [];

    foreach ($require as $key) {
        if (empty($form[$key])) {
            $errors[$key] = "Это поле обязательно для заполнения";
        }
    }

    $email = $form["email"];
    $name = $form["name"];
    $password = $form["password"];

    if(isset($email)) {
        $sql = "SELECT email FROM users";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Неверно указан email";
        } else {
            foreach ($rows as $row) {

                if($row["email"] == $email) {
                    $errors["email"] = "Пользователь с таким email уже существует";
                }
            }
        }
    }

    if (isset($_FILES["avatar"]["name"])) {
        $tmp_name = $_FILES["avatar"]["tmp_name"];
        $path = $_FILES["avatar"]["name"];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);   // возвращает mime-тип
        $file_type = finfo_file($finfo, $tmp_name);        // возвращает тип-файла

        if ($file_type != "image/jpeg" && $file_type != "image/png") {
            $errors["file"] = "Загрузите картинку в формате PNG, JPG или JPEG";
        }
        else {
            move_uploaded_file($tmp_name, "img/" . $path);
           /* $lot["url"] = $path;*/
        }
    }

    if (count($errors)) {
        $page_content = includeTemplate("sign-up", ["form" => $form, "errors" => $errors, "form-invalid" =>  "form--invalid"]);
    }
    else {
        $sql_nu = "INSERT INTO users(user_lots, user_bets, dt_reg, email, name, password, avatar_path)
 VALUES (NULL, NULL, now(), \"$email\", \"$name\", \"$password\", \"$path\")";
        $result_nu = mysqli_query($conn, $sql_nu);
        if(!$result_nu) {
            $error = mysqli_error($conn); // возвращает последнюю ошибку //
            print ("Ошибка MySQL: " . $error);
        }
        header("Location: ../index.php");
        exit();
    }

}

$layout_content = includeTemplate("layout", [
    "main_content"    => $page_content,
    "category" => $categories,
    "title"    => "Регистрация аккаунта"
]);

print $layout_content;

