<?php


class payment_param_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'payment_param_modul');
		$this->addModul('edit',	'payment_param_edit_modul');

		// url
		$this->setSubmitUrl('/admin/basket/pay/param/');
		$this->setCatalogUrl('/admin/basket/pay/edit/');

		$this->callFuncReadAdd('onchangeCountry');
	}

}

?>