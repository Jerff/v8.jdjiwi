<?php

cmfAjax::start();
$r = cmfRegister::getRequest();

cmfLoad('form/cmfFeedback');
$feedback = new cmfFeedback($r->getGet('productId'));
$feedback->run();


?>