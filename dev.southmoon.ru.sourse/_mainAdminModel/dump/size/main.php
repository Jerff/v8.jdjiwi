<?php

$page = new cmfAdminController();

$main_list = $page->load('dump_size_controller');
$config = $page->load('dump_config_controller', 'product.dump');
$this->assing('log', $main_list->getLog());
$page->run();


$this->assing('main_list', $main_list);

$this->assing('config', $config);
list($form, $data) = $config->current()->main;
$this->assing('configForm', $form);

?>
