<?php


class param_discount_edit_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'param_discount_edit_modul');

		// url
		$this->setSubmitUrl('/admin/param/discount/edit/');
		$this->setCatalogUrl('/admin/param/discount/');
	}

}

?>