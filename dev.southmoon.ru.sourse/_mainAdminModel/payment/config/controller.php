<?php


class payment_config_modul extends driver_modul_edit_param_of_record {


    protected function init() {
        parent::init();

        $this->setDb('payment_config_db');

		// формы
		$form = $this->getForm();
		$form->add('notice',	new cmfFormTextareaWysiwyng('payment/config', $this->getId()));
		$form->add('payment',	new cmfFormTextareaWysiwyng('payment/config', $this->getId()));
	}

/*    public function loadForm() {
        parent::loadForm();

        $form = $this->getForm();
        $name = cmfModulLoad('content_info_list_db')->getNameList();
		$form->addElement('pageInfo', 0, 'Отсуствует');
		foreach($name as $k=>$v) {
            $form->addElement('pageInfo', $k, $v['name']);
		}
    }*/

}
class payment_config_controller extends driver_controller_edit_param_of_record {


	protected function init() {
		parent::init();
		$this->addModul('main',	'payment_config_modul');

		// url
		$this->setSubmitUrl(cmfPages::getMain());
	}

}
class payment_config_db extends driver_db_edit_param_of_record {

}

?>