<?php


class param_color_edit_modul extends driver_modul_edit {

	protected function init() {
		parent::init();

		$this->setDb('param_color_edit_db');

		// формы
		$form = $this->getForm();

		$form->add('name',	new cmfFormTextarea(array('!empty', 'max'=>100)));
		$form->add('color',	new cmfFormText(array('max'=>25)));
		$form->add('visible',	new cmfFormCheckbox());
	}

}

?>