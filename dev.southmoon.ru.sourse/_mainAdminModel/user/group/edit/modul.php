<?php


class user_group_edit_modul extends driver_modul_edit {

	protected function init() {
		parent::init();

		$this->setDb('user_group_edit_db');

		// �����
		$form = $this->getForm();
		$this->setNewPos();

		$form->add('name',		new cmfFormTextarea(array('max'=>255, '!empty')));

		$form->add('visible',		new cmfFormCheckbox());
	}

}

?>