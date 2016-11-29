<?php


class content_pages_edit_modul extends driver_modul_edit {

	protected function init() {
		parent::init();

		$this->setDb('content_pages_edit_db');

		// формы
		$form = $this->getForm();
        $form->add('type',       new cmfFormSelect(array('!empty')));

        $form->add('adress',     new cmfFormText(array('max'=>250)));

        $form->add('name',       new cmfFormTextarea(array('!empty', 'max'=>150)));
        $form->add('content',    new cmfFormTextareaWysiwyng('content/pages', $this->getId()));
        $form->add('visible',    new cmfFormCheckbox());
	}

    public function loadForm() {
        parent::loadForm();

        $form = $this->getForm();
        $form->addElement('type', '', 'Отсуствует');
        foreach(model_content_pages::typeList() as $k=>$v) {
            $form->addElement('type', $k, $v['name']);
        }
        $form->select('type', '');
	}

	protected function saveStart(&$send) {
		parent::saveStart($send);
		if(isset($send['adress'])) {
			$send['isReg'] = preg_match('~\{\*\}~', $send['adress']) ? 'yes' : 'no';
		}
	}

}

?>