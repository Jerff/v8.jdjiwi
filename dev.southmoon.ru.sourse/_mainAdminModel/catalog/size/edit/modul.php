<?php


class catalog_size_edit_modul extends driver_modul_edit_tree {

	protected function init() {
		parent::init();

		$this->setDb('catalog_size_edit_db');

		// формы
		$form = $this->getForm();
		$this->setNewPos();
		$form->add('parent',	new cmfFormSelectInt());

		$form->add('name',	    new cmfFormTextarea(array('!empty', 'max'=>500)));
		$form->add('content',	new cmfFormTextareaWysiwyng('catalog/size', $this->getId()));
		$form->add('visible',	new cmfFormCheckbox());
	}

}

?>