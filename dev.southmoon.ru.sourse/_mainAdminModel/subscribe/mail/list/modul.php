<?php


class subscribe_mail_list_modul extends driver_modul_list {

	protected function init() {
		parent::init();

		$this->setDb('subscribe_mail_list_db');

		// �����
		$form = $this->getForm();
		$form->add('subscribe',		new cmfFormCheckbox());
	}

}

?>