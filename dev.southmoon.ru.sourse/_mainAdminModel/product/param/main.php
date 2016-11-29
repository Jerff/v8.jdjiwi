<?php


if(cmfAdminMenu::getSubMenuId()) {
    cmfAdminMenu::setUserMenu('product');
    if(!cmfModulLoad('product_edit_db')->getDataId(cmfAdminMenu::getSubMenuId())) {
        return cmfAdminNotRecord;
    }
    $this->assing('url', cmfModulLoad('product_edit_controller')->viewSiteUrl(cmfAdminMenu::getSubMenuId()));
} else {
    return cmfAdminNotRecord;
}

$page = new cmfAdminController();
$main_edit = $page->load('product_param_controller');
$main_edit->setId(cmfAdminMenu::getSubMenuId());
$page->run();
if($main_edit->notId()) return cmfAdminNotRecord;



$this->assing('main_edit', $main_edit);
list($form, $data) = $main_edit->current()->main;
$this->assing('form', $form);
$this->assing('data', $data);

?>