<?php

$page = new cmfAdminController();
$main_list = $page->load('product_attach_controller');

if(!$menu = $main_list->filterMenu()) return cmfAdminNotRecord;
$this->assing('menu', $menu);

$this->assing('filterSection', $main_list->filterSection());
$this->assing('filterBrand', $main_list->filterBrand());

$this->assing('filterAttach', $main_list->filterAttach());
$this->assing('filterFilter', $main_list->filterFilter());

$page->run();


$this->assing('articul', htmlspecialchars($main_list->getFilter('articul')));
$this->assing('price1', htmlspecialchars($main_list->getFilter('price1')));
$this->assing('price2', htmlspecialchars($main_list->getFilter('price2')));

$this->assing('section', $main_list->getFilter('section'));
$this->assing('productId', $main_list->getFilter('product1'));

$this->assing('main_list', $main_list);
$this->assing('limitUrl', $main_list->getLimitUrl());
$this->assing('linkPage', $main_list->getLinkPage());


?>