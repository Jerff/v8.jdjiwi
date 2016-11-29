<?php
$page = new cmfAdminController();

$main_edit = $page->load('price_import_edit_controller');
$page->run();
if($main_edit->notId()) return cmfAdminNotRecord;


$this->assing('shop', $main_edit->shop());
$this->assing('main_edit', $main_edit);
list($form, $data) = $main_edit->current()->main;
$this->assing('data', $data);


?>