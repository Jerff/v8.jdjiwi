<?php

$page = new cmfAdminController();
$main_edit = $page->load('catalog_section_shop_controller');
$main_image = $page->load('catalog_section_shop_image_controller');
if(!cmfAdminMenu::getSubMenuId()) {
	return cmfAdminNotRecord;
}
$parent = cmfModulLoad('catalog_section_edit_db')->getFeildOfId('parent', cmfAdminMenu::getSubMenuId());
if(is_null($parent) or $parent) {
	return cmfAdminNotRecord;
}
cmfAdminMenu::setUserMenu('group');
cmfAdminMenu::setUserMenu('shop');
$page->run();

$this->assing('name', cmfModulLoad('catalog_section_edit_db')->getFeildOfId('name', cmfAdminMenu::getSubMenuId()));

$this->assing('main_image', $main_image);

$this->assing('main_edit', $main_edit);
list($form, $data) = $main_edit->current()->main;
$this->assing('sectionForm', $form);
$this->assing('sectionData', $data);

?>
