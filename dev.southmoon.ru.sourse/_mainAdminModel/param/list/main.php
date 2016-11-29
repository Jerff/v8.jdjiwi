<?php

$page = new cmfAdminController();

$main_list = $page->load('param_list_controller');
$config = $page->load('param_config_controller', 'param');
$page->run();


$this->assing('main_list', $main_list);

$this->assing('config', $config);
list($form, $data) = $config->current()->main;
$this->assing('configForm', $form);

?>
