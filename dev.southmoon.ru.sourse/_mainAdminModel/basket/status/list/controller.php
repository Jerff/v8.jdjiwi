<?php


class basket_status_list_controller extends driver_controller_list_all {

	protected function init() {
		parent::init();
		$this->addModul('main',	'basket_status_list_modul');

		// url
		$this->setSubmitUrl('/admin/basket/status/');
		$this->setEditUrl('/admin/basket/status/edit/');
	}

	public function delete($id) {
		$id = cmfModulLoad('basket_status_edit_controller')->delete($id);
		return parent::delete($id);
	}

}

?>