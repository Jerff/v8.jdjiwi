<?php


class menu_list_controller extends driver_controller_list_all {

	protected function init() {
		parent::init();
		$this->addModul('main',	'menu_list_modul');

		// url
		$this->setSubmitUrl('/admin/menu/');

		$this->callFuncWriteAdd('newLine');
	}


	public function delete($id) {
		parent::deleteList($id);
		return parent::delete($id);
	}

}

?>