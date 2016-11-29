<?php


class param_config_modul extends driver_modul_edit_param_of_record {


	protected function init() {
		parent::init();

		$this->setDb('param_config_db');

		// формы
		$form = $this->getForm();
		$form->add('priceStep',	new cmfFormTextInt());
	}

}

?>