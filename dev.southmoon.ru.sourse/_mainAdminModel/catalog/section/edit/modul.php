<?php


class catalog_section_edit_modul extends driver_modul_edit_tree {

	protected function init() {
		parent::init();

		$this->setDb('catalog_section_edit_db');

		// формы
		$form = $this->getForm();
		$this->setNewPos();

		$form->add('parent',		new cmfFormSelectInt());

		$form->add('uri',		    new cmfFormText(array('uri'=>25)));

		$form->add('name',	        new cmfFormTextarea(array('!empty', 'max'=>150)));
		$form->add('stop',	        new cmfFormTextarea(array('max'=>150)));
		$form->add('sizeUrl',	    new cmfFormText(array('max'=>250)));
		$form->add('visible',	    new cmfFormCheckbox());

		$form->add('title',			new cmfFormTextarea(array('max'=>500)));
		$form->add('keywords',		new cmfFormTextarea(array('max'=>500)));
		$form->add('description',	new cmfFormTextarea(array('max'=>500)));
	}


	protected function updateIsErrorData($data, &$isError) {
		$parent = $this->getForm()->handlerElement('parent');
		if(isset($data['uri']) or isset($data['parent'])) {
			if(isset($data['parent'])) {
				$isUri = $data['parent'] ? $this->getDb()->getIsUri($data['parent']) : '';
			} else {
				$isUri = $this->getId() ? $this->getDb()->getParentIsUri($this->getId()) : '';
			}
			$isUri = $isUri ? $isUri .'/'. $data['uri'] : $data['uri'];
			if(cmfContentUrl::isUrlExists('/section/', $this->getId(), 0, 0, $isUri)) {
				$this->getForm()->setError('uri', 'Адрес "/'. $isUri .'/" уже занят!');
				$isError = true;
			}
		}
	}

	protected function saveStart(&$send) {
		parent::saveStart($send);

		$parent = $this->getForm()->handlerElement('parent');
		parent::saveStartUri($send, 'name', 25, array('parent'=>$parent));
	}

}

?>