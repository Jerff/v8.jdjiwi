<?php


class delivery_config_modul extends driver_modul_edit_param_of_record {


    protected function init() {
        parent::init();

        $this->setDb('delivery_config_db');

		// формы
		$form = $this->getForm();
		$form->add('basket',	    new cmfFormTextarea());
	}

}
class delivery_config_controller extends driver_controller_edit_param_of_record {


	protected function init() {
		parent::init();
		$this->addModul('main',	'delivery_config_modul');

		// url
		$this->setSubmitUrl(cmfPages::getMain());
	}

}
class delivery_config_db extends driver_db_edit_param_of_record {

}

?>