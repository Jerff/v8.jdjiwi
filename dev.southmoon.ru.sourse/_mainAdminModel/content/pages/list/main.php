<?php

$page = new cmfAdminController();

$main_list = $page->load('content_pages_list_controller');
$this->assing('filterType', $main_list->filterType());
$page->run();


$this->assing('main_list', $main_list);


?>
