<?php


class user_param_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'user_param_modul');
		$this->addModul('edit',	'user_param_edit_modul');

		// url
		$this->setSubmitUrl('/admin/user/param/');
		$this->setCatalogUrl('/admin/user/edit/');

		$this->callFuncReadAdd('onchangeCountry');
	}

	public function getUserStat() {
		return cmfModulLoad('user_edit_db')->getUserStat($this->getId());
	}

	protected function onchangeCountry() {
		$this->getModul()->onchangeCountry();
	}

}

?>