<?php
require_once "functions.php";
require_once "userdata.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $form = $_POST;
    $require = ["email", "password"];
    $errors = [];

    foreach ($require as $key) {
        if (empty($_POST[$key])) {
            $errors[$key] = "Это поле обязательно для заполнения";
        }
    }

    if (!count($errors) and $user = searchUserByEmail($form["email"], $users)) {
        if (password_verify($form["password"], $user["password"])) {
            $_SESSION["user"] = $user;
        }
        else {
            $errors["password"] = "Вы ввели неверный пароль";
        }
    }
    else {
        $errors["email"] = "Такой пользователь не найден";
    }

    if (count($errors)) {
        $page_content = include_template("login", ["form" => $form, "errors" => $errors]);
    }
    else {
        header("Location: /index.php");
        exit();
    }
}/*
else {
    if (isset($_SESSION["user"])) {
        $page_content = include_template("welcome.php", ["username" => $_SESSION["user"]["name"]]);
    }
    else {
        $page_content = include_template("enter.php", []);
    }
}

$layout_content = include_template('layout.php', [
    'content'    => $page_content,
    'categories' => [],
    'title'      => 'GifTube'
]);

print($layout_content);

}

$content = includeTemplate("login", []);
print $content;*/
