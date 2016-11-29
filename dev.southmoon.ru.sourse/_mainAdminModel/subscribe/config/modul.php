<?php


class subscribe_config_modul extends driver_modul_edit {

	function __construct() {
		$this->setIdName('main');
		parent::__construct();
	}

	protected function init() {
		parent::init();

		$this->setDb('subscribe_config_db');

		// формы
		$form = $this->getForm();
		$form->add('email',		    new cmfFormText(array('max'=>255, '!empty', 'email')));
		$form->add('mailMax',    	new cmfFormTextInt(array('min'=>25, 'max'=>50)));
	}

}

?>