<?php


$page = new cmfAdminController();

$main_edit = $page->load('main_info_controller', 'main');
$main_list = $page->load('main_shop_controller');
$page->run();

$this->assing('_product', $main_list->product());
$this->assing('main_list', $main_list);


$this->assing('main_edit', $main_edit);
list($form, $data) = $main_edit->current()->main;
$this->assing('form', $form);
$this->assing('data', $data);

?>