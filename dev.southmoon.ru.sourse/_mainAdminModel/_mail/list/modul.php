<?php


class _mail_list_modul extends driver_modul_list {

	protected function init() {
		parent::init();

		$this->setDb('_mail_list_db');

		// �����
		$form = $this->getForm();
		$form->add('userNew',		new cmfFormCheckbox());
		$form->add('basket',		new cmfFormCheckbox());
		$form->add('callback',		new cmfFormCheckbox());
		$form->add('name',			new cmfFormText(array('!empty', 'max'=>255)));
		$form->add('email',			new cmfFormText(array('!empty', 'max'=>255, 'email')));
	}

}

?>