<?php


class catalog_size_config_controller extends driver_controller_edit_param_of_record {


	protected function init() {
		parent::init();
		$this->addModul('main',	'catalog_size_config_modul');

		// url
		$this->setSubmitUrl(cmfPages::getMain());
	}

}

class catalog_size_config_modul extends driver_modul_edit_param_of_record {


    protected function init() {
        parent::init();

        $this->setDb('catalog_size_config_db');

        // формы
        $form = $this->getForm();
		$form->add('header',	new cmfFormTextareaWysiwyng('catalog/size', 0));
		$form->add('footer',	new cmfFormTextareaWysiwyng('catalog/size', 0));
    }


}


class catalog_size_config_db extends driver_db_edit_param_of_record {

}

?>