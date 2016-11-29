<?php

cmfAjax::start();
$r = cmfRegister::getRequest();

cmfLoad('user/cmfUserEnter');
switch($r->getGet('action')) {
	case 'UserEnter':
	case 'leftUserEnter':
	case 'basket':
		$userEnter = new cmfUserEnter();
		$userEnter->run();
		break;

}


?>