<?php

$page = new cmfAdminController();

$main_list = $page->load('payment_list_controller');
$config = $page->load('payment_config_controller', 'payment');
$page->run();

$this->assing('main_list', $main_list);

$this->assing('config', $config);
list($form, $data) = $config->current()->main;
$this->assing('configForm', $form);

?>