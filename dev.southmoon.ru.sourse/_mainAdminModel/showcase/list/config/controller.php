<?php


class showcase_list_config_controller extends driver_controller_edit_param_of_record {


	protected function init() {
		parent::init();
		$this->addModul('main',	'showcase_list_config_modul');

		// url
		$this->setSubmitUrl(cmfPages::getMain());
	}

    public function getEmailVar() {
        return cmfModulLoad('_mail_var_db')->getNameList(null, array('var'));
	}

}


class showcase_list_config_modul extends driver_modul_edit_param_of_record {


    protected function init() {
        parent::init();

        $this->setDb('showcase_list_config_db');

        // �����
        $form = $this->getForm();
        $form->add('isAnimation',	new cmfFormCheckbox());
        $form->add('animationTime', new cmfFormText(array('max'=>255)));

        $form->add('productLimit',  new cmfFormSelectInt());
        $form->add('time',          new cmfFormText(array('max'=>255, '!empty')));
        $form->add('phone',         new cmfFormText(array('max'=>255, '!empty')));
        $form->add('email',         new cmfFormText(array('max'=>255, '!empty')));
        $form->add('network',       new cmfFormTextarea(array('max'=>2000, '!empty')));
        $form->add('logo',		    new cmfFormFile(array('path'=>cmfPathConfig)));

        $form->add('callBackOn',	new cmfFormCheckbox());
        $form->add('callBackNotice',new cmfFormTextareaWysiwyng('showcase', 'showcase'));
        $form->add('callBackType',  new cmfFormSelect());
        $form->add('callBackIsEmail',       new cmfFormCheckbox());
        $form->add('callBackTemplateEmail', new cmfFormSelect());
        $form->add('callBackTemplateSms',   new cmfFormTextarea(array('max'=>2000)));
        $form->add('callBackSms',       new cmfFormText(array('max'=>255)));
        $form->add('callBackSmsLimit',       new cmfFormTextInt());
	}

    public function loadForm() {
        $form = $this->getForm();

        foreach(array(4, 8, 12, 16) as $id) {
            $form->addElement('productLimit', $id, $id);
        }
        $form->addElement('callBackType', 'email', 'Почта');
        $form->addElement('callBackType', 'sms', 'sms');

        $name = cmfModulLoad('_mail_templates_list_db')->getNameList();
		$form->addElement('callBackTemplateEmail', '', 'Отсуствует');
		foreach($name as $k=>$v) {
            $form->addElement('callBackTemplateEmail', array($v['label'], $v['name']), $v['name']);
		}
	}

}


class showcase_list_config_db extends driver_db_edit_param_of_record {

}

?>