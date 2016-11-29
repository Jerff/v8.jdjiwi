<?php


$page = new cmfAdminController();

$main_edit = $page->load('price_yandex_config_controller', 'yandex.market');
$page->run();

$this->assing('main_edit', $main_edit);
list($form, $data) = $main_edit->current()->main;
$this->assing('form', $form);
$this->assing('data', $data);

list($form, $data) = $main_edit->current()->section;
$this->assing('formSection', $form);
$this->assing('dataSection', $data);

?>