<?php

$page = new cmfAdminController();

$main_edit = $page->load('user_group_edit_controller');
if(!$main_edit->getId()) return cmfAdminNotRecord;
$page->run();
if($main_edit->notId()) return cmfAdminNotRecord;


$this->assing('main_edit', $main_edit);

list($form, $data) = $main_edit->current()->main;
$this->assing('form', $form);
$this->assing('data', $data);

?>