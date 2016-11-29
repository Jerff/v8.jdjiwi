<?php


class _enter_modul extends driver_modul_edit {

	protected function init() {
		parent::init();

		// формы
		$form = $this->getForm();
		$form->add('loginMain',		new cmfFormText(array('min'=>2, 'max'=>40, '!empty', 'specialchars')));
		$form->add('passwordMain',	new cmfFormPassword(array('!empty')));
	}

	protected function runData() {
		return array();
	}


	protected function updateIsErrorData($data, &$isError) {
		if(empty($data['loginMain']) or empty($data['passwordMain'])) return;
		$admin = new cmfAdmin();
		if($admin->select($data['loginMain'], $data['passwordMain'])) {
			cmfAjax::get()->reload();
		} else {
			$isError = true;
			$this->getForm()->setError('loginMain', 'Логин или пароль не верны!');
		}
	}


	public function getJsSetData($update=false) {
		return parent::getJsSetData(false);
	}

}

?>