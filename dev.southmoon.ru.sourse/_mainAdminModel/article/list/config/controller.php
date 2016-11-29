<?php


class article_list_config_controller extends driver_controller_edit_param_of_record {


	protected function init() {
		parent::init();
		$this->addModul('main',	'article_list_config_modul');

		// url
		$this->setSubmitUrl(cmfPages::getMain());
	}

}

class article_list_config_modul extends driver_modul_edit_param_of_record {


    protected function init() {
        parent::init();

        $this->setDb('article_list_config_db');

        // формы
        $form = $this->getForm();
        $form->add('articleMain',        new cmfFormSelectInt());
        $form->add('articleSection',    new cmfFormSelectInt());
        $form->add('articleLimit',        new cmfFormSelectInt());
        $form->add('articlePage',        new cmfFormSelectInt());
    }

    public function loadForm() {
        $form = $this->getForm();

         foreach(array(5, 10, 15, 20) as $id) {
            $form->addElement('articleLimit', $id, $id);
        }

        foreach(array(2, 4, 6) as $id) {
            $form->addElement('articleMain', $id, $id);
        }

        for($id=2; $id<=15; $id++) {
            $form->addElement('articleSection', $id, $id);
        }

        for($id=3; $id<=15; $id++) {
            $form->addElement('articlePage', $id, $id);
        }
	}

}


class article_list_config_db extends driver_db_edit_param_of_record {

}

?>