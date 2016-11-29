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
$main_edit = $page->load('product_image_edit_controller');
$this->assing('id', $main_edit->getId());
$main_multi = $page->load('product_image_multi_controller');
$main_list = $page->load('product_image_list_controller');
$page->run();


$this->assing('isMultiImage', cmfCommand::get('isMultiUplod'));
$this->assing('main_multi', $main_multi);

$this->assing('main_list', $main_list);
$this->assing('limitUrl', $main_list->getLimitUrl());
$this->assing('linkPage', $main_list->getLinkPage());

$this->assing('main_edit', $main_edit);
list($form, $data) = $main_edit->current()->main;
$this->assing('form', $form);
$this->assing('data', $data);

?>
