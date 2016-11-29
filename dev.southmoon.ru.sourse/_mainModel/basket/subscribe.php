<?php


$user = cmfRegister::getUser();
$user->reset();
$this->assing2('userUrl', cmfGetUrl('/user/enter/'));
$this->assing2('isUser',    $user->is());


$basket = new cmfBasket();
if(!$basket->isStep(3) or !$basket->isOrder()) {
    cmfRedirect(cmfGetUrl('/basket/adress/'));
}
if($user->is()) {
    cmfRedirect(cmfGetUrl('/basket/pay/'));
}

list($header, $_basket, $countAll, $priceAll, $priceDiscount, $priceDelivery, $discount, $isDelivery, $delivery, $pricePay) = $res = $basket->getBasketProduct();
if(!$countAll) {
	cmfRedirect(cmfGetUrl('/basket/'));
}

$this->assing('priceAll', $priceAll);
$this->assing('priceDiscount', $priceDiscount);
$this->assing('discount', $discount);
if($isDelivery)
$this->assing('priceDelivery', $priceDelivery);


cmfLoad('basket/cmfBasketSubscribe');
$order = new cmfBasketSubscribe();
$order->loadData();
$this->assing('order',	$order);
$this->assing('formSubscribe',	$order->getForm());


cmfLoad('basket/cmfBasketView');
cmfBasketView::init($basket, 'subscribe');
if(cmfSession::is('basketReferer')) {
    $this->assing2('referer', cmfSession::get('basketReferer'));
}


?>