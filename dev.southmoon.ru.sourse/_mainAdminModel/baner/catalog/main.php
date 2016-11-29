<?php

$page = new cmfAdminController();

$main_list = $page->load('baner_catalog_controller');
$config = $page->load('baner_config_controller', 'baner');
$this->assing('filterSection', $main_list->filterSection());
$this->assing('filterBrand', $main_list->filterBrand());
$page->run();

$this->assing('main_list', $main_list);

$this->assing('config', $config);
list($form, $data) = $config->current()->main;
$this->assing('configForm', $form);

?>
