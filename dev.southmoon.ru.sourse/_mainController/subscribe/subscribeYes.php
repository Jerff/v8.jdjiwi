<?php


cmfAjax::start();
cmfLoad('subscribe/cmfSubscribeYes');
$subscribeYes = new cmfSubscribeYes();
$subscribeYes->run();


?>