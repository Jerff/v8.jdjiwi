<?php


class content_content_edit_modul extends driver_modul_edit_tree {

	protected function init() {
		parent::init();

		$this->setDb('content_content_edit_db');

		// формы
		$form = $this->getForm();
        $this->setNewPos();
        $form->add('parent',    new cmfFormSelectInt());

        $form->add('uri',       new cmfFormText(array('uri'=>45)));

        $form->add('name',        new cmfFormTextarea(array('!empty', 'max'=>150)));
        $form->add('content',    new cmfFormTextareaWysiwyng('content', $this->getId()));
        $form->add('visible',    new cmfFormCheckbox());

		$form->add('title',			new cmfFormTextarea(array('max'=>500)));
		$form->add('keywords',		new cmfFormTextarea(array('max'=>500)));
		$form->add('description',	new cmfFormTextarea(array('max'=>500)));
	}

	protected function updateIsErrorData($data, &$isError) {
		$parent = $this->getForm()->handlerElement('parent');
		if(!$parent and isset($data['uri'])) {
			$isError |= $this->updateIsErrorDataUri('/content/', $data['uri'], 'name', 25, array('parent'=>$parent));
		}
	}

	protected function saveStart(&$send) {
		parent::saveStart($send);

		$parent = $this->getForm()->handlerElement('parent');
		parent::saveStartUri($send, 'name', 25, array('parent'=>$parent));
	}

}

?>