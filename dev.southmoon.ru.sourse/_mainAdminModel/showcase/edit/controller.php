<?php


class showcase_edit_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'showcase_edit_modul');

		// url
		$this->setSubmitUrl('/admin/showcase/edit/');
		$this->setCatalogUrl('/admin/showcase/');
	}

}

?>