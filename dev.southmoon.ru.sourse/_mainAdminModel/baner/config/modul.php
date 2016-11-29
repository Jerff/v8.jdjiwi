<?php


class baner_config_modul extends driver_modul_edit_param_of_record {


	protected function init() {
		parent::init();

		$this->setDb('baner_config_db');

		// формы
		$form = $this->getForm();
		$form->add('time',	new cmfFormSelectInt());
	}

    public function loadForm() {
        $form = $this->getForm();

        for($id=5; $id<=120; $id+=5) {
            $form->addElement('time', $id, $id);
        }
	}

}

?>