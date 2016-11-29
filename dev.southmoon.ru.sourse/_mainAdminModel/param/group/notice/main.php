<?php

$page = new cmfAdminController();

$main_list = $page->load('param_group_notice_controller');
if(!cmfAdminMenu::getSubMenuId()) {
	return cmfAdminNotRecord;
}
$parent = cmfModulLoad('catalog_section_edit_db')->getFeildOfId('parent', cmfAdminMenu::getSubMenuId());
if(is_null($parent)) {
	return cmfAdminNotRecord;
}
if(!$parent) {
	cmfAdminMenu::setUserMenu('shop');
}
cmfAdminMenu::setUserMenu('group');

$main_edit = $page->load('param_group_notice_section_controller');
$page->run();

$this->assing('main_list', $main_list);
list($name, $filter, $param) = $main_list->parentParam();
$this->assing('name', $name);
$this->assing('filter', $filter);
$this->assing('param', $param);

$this->assing('main_edit', $main_edit);
list($form, $data) = $main_edit->current()->main;
$this->assing('form', $form);


?>
