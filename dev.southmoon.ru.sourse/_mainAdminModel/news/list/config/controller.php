<?php


class news_list_config_controller extends driver_controller_edit_param_of_record {


	protected function init() {
		parent::init();
		$this->addModul('main',	'news_list_config_modul');

		// url
		$this->setSubmitUrl(cmfPages::getMain());
	}

}

class news_list_config_modul extends driver_modul_edit_param_of_record {


    protected function init() {
        parent::init();

        $this->setDb('news_list_config_db');

        // формы
        $form = $this->getForm();
        $form->add('newsMain',        new cmfFormSelectInt());
        $form->add('newsLimit',        new cmfFormSelectInt());
        $form->add('newsPage',        new cmfFormSelectInt());
    }

    public function loadForm() {
        $form = $this->getForm();

         foreach(array(5, 10, 15, 20) as $id) {
            $form->addElement('newsLimit', $id, $id);
        }

        foreach(array(3, 6, 9) as $id) {
            $form->addElement('newsMain', $id, $id);
        }

        for($id=3; $id<=15; $id++) {
            $form->addElement('newsPage', $id, $id);
        }
	}

}


class news_list_config_db extends driver_db_edit_param_of_record {

}

?>