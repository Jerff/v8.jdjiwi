<?php


$page = new cmfAdminController();
$main_list = $page->load('subscribe_history_list_controller');
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


$this->assing('main_list', $main_list);
cmfAdminMenu::setUserMenu('history');

?>
