<?php

$page = new cmfAdminController();

$main_list = $page->load('basket_status_list_controller');
$page->run();

$this->assing('main_list', $main_list);

?>