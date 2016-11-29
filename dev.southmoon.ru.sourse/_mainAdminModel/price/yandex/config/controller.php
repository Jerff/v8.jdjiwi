<?php


class price_yandex_config_controller extends driver_controller_edit_param_of_record {

	protected function init() {
		parent::init();
		$this->addModul('main',		'price_yandex_config_modul');
		$this->addModul('section',	'price_yandex_section_modul');

		// url
		$this->setSubmitUrl('/admin/price/yandex/');

		$this->callFuncWriteAdd('updateYandex');
	}

	protected function updateYandex() {
        cmfCronRun::runModul('Yandex.Market');
        $this->getResponse()->addAlert('Обновление завершено');
	}

}

?>