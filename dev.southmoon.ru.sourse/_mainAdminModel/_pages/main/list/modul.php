<?php


class _pages_main_list_modul extends driver_modul_list_one {

	protected function init() {
		parent::init();

		$this->setDb('_pages_main_list_db');

		// �����
		$form = $this->getForm();
		$this->setNewPos();
		$form->add('visible',		new cmfFormCheckbox());
	}

}

?>