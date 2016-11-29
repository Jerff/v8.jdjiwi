<?php


class content_info_edit_modul extends driver_modul_edit_tree {

	protected function init() {
		parent::init();

		$this->setDb('content_info_edit_db');

		// формы
		$form = $this->getForm();
		$this->setNewPos();
		$form->add('parent',	new cmfFormSelectInt());
		$form->add('view',	    new cmfFormRadio());
		$form->add('viewMenu',	new cmfFormRadio());

		$form->add('uri',       new cmfFormText(array('uri'=>45)));

		$form->add('name',	    new cmfFormTextarea(array('!empty', 'max'=>500)));
		$form->add('content',	new cmfFormTextareaWysiwyng('info', $this->getId()));
		$form->add('visible',	new cmfFormCheckbox());

		$form->add('title',			new cmfFormTextarea(array('max'=>500)));
		$form->add('keywords',		new cmfFormTextarea(array('max'=>500)));
		$form->add('description',	new cmfFormTextarea(array('max'=>500)));
	}

	public function loadForm() {
		parent::loadForm();

		$form = $this->getForm();
		foreach(model_content_info::getListPage() as $k=>$v) {
            $form->addElement('view', $k, $v);
		}
        foreach(model_content_info::getViewMenu() as $k=>$v) {
            $form->addElement('viewMenu', $k, $v);
		}
	}

	protected function updateIsErrorData($data, &$isError) {
		$parent = $this->getForm()->handlerElement('parent');
		if(!$parent and isset($data['uri'])) {
			$isError |= $this->updateIsErrorDataUri('/info/', $data['uri'], 'name', 45, array('parent'=>$parent));
		}
	}

	protected function saveStart(&$send) {
		parent::saveStart($send);

		$parent = $this->getForm()->handlerElement('parent');
		parent::saveStartUri($send, 'name', 25, array('parent'=>$parent));
	}

}

?>