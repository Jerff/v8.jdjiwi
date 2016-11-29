<?php

if(0) {
    $sql = cmfRegister::getSql();
    $mail = $sql->placeholder("SELECT `email`, `type` FROM ?t", db_subscribe_mail)
            ->fetchRowAll(0, 1, 1);

    $list = array();
    foreach(model_subscribe::typeList() as $k=>$v) {
        $list[$v['name']] = $k;
    }

    $res = $sql->placeholder("SELECT id, user, data FROM ?t WHERE `delete`='no'", db_basket)
            ->fetchAssocAll('id');
    foreach($res as $id=>$row) {
        list(, $email, , , $subcribe) = cmfString::unserialize($row['data']);
        if(is_array($subcribe)) {
            foreach($subcribe as $k=>$v) if(isset($list[$k])) {
                $k = $list[$k];
                if(!isset($mail[$email][$k])) {
                    cmfSubscribe::addUser($row['user'], $email, $k);
                }
            }
        }
//        pre($email, $subcribe, $list);
    }

//    pre($mail);

    exit;
}

$page = new cmfAdminController();

$main_list = $page->load('subscribe_list_controller');
$this->assing('filterType', $main_list->filterType());
$config = $page->load('subscribe_config_controller', 'subscribe');
$page->run();


$this->assing('main_list', $main_list);
$this->assing('limitUrl', $main_list->getLimitUrl());
$this->assing('linkPage', $main_list->getLinkPage());

$this->assing('config', $config);
list($form, $data) = $config->current()->main;
$this->assing('configForm', $form);


?>