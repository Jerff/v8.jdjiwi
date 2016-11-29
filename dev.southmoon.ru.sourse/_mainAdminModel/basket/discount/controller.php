<?php


class basket_discount_controller extends driver_controller_list_all {

	protected function init() {
		parent::init();
		$this->addModul('main',	'basket_discount_modul');

		// url
		$this->setSubmitUrl('/admin/basket/discount/');

		$this->callFuncWriteAdd('newLine');
	}

}

?>