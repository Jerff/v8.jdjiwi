<?php

$old = getcwd();

chdir(dirname(__FILE__));
$path = require('../dev.southmoon.ru.sourse/adminAccessWysiwyng.php');

chdir($old);
return $path;

?>
