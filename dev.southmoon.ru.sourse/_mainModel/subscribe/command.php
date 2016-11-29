<?php


$command = 'Неправильная команда';
$name = 'Рассылка';
cmfUrlParam::start(cmfPages::getParam(1));
switch(cmfUrlParam::get('command')) {
	case 'subscribeYes':
		switch(cmfUrlParam::get('action')) {
			case 'error':
                $command = 'Неправильная почта или код подверждения';
				break;

			case 'ok':
				$command = 'Подписка завершена';
				break;

			default:
				cmfLoad('subscribe/cmfSubscribeYes');
				$cmfSubscribeYes = new cmfSubscribeYes();
				$cmfSubscribeYes->run1ok(cmfUrlParam::get('email'), cmfUrlParam::get('cod'));
		}
		break;

	case 'subscribeNo':
		switch(cmfUrlParam::get('action')) {
			case 'error':
                $command = 'Неправильная почта или код подверждения';
				break;

			case 'ok':
				$command = 'Отписка завершена';
				break;

			default:
				cmfLoad('subscribe/cmfSubscribeNo');
				$cmfSubscribeNo = new cmfSubscribeNo();
				$cmfSubscribeNo->run1ok(cmfUrlParam::get('email'), cmfUrlParam::get('cod'));
		}
		break;

}

cmfSeo::set('command', $name);

$this->assing('name', $name);
$this->assing('content', $command);


?>