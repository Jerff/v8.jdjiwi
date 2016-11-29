<?php


cmfAjax::start();


cmfLoad('basket/cmfBasketAdress');
$basketAdress = new cmfBasketAdress();
$basketAdress->run1();

?>