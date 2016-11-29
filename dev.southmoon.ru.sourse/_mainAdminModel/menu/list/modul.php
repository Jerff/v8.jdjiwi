<?php


class menu_list_modul extends driver_modul_list {

	protected function init() {
		parent::init();

		$this->setDb('menu_list_db');

		// формы
		$form = $this->getForm();
		$this->setNewPos();
		$form->add('name',		new cmfFormText(array('max'=>150)));
		$form->add('url',		new cmfFormText(array('max'=>150)));
		$form->add('menu',		new cmfFormSelect());
		$form->add('visible',		new cmfFormCheckbox());
	}

	public function loadForm() {
		$form = $this->getForm();
		model_menu::initMenu($form);
	}

}

?>