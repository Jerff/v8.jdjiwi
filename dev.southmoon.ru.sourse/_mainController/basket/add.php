<?php


cmfAjax::start();
cmfRegister::getUser()->is();
$r = cmfRegister::getRequest();
$res = cmfAjax::get();


$productId = (int)$r->getPost('productId');
if(!$productId) exit;

$paramId = (int)$r->getPost('param');
if($r->isPost('param')) {
    if(!$paramId) {
        cmfAjax::get()->script("cmf.basket.view($productId, 'Выберите размер');");
        exit;
    }
}

$color = array_keys((array)$r->getPost('color'));
cmfLoad('basket/cmfBasket');
$basket = new cmfBasket();
if($color) {
    foreach($color as $colorId) {
        $basket->addProduct($productId, $paramId, $colorId);
    }
} else {
    $basket->addProduct($productId, $paramId, 0);
}
$basket->initPrice();
$basket->save();
cmfAjax::get()->script("cmf.main.order.buy();");

?>