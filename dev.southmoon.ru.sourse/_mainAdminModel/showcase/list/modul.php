<?php


class showcase_list_modul extends driver_modul_list {

	protected function init() {
		parent::init();

		$this->setDb('showcase_list_db');

		// �����
		$form = $this->getForm();
		$this->setNewPos();
		$form->add('visible',		new cmfFormCheckbox());
	}

}

?>