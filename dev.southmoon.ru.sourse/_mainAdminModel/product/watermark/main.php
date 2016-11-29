<?php


$page = new cmfAdminController();

$main_edit = $page->load('product_watermark_controller', 'watermark');
$page->run();

$this->assing('main_edit', $main_edit);
list($form, $data) = $main_edit->current()->main;
$this->assing('form', $form);
$this->assing('data', $data);

$this->assing('logo', cmfBaseImg . cmfPathWatermark . cmfImage::logo);


?>