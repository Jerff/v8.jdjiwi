<?php

$page = new cmfAdminController();

$main_edit = $page->load('subscribe_history_view_controller');
if(cmfAdminMenu::getSubMenuId()) {
    cmfAdminMenu::setUserMenu('param');
    if(!$row = cmfModulLoad('subscribe_edit_db')->getDataId(cmfAdminMenu::getSubMenuId())) {
        return cmfAdminNotRecord;
    }
    if($row['type']!=='user') {
        return cmfAdminNotRecord;
    }
} else {
    return cmfAdminNotRecord;
}
$page->run();
if($main_edit->notId()) return cmfAdminNotRecord;


$this->assing('main_edit', $main_edit);

list($form, $data) = $main_edit->current()->main;
$this->assing('form', $form);
$this->assing('data', $data);

cmfAdminMenu::setUserMenu('history');
cmfAdminMenu::selectUserMenu('/admin/subscribe/history/');



?>