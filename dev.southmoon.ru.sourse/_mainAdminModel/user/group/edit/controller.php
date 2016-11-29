<?php


class user_group_edit_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'user_group_edit_modul');

		// url
		$this->setSubmitUrl('/admin/user/group/edit/');
		$this->setCatalogUrl('/admin/user/group/');
	}

	public function delete($id) {
		return $id;
	}

}

?>