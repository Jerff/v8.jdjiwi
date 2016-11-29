<?php

$page = new cmfAdminController();

$main_edit = $page->load('catalog_brand_edit_controller');
if(cmfAdminMenu::getSubMenuId()) {
	$main_edit->setId(cmfAdminMenu::getSubMenuId());
}
$page->run();
if($main_edit->notId()) return cmfAdminNotRecord;


$this->assing('main_edit', $main_edit);

list($form, $data) = $main_edit->current()->main;
$this->assing('form', $form);
$this->assing('data', $data);

cmfAdminMenu::setSubMenuId($main_edit->getId());

?>