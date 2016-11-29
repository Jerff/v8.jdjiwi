<?php


class basket_status_edit_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'basket_status_edit_modul');

		// url
		$this->setSubmitUrl('/admin/basket/status/edit/');
		$this->setCatalogUrl('/admin/basket/status/');
	}

}

?>