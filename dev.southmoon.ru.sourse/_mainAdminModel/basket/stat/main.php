<?php

$page = new cmfAdminController();

$main_list = $page->load('basket_stat_controller');
$this->assing('filterType', $main_list->filterType());
$page->run();

$this->assing('main_list', $main_list);

?>
