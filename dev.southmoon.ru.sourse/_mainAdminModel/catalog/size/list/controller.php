<?php


class catalog_size_list_controller extends driver_controller_list_tree {

	protected function init() {
		parent::init();
		$this->addModul('main',	'catalog_size_list_modul');

		// url
		$this->setSubmitUrl('/admin/catalog/size/');
		$this->setEditUrl('/admin/catalog/size/edit/');

	}

	public function delete($id) {
		$id = cmfModulLoad('catalog_size_edit_controller')->delete($id);
		return parent::delete($id);
	}

}

?>