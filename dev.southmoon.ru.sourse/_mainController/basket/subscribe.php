<?php


cmfAjax::start();


cmfLoad('basket/cmfBasketSubscribe');
$basketSubscribe = new cmfBasketSubscribe();
$basketSubscribe->run1();

?>