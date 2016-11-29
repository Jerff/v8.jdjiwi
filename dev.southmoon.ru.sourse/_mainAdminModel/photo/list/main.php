<?php


$page = new cmfAdminController();
$main_list = $page->load('photo_list_controller');
$config = $page->load('photo_list_config_controller', 'photo');
$page->run();


$this->assing('main_list', $main_list);

$this->assing('config', $config);
list($form, $data) = $config->current()->main;
$this->assing('configForm', $form);

?>
