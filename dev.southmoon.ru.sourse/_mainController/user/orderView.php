<?php


cmfAjax::start();
$r = cmfRegister::getRequest();

cmfLoad('user/cmfUserOrderView');
$orderView = new cmfUserOrderView($r->getGet('orderId'));
$orderView->run1();

?>