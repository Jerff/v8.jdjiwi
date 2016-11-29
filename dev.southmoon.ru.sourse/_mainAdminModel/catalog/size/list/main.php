<?php


$page = new cmfAdminController();
$main_list = $page->load('catalog_size_list_controller');
$config = $page->load('catalog_size_config_controller', 'catalog/size');
$page->run();


$this->assing('main_list', $main_list);

$this->assing('config', $config);
list($form, $data) = $config->current()->main;
$this->assing('configForm', $form);

?>
