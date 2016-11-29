<?php


class catalog_brand_list_controller extends driver_controller_list {

	protected function init() {
		parent::init();
		$this->addModul('main',	'catalog_brand_list_modul');

		// url
		$this->setSubmitUrl('/admin/catalog/brand/');
		$this->setEditUrl('/admin/catalog/brand/edit/');
	}

	public function delete($id) {
		$id = cmfModulLoad('catalog_brand_edit_controller')->delete($id);
		return parent::delete($id);
	}

}

?>