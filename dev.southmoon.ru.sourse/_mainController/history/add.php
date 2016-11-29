<?php

cmfLoad('basket/cmfHistory');

cmfAjax::start();
$r = cmfRegister::getRequest();
if($product = (int)$r->getPost('id')) {
	$basket = new cmfHistory();
	$basket->addProduct($product);
}

?>