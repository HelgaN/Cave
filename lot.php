<?php

require_once "functions.php";
require "list.php";

$page_content = includeTemplate("lot", array("list" => $list));
print $page_content;

