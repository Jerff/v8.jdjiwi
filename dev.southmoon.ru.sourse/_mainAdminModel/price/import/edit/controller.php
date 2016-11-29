<?php


class price_import_edit_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'price_import_edit_modul');

		// url
		$this->setSubmitUrl('/admin/price/import/edit/');
		$this->setCatalogUrl('/admin/price/import/');
	}

	public function shop() {
		return cmfModulLoad('shop_edit_db')->getDataId($this->getFilter('shop'));
	}

	public function delete($id) {
		return $res;
	}

}

?>