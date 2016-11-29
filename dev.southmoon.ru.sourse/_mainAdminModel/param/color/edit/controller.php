<?php


class param_color_edit_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'param_color_edit_modul');

		// url
		$this->setSubmitUrl('/admin/param/color/edit/');
		$this->setCatalogUrl('/admin/param/color/');
	}

}

?>