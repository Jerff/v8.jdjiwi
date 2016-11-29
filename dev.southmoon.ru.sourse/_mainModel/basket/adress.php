<?php


$user = cmfRegister::getUser();
$user->reset();
$this->assing2('userUrl', cmfGetUrl('/user/enter/'));
$this->assing2('isUser',    $user->is());


$basket = new cmfBasket();
if(!$basket->isStep(2) or !$basket->isOrder()) {
    cmfRedirect(cmfGetUrl('/basket/delivery/'));
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


cmfLoad('basket/cmfBasketAdress');
$order = new cmfBasketAdress();
$order->loadData();
$this->assing('order',	$order);
$this->assing('form',			$order->getForm(1));
$this->assing('formAdress',		$order->getForm(3));
$this->assing('formContact',	$order->getForm(4));
$this->assing('formNotice',		$order->getForm(5));

$this->assing2('userInfo',		cmfConfig::get('user', 'basket'));
$this->assing2('deliveryInfo',	cmfConfig::get('delivery', 'basket'));
cmfLoad('basket/cmfBasketView');
cmfBasketView::init($basket, 'adress');
if(cmfSession::is('basketReferer')) {
    $this->assing2('referer', cmfSession::get('basketReferer'));
}


?>