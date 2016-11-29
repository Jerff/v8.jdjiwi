<?php


class sms_inform_modul extends driver_modul_list {

	protected function init() {
		parent::init();

		$this->setDb('sms_inform_db');

		// �����
		$form = $this->getForm();
		$this->setNewPos();
		$form->add('status',	    new cmfFormSelect(array('!empty')));
		$form->add('notice',		new cmfFormTextarea());
		$form->add('visible',	    new cmfFormCheckbox());
	}

    public function loadForm() {
		$form = $this->getForm();
		$form->addElement('status', '',  'Выберите');
        $form->addElement('status', array('-----', 'newOrder'),  'Новый заказ');
        
        $name = cmfModulLoad('basket_status_list_db')->getNameList();
        foreach($name as $key=>$value)
            $form->addElement('status', array('Выставлен статус заказу', $key .'status'), $value['name']);        
	}
}

?>