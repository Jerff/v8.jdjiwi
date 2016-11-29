<?php


$page = new cmfAdminController();
$main_list = $page->load('subscribe_mail_list_controller');
$this->assing('filterType', $main_list->filterType());
$page->run();

$this->assing('listUser', $main_list->listUser());

$this->assing('main_list', $main_list);
$this->assing('limitUrl', $main_list->getLimitUrl());
$this->assing('linkPage', $main_list->getLinkPage());

?>