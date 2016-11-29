<?php


class payment_param_modul extends driver_modul_edit {

	protected function init() {
		parent::init();

		$this->setDb('payment_param_db');

		// формы
		$form = $this->getForm();
	}

	public function loadForm() {
		parent::loadForm();

		$modul = cmfModulLoad('payment_edit_db')->getFeildOfId('modul', $this->getId());
		cmfGlobal::set('modul', $modul);

		$form = $this->getForm();
        switch($modul) {
            case 'Sberbank':
                $form->add('name',		new cmfFormText(array('max'=>255, '!empty')));
                $form->add('fax',		new cmfFormText(array('max'=>255, '!empty')));
                $form->add('email',		new cmfFormText(array('max'=>255, '!empty')));
                $form->add('notice',	new cmfFormTextarea(array('max'=>255, '!empty')));
                $form->add('currentAccount', new cmfFormText(array('max'=>255, '!empty')));
                $form->add('bank',		new cmfFormText(array('max'=>255, '!empty')));
                $form->add('bik',		new cmfFormText(array('max'=>255, '!empty')));
                $form->add('ks',		new cmfFormText(array('max'=>255, '!empty')));
                $form->add('inn',		new cmfFormText(array('max'=>255, '!empty')));
                break;

            case 'robokassa':
                break;
        }
	}

}

?>