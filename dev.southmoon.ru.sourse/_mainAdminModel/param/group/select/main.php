<?php

$page = new cmfAdminController();

$main_list = $page->load('param_group_select_controller');
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
$page->run();

$this->assing('main_list', $main_list);

list($name, $param) = $main_list->parentParam();
$this->assing('name', $name);
$this->assing('param', $param);

?>
