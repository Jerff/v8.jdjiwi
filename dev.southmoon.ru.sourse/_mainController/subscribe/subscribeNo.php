<?php


cmfAjax::start();
cmfLoad('subscribe/cmfSubscribeNo');
$subscribeYes = new cmfSubscribeNo();
$subscribeYes->run();


?>