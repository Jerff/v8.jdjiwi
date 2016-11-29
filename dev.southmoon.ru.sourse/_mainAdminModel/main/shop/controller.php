<?php


class main_shop_controller extends driver_controller_list_all {

	protected function init() {
		parent::init();
		$this->addModul('main',	'main_shop_modul');

		// url
		$this->setSubmitUrl('/admin/shop/');

		$this->callFuncReadAdd('onchangeSection|onchangeProduct');
		$this->callFuncWriteAdd('newLine');
	}


	public function delete($id) {
		parent::deleteList($id);
		return parent::delete($id);
	}


	public function product() {
		return $this->getSql()->placeholder("SELECT w.id, p.name, p.price FROM ?t w LEFT JOIN ?t p ON(w.product=p.id)", db_shop, db_product)
										->fetchAssocAll('id');
	}

	public function loadForm2() {
		$this->getModul()->loadForm2($this->getId());
	}

	protected function newLine() {
		parent::newLine();
	}

	protected function onchangeSection($id) {
		$this->getModul()->onchangeSection($id);
	}

	protected function onchangeProduct($id) {
		$this->getModul()->onchangeProduct($id);
	}

}

?>