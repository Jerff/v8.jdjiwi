<?php

cmfAjax::start();
$r = cmfRegister::getRequest();

cmfLoad('form/cmfCallBack');
$callBack = new cmfCallBack();
$callBack->run();


?>