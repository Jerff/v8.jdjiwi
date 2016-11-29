<?php


$page = new cmfAdminController();
$main_list = $page->load('dump_log_controller');
$page->run();


$this->assing('main_list', $main_list);

?>
