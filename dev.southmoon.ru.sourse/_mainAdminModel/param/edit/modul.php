<?php


class param_edit_modul extends driver_modul_edit {

	protected function init() {
		parent::init();

		$this->setDb('param_edit_db');

		// формы
		$form = $this->getForm();

		$form->add('name',	    new cmfFormText(array('max'=>50, '!empty')));
		$form->add('header',	new cmfFormTextarea(array('max'=>50, '1!empty')));
		$form->add('style',	    new cmfFormText(array('max'=>25)));
		$form->add('prefix',	new cmfFormText(array('max'=>25)));
		$form->add('notice',	new cmfFormTextareaWysiwyng('param', $this->getId()));

		$form->add('type',	new cmfFormSelect(array('!empty')));
		$form->add('sort',	new cmfFormSelect());
		$form->add('visible',	new cmfFormCheckbox());
	}

	protected function updateIsErrorData($data, &$isError) {
		if(!empty($data['name'])) {
			$is = cmfRegister::getSql()->placeholder("SELECT 1 FROM ?t WHERE `name`=? AND id!=?", db_param, $data['name'], $this->getId())
										->numRows();
			if($is) {
				$this->getForm()->setError('name', 'Параметр "'. $data['name'] .'" уже существует!');
				$isError = true;
			}
		}
	}

	public function loadForm() {

		$form = $this->getForm();
		$form->addElement('type', '', 'Не выбрано');
		$form->addElement('type', 'text', 'text');
		$form->addElement('type', 'textarea', 'textarea');
		$form->addElement('type', 'select', 'select');
		$form->addElement('type', 'radio', 'radio');
		$form->addElement('type', 'checkbox', 'checkbox');
		$form->addElement('type', 'basket', 'Параметр для корзины (checkbox)');

		$form->addElement('sort', '', 'Обычная сортировка');
		$form->addElement('sort', 'size', 'Сортировка размеров');
	}

}

?>