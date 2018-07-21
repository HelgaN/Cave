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
