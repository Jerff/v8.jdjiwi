<?php

$page = new cmfAdminController();

$main_edit = $page->load('showcase_edit_controller');
$main_image = $page->load('showcase_edit_image_controller');
$page->run();
if($main_edit->notId()) return cmfAdminNotRecord;


$this->assing('main_image', $main_image);

$this->assing('main_edit', $main_edit);
list($form, $data) = $main_edit->current()->main;
$this->assing('showcaseForm', $form);
$this->assing('showcaseData', $data);


?>