<?php


class subscribe_history_list_modul extends driver_modul_list {

	protected function init() {
		parent::init();

		$this->setDb('subscribe_history_list_db');

		// �����
		$form = $this->getForm();
	}

}

?>