<?php


$page = new cmfAdminController();
$main_edit = $page->load('delivery_region_edit_controller');

if(cmfAdminMenu::getSubMenuId()) {
	$main_edit->setId(cmfAdminMenu::getSubMenuId());
}
if($parent = $main_edit->getId()) {
	$main_edit->setFilter('list', $parent);
	$main_edit->setFilter('parent', $parent);
}
if($new = $main_edit->getFilter('add')) {
	$main_edit->setFilter('add', null);
	$main_edit->setFilter('id', null);
}


if(!$new) {
	$main_list = $page->load('delivery_region_list_controller');
}
$page->run();
if($main_edit->notId()) return cmfAdminNotRecord;


if(!$new) {
	$this->assing('child', $main_list->getChild());
	$this->assing('main_list', $main_list);
}


if($main_edit->getId()) {
	cmfAdminMenu::setUserMenu('group');
	cmfAdminMenu::setSubMenuId($main_edit->getId());
} elseif(!$new and cmfPages::isMain('/admin/delivery/country/edit/')) {
	cmfAjax::get()->redirect(cmfGetAdminUrl('/admin/delivery/country/'));
}

$this->assing('id', $main_edit->getId());
$this->assing('isList', $main_edit->getFilter('isList'));
$this->assing('new', $new);

list($form, $data) = $main_edit->current()->main;
$this->assing('main_edit', $main_edit);
$this->assing('form', $form);
$this->assing('data', $data);
$this->assing('isEnd', $data->level==3);


?>
