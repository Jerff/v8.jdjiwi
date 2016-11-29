<?php

$basket = new cmfBasket();
if(cmfRegister::getUser()->is()) {
    if(!$basket->isStep(3) or !$basket->isOrder()) {
        cmfRedirect(cmfGetUrl('/basket/adress/'));
    }
    $basket->setStep(4);
} else {
    if(!$basket->isStep(4) or !$basket->isOrder()) {
        cmfRedirect(cmfGetUrl('/basket/subscribe/'));
    }    
}
$basket->setStep(5);
$basket->save();

cmfRedirect(cmfGetUrl('/basket/confirmation/'));

?>