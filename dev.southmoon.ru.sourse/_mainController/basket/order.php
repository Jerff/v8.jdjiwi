<?php


cmfAjax::start();
cmfLoad('basket/cmfBasketOrder');



$userRegister = new cmfBasketOrder();
$userRegister->run1();

?>