<?php


class subscribe_mail_edit_modul extends driver_modul_edit {

	protected function init() {
		parent::init();

		$this->setDb('subscribe_mail_edit_db');

		// формы
		$form = $this->getForm();
		$form->add('type',		new cmfFormSelect());
		$form->add('email',		new cmfFormText(array('max'=>255, '!empty', 'email')));
		$form->add('subscribe',	new cmfFormCheckbox());
	}

    public function loadForm() {
        parent::loadForm();

        $form = $this->getForm();
        $name = model_subscribe::typeList();
        $form->addElement('type', '', 'Все');
        foreach($name as $k=>$v) {
            $form->addElement('type', $k, $v['name']);
        }
        $form->select('type', $this->getFilter('type'));
	}

	protected function updateIsErrorData($data, &$isError) {
		if(!empty($data['email'])) {
			$res = $this->getSql()->placeholder("SELECT 1 FROM ?t WHERE `id`!=? AND `type`=? AND `email`=?", db_subscribe_mail, $this->getId(), $data['type'], $data['email']);
			if($res->numRows()) {
				$isError = true;
				$this->getForm()->setError('email', 'Email уже существует в базе');
			}
		}
		return $isError;
	}

	protected function saveStart(&$send) {
		parent::saveStart($send);
		if(!$this->getId()) {
			$send['created'] = date('Y-m-d H:i:s');
			$send['visible'] = 'yes';
		}
	}

}

?>