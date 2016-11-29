<?php


class delivery_delivery_controller extends driver_controller_list_all {

	protected function init() {
		parent::init();
		$this->addModul('main',	'delivery_delivery_modul');

		// url
		$this->setSubmitUrl('/admin/delivery/');

		$this->callFuncWriteAdd('newLine');
	}

	public function delete($id) {
		parent::deleteList($id);
		return parent::delete($id);
	}

}

?>