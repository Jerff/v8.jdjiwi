<?php

chdir(dirname(__FILE__));
$file = basename($_SERVER['REQUEST_URI'], '.php');
$file= "../../_sourse/.cron/{$file}.php";

if(is_file($file)) {
	include($file);
}

?>