<?php
 function includeTemplate($name, $data_array) {
     if (file_exists("templates/" . $name . ".php")) {
         ob_start();
         extract($data_array);
         require "templates/" . $name . ".php";
         return ob_get_clean();
     } else {
         return "";
     }
 };

function getRestTime() {
    $date = date("d/m/Y");
    $date_array = explode("/", $date);
    $next_day = $date_array[0] + 1;
    $next_data = strtotime("$next_day.$date_array[1].$date_array[2]");
    $real_time = time();
    $lost_time = $next_data - $real_time;

    return date("H:i", mktime(0, 0, $lost_time));
};