<?php

$page = new cmfAdminController();

$main_edit = $page->load('payment_edit_controller');
if(cmfAdminMenu::getSubMenuId()) {
	$main_edit->setId(cmfAdminMenu::getSubMenuId());
}
$page->run();
if($main_edit->notId()) return cmfAdminNotRecord;
if($main_edit->getId()) {
    cmfAdminMenu::setUserMenu('param');
}
cmfAdminMenu::setSubMenuId($main_edit->getId());


$this->assing('main_edit', $main_edit);

list($form, $data) = $main_edit->current()->main;
$this->assing('form', $form);
$this->assing('data', $data);

?>