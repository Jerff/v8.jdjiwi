<?php


$page = new cmfAdminController();
$main_list = $page->load('article_list_controller');
$this->assing('filterSection', $main_list->filterSection());
$config = $page->load('article_list_config_controller', 'article');
$page->run();


$this->assing('main_list', $main_list);
$this->assing('attach', $main_list->attachProduct());

$this->assing('config', $config);
list($form, $data) = $config->current()->main;
$this->assing('configForm', $form);

?>
