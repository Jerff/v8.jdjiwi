<?php


class catalog_brand_edit_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'catalog_brand_edit_modul');

		// url
		$this->setSubmitUrl('/admin/catalog/brand/edit/');
		$this->setCatalogUrl('/admin/catalog/brand/');
	}

	public function delete($id) {
		$id = parent::delete($id);
		cmfModulLoad('product_edit_controller')->deleteBrand($id);
		return $id;
	}

}

?>