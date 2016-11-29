<?php


cmfAjax::start();

if(!cmfRegister::getUser()->is()) {
	exit;
}
cmfLoad('user/cmfUserSubscribe');
$subscribe = new cmfUserSubscribe();
$subscribe->run1();

?>