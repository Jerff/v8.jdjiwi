<?php


class price_import_list_controller extends driver_controller_list {

	protected function init() {
		parent::init();
		$this->addModul('main',	'price_import_list_modul');

		// url
		$this->setSubmitUrl('/admin/price/import/');
		$this->setEditUrl('/admin/price/import/edit/');
	}

}

?>