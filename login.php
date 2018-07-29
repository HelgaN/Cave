<?php
require_once "functions.php";
require_once "list.php";
require_once "userdata.php";

$page_content = includeTemplate("login", []);

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $form = $_POST;
    $require = ["email", "password"];
    $errors = [];

    foreach ($require as $key) {
        if (empty($form[$key])) {
            $errors[$key] = "Это поле обязательно для заполнения";
        }
    }

    $user = searchUserByEmail($form["email"], $users);

    if (!count($errors) && $user) {

        if (password_verify($form["password"], $user["password"]) /*$form["password"] == $user["password"]*/) {
            $_SESSION["user"] = $user;     //!!! авторизация ломает history/lot
        }
        else {
            $errors["password"] = "Вы ввели неверный пароль";
        }
    }
    else {
        if($form["email"]) {
            $errors["email"] = "Такой пользователь не найден";
        }
    }

    if (count($errors)) {
        $page_content = includeTemplate("login", ["form" => $form, "errors" => $errors, "form-invalid" =>  "form--invalid"]);
      }
        else {
       header("Location: ../index.php");
       exit();
      }
    }
else {
    if (isset($_SESSION["user"])) {
        $page_content = includeTemplate("index", []);
    }
    else {
        $page_content = includeTemplate("login", []);
    }
}

$layout_content = includeTemplate("layout", [
    "main_content"    => $page_content,
    "category" => $categories,
    "title"    => "Главная"
]);
/*
unset($_SESSION["user"]);
session_destroy();
*/
print $layout_content;




