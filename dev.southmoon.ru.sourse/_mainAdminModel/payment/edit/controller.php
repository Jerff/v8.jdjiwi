<?php


class payment_edit_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'payment_edit_modul');

		// url
		$this->setSubmitUrl('/admin/payment/edit/');
		$this->setCatalogUrl('/admin/payment/');
	}

}

?>