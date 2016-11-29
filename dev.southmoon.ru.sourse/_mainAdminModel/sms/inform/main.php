<?php

$page = new cmfAdminController();

$main_list = $page->load('sms_inform_controller');
$config = $page->load('sms_config_controller', 'sms');
$page->run();


$this->assing('main_list', $main_list);

$this->assing('config', $config);
list($form, $data) = $config->current()->main;
$this->assing('configForm', $form);

?>
