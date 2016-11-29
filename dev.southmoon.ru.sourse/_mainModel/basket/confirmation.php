<?php


$user = cmfRegister::getUser();
$user->reset();
$this->assing2('userUrl', cmfGetUrl('/user/enter/'));
$this->assing2('isUser',    $user->is());


$basket = new cmfBasket();      
if(!$basket->isStep(5) or !$basket->isOrder()) {
    cmfRedirect(cmfGetUrl('/basket/pay/'));
}

list($header, $_basket, $countAll, $priceAll, $priceDiscount, $priceDelivery, $discount, $isDelivery, $delivery, $pricePay) = $res = $basket->getBasketProduct();
if(!$countAll) {
	cmfRedirect(cmfGetUrl('/basket/'));
}

$this->assing('header', $header);
$this->assing('_basket', $_basket);
$this->assing('countAll', $countAll);

$this->assing('priceAll', $priceAll);
$this->assing('priceDiscount', $priceDiscount);
$this->assing('discount', $discount);
if($isDelivery)
$this->assing('priceDelivery', $priceDelivery);

list(, $userDelivery) = $basket->getStep(2);
list(,, $userData, $userAdress) = $basket->getStep(3);
list(, $userSubscribe) = $basket->getStep(4);
$this->assing('userData', $userData);
$this->assing('userDelivery', $userDelivery);
$this->assing('userAdress', $userAdress);
$this->assing('userSubscribe', $userSubscribe);


cmfLoad('basket/cmfBasketView');
cmfBasketView::init($basket, 'confirmation');
if(cmfSession::is('basketReferer')) {
    $this->assing2('referer', cmfSession::get('basketReferer'));
}

?>