<?php


class param_color_list_controller extends driver_controller_list_all {

	protected function init() {
		parent::init();
		$this->addModul('main',	'param_color_list_modul');

		// url
		$this->setSubmitUrl('/admin/param/color/');
		$this->setEditUrl('/admin/param/color/edit/');
	}

	public function delete($id) {
		$id = cmfModulLoad('param_color_edit_controller')->delete($id);
		return parent::delete($id);
	}

}

?>