<?php


class param_group_edit_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'param_group_edit_modul');

		// url
		$this->setSubmitUrl('/admin/param/group/edit/');
		$this->setCatalogUrl('/admin/param/group/');
	}

	public function delete($id) {
		cmfModulLoad('param_group_notice_controller')->deleteGroup($id);
		cmfModulLoad('param_group_select_controller')->deleteGroup($id);
		return parent::delete($id);
	}

}

?>