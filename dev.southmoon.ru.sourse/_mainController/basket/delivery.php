<?php


cmfAjax::start();


cmfLoad('basket/cmfBasketDelivery');
$basketDelivery = new cmfBasketDelivery();
$basketDelivery->run1();

?>