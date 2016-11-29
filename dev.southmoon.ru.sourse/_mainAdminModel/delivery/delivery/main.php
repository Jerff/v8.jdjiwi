<?php

$page = new cmfAdminController();

$main_list = $page->load('delivery_delivery_controller');
$config = $page->load('delivery_config_controller', 'delivery');
$page->run();


$this->assing('main_list', $main_list);

$this->assing('config', $config);
list($form, $data) = $config->current()->main;
$this->assing('configForm', $form);

?>
