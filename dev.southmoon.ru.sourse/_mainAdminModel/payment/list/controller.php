<?php


class payment_list_controller extends driver_controller_list_all {

	protected function init() {
		parent::init();
		$this->addModul('main',	'payment_list_modul');

		// url
		$this->setSubmitUrl('/admin/payment/');
		$this->setEditUrl('/admin/payment/edit/');
	}

	public function delete($id) {
		$id = cmfModulLoad('payment_edit_controller')->delete($id);
		return parent::delete($id);
	}

}

?>