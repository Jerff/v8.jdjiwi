<?php


class photo_list_modul extends driver_modul_list {

	protected function init() {
		parent::init();

		$this->setDb('photo_list_db');

		// �����
		$form = $this->getForm();
		$form->add('isMain',		new cmfFormCheckbox());
		$form->add('visible',		new cmfFormCheckbox());
	}

    protected function saveStart(&$send) {
		parent::saveStart($send);
		if(isset($send['isMain'])) {
			$this->setNewView();
		}
	}
    
}

?>