<?php
$page = new cmfAdminController();

$main_edit = $page->load('product_edit_controller');
if(!$main_edit->getId() and cmfAdminMenu::getSubMenuId()) {
	$main_edit->setId(cmfAdminMenu::getSubMenuId());
}
$page->run();
if($main_edit->notId()) return cmfAdminNotRecord;


$this->assing('attach', $main_edit->attachProduct());
$this->assing('main_edit', $main_edit);
list($form, $data) = $main_edit->current()->edit;
$this->assing('form', $form);
$this->assing('data', $data);

if($main_edit->getId()) {
	cmfAdminMenu::setSubMenuId($main_edit->getId());
	cmfAdminMenu::setUserMenu('product');
}

?>