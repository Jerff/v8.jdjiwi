<?php

$page = new cmfAdminController();

$main_edit = $page->load('subscribe_mail_edit_controller');
$page->run();
if($main_edit->notId()) return cmfAdminNotRecord;

$this->assing('listUser', $main_edit->listUser());

$this->assing('main_edit', $main_edit);

list($form, $data) = $main_edit->current()->main;
$this->assing('form', $form);
$this->assing('data', $data);


?>