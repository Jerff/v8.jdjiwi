<?php

$page = new cmfAdminController();

$main_list = $page->load('user_list_controller');
$config = $page->load('user_config_controller', 'user');
$page->run();


$this->assing('name', htmlspecialchars(urldecode($main_list->getFilter('name'))));
$this->assing('email', htmlspecialchars(urldecode($main_list->getFilter('email'))));


$this->assing('main_list', $main_list);
$this->assing('limitUrl', $main_list->getLimitUrl());
$this->assing('linkPage', $main_list->getLinkPage());

$this->assing('config', $config);
list($form, $data) = $config->current()->main;
$this->assing('configForm', $form);

?>
