<?php
$page = new cmfAdminController();

$main_edit = $page->load('basket_edit_controller');
if(!$main_edit->getId()) return cmfAdminNotRecord;
$page->run();
if($main_edit->notId()) return cmfAdminNotRecord;

$this->assing('listUser', $main_edit->listUser());

$this->assing('main_edit', $main_edit);
list($form, $data) = $main_edit->current()->main;
$this->assing('form', $form);
$this->assing('data', $data);


$this->assing('edit', cmfCommand::is('$is'));
$this->assing('isEdit', cmfCommand::is('$isEdit'));

?>