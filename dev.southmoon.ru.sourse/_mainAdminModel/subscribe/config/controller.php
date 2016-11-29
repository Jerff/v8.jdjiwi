<?php


class subscribe_config_controller extends driver_controller_edit {

	function __construct($id=null) {
		$this->setIdName('main');
		parent::__construct($id);
	}

	protected function init() {
		parent::init();
		$this->addModul('main',		'subscribe_config_modul');

		// url
		$this->setSubmitUrl('/admin/subscribe/');
	}

}

?>