<?php


class delivery_delivery_modul extends driver_modul_list {

	protected function init() {
		parent::init();

		$this->setDb('delivery_delivery_db');

		// �����
		$form = $this->getForm();
		$this->setNewPos();
		$form->add('name',		    new cmfFormText(array('max'=>150)));
		$form->add('notice',		new cmfFormTextarea());
		$form->add('basket',		new cmfFormTextarea());
		$form->add('visible',	    new cmfFormCheckbox());
		$form->add('isDelivery',	new cmfFormCheckbox());
		$form->add('isContact',     new cmfFormCheckbox());
		$form->add('price',	        new cmfFormTextInt());
	}

}

?>