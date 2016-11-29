<?php


class content_pages_edit_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'content_pages_edit_modul');

		// url
		$this->setSubmitUrl('/admin/content/pages/edit/');
		$this->setCatalogUrl('/admin/content/pages/');
	}

}

?>