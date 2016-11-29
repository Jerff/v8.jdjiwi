<?php

$id = cmfPages::getParam(1);
if(empty($id)) {
	$id = 'main';
}

$page = new cmfAdminController();
$main = $page->load('main_info_controller', $id);
$page->run();
if($main->notId()) return cmfAdminNotRecord;
unset($page);


$current = $main->current();
list($form, $data) = $current->config;
$this->assing('configForm', $form);
$this->assing('configData', $data);

$this->assing('main_edit', $main);
list($form, $data) = $current->main;
$this->assing('form', $form);
$this->assing('data', $data);

foreach(cmfGlobal::get('$isForm') as $k=>$v) {
	$this->assing($k, $v);
}

?>