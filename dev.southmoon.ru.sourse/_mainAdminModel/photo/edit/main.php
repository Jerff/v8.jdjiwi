<?php

$page = new cmfAdminController();

$main_edit = $page->load('photo_edit_controller');
if(!$main_edit->getId() and cmfAdminMenu::getSubMenuId()) {
	$main_edit->setId(cmfAdminMenu::getSubMenuId());
}
$page->run();
if($main_edit->notId()) return cmfAdminNotRecord;


$this->assing('main_edit', $main_edit);

list($form, $data) = $main_edit->current()->main;
$this->assing('form', $form);
$this->assing('data', $data);

if($main_edit->getId()) {
	cmfAdminMenu::setSubMenuId($main_edit->getId());
	cmfAdminMenu::setUserMenu('photo');
}

?>