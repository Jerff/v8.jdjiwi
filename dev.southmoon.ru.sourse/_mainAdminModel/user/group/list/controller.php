<?php


class user_group_list_controller extends driver_controller_list_all {

	protected function init() {
		parent::init();
		$this->addModul('main',	'user_group_list_modul');

		// url
		$this->setSubmitUrl('/admin/user/group/');
		$this->setEditUrl('/admin/user/group/edit/');

		$this->setUrl('user', '/admin/user/');
	}

	public function getUserUrl() {
		$opt = array('main'=>$this->getIndex());
		return $this->getUrl('user', $opt);
	}

/*	public function delete($id) {
		$id = cmfModulLoad('user_group_edit_controller')->delete($id);
		return parent::delete($id);
	}*/

}

?>