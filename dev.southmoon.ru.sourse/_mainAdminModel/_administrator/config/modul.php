<?php


class _administrator_config_modul extends driver_modul_list {

	protected function init() {
		parent::init();

		$this->setDb('_administrator_config_db');

		// �����
		$form = $this->getForm();
		$form->add('debugError',		new cmfFormCheckbox());
		$form->add('debugSql',		new cmfFormCheckbox());
		$form->add('debugExplain',	new cmfFormCheckbox());
		$form->add('debugCache',		new cmfFormCheckbox());
	}

}

?>