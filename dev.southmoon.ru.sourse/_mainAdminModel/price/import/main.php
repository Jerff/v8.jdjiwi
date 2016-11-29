<?php

$page = new cmfAdminController();

$main_edit = $page->load('price_import_controller');
$this->assing('filterShop', $main_edit->filterShop());
if($main_edit->getFilter('command')==='export') {
	$main_edit->export();
	exit;
}
$main_list = $page->load('price_import_list_controller');
$page->run();


$this->assing('main_edit', $main_edit);
$this->assing('is', $main_edit->isWrite());
$this->assing('shop', $main_edit->shop());

$this->assing('main_list', $main_list);
$this->assing('limitUrl', $main_list->getLimitUrl());
$this->assing('linkPage', $main_list->getLinkPage());

?>
