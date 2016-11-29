<?php


$page = new cmfAdminController();
$main_edit = $page->load('payment_param_controller');
if(cmfAdminMenu::getSubMenuId()) {
	$main_edit->setId(cmfAdminMenu::getSubMenuId());
}
$page->run();
if(!cmfModulLoad('payment_edit_db')->getDataId($main_edit->getId())) {
    return cmfAdminNotRecord;
}
cmfAdminMenu::setUserMenu('param');

$this->assing('main_edit', $main_edit);
list($form, $data) = $main_edit->current()->main;
$this->assing('form', $form);
$this->assing('data', $data);


list($form, $data) = $main_edit->current()->edit;
$this->assing('editForm', $form);
$this->assing('editData', $data);

$this->assing('modul', cmfGlobal::get('modul'));

?>