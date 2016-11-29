<?php


$command = 'Неправильная команда';
$name = 'Личный кабинет';
cmfUrlParam::start(cmfPages::getParam(1));
switch(cmfUrlParam::get('command')) {
	case 'recoverPassword':
		switch(cmfUrlParam::get('action')) {
			case 'error':
                $command = 'Неправильная почта или код подверждения';
				break;

			case 'ok':
				$command = 'Пароль сменен';
				break;

			default:
				cmfLoad('user/cmfUserRecoverPassword');
				$cmfUserRecoverPassword = new cmfUserRecoverPassword();
				$cmfUserRecoverPassword->run1ok(cmfUrlParam::get('email'), cmfUrlParam::get('cod'));
		}
		break;

	case 'userRegister':
		switch(cmfUrlParam::get('action')) {
			case 'error':
                $command = 'Неправильный аккурант или код подверждения';
				break;

			case 'ok':
				$command = 'Активация прошла успешна';
				break;

			default:
				cmfLoad('user/cmfUserRegister');
				$cmfUserRegister = new cmfUserRegister();
				$cmfUserRegister->userActivate(cmfUrlParam::get('user'), cmfUrlParam::get('cod'));
		}
		break;

}

cmfSeo::set('command', $name);

$this->assing('name', $name);
$this->assing('content', $command);


?>