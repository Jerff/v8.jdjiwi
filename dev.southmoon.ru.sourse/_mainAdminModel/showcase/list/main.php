<?php


$page = new cmfAdminController();
$main_list = $page->load('showcase_list_controller');
$config = $page->load('showcase_list_config_controller', 'showcase');
$page->run();


$this->assing('main_list', $main_list);

$this->assing('config', $config);
list($form, $data) = $config->current()->main;
$this->assing('configForm', $form);
$this->assing('configData', $data);

?>
