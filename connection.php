<?php
$conn = mysqli_connect("cave", "root", "", "yeticave");

if (!$conn) {
    print_r("Ошибка подключения " . mysqli_connect_error());
} /*else {
    print ("Соединение установлено");
}*/



