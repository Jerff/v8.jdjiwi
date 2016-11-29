<?php


class param_discount_list_controller extends driver_controller_list_all {

	protected function init() {
		parent::init();
		$this->addModul('main',	'param_discount_list_modul');

		// url
		$this->setSubmitUrl('/admin/param/discount/');
		$this->setEditUrl('/admin/param/discount/edit/');
	}

	public function delete($id) {
		$id = cmfModulLoad('param_discount_edit_controller')->delete($id);
		return parent::delete($id);
	}

}

?>