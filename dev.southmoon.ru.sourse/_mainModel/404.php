<?php

//$this->setTeplates('main.404.php');
header("HTTP/1.0 404 Not Found");
$content = cmfRegister::getSql()->placeholder("SELECT content FROM ?t WHERE name='Системная страница: 404 error'", db_content_static)
							->fetchRow(0);
$this->assing('content', $content);

$menu = array();
$menu[] = array('name'=>'Ничего не найдено');
cmfGlobal::set('$headerMenu', $menu);

?>
