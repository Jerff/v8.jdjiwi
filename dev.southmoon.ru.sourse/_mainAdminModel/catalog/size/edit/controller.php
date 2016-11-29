<?php


class catalog_size_edit_controller extends driver_controller_edit_tree {

	protected function init() {
		parent::init();
		$this->addModul('main',	'catalog_size_edit_modul');

		// url
		$this->setSubmitUrl('/admin/catalog/size/edit/');
		$this->setCatalogUrl('/admin/catalog/size/');
	}

}

?>