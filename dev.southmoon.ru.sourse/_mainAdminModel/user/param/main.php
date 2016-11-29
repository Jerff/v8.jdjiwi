<?php


$page = new cmfAdminController();
$main_edit = $page->load('user_param_controller');
if(cmfAdminMenu::getSubMenuId()) {
	$main_edit->setId(cmfAdminMenu::getSubMenuId());
}
cmfUserModel::accesIs($main_edit->getId());
$page->run();


$this->assing('main_edit', $main_edit);
list($form, $data) = $main_edit->current()->main;
$this->assing('form', $form);
$this->assing('data', $data);


list($form, $data) = $main_edit->current()->edit;
$this->assing('editForm', $form);
$this->assing('editData', $data);


$this->assing('userStat', $main_edit->getUserStat());
$this->assing('userName', cmfGlobal::get('$userName'));
$this->assing('indexUrl', cmfGlobal::get('$indexUrl'));

cmfAdminMenu::setUserMenu('param');

?>