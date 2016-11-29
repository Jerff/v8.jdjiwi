<?php

cmfLoad('ajax/cmfMainAjax');
cmfLoad('basket/sms/cmfSmsInform');
cmfLoad('limit/cmfLimit');
class cmfCallBack extends cmfMainAjax {

	function __construct($name='') {
		$name = 'callBack';
		$formUrl = cmfControllerUrl .'/form/call-back/?';
		$func = 'cmfAjaxSendForm';

		parent::__construct($formUrl, $name, $func);
        $this->loadData();
	}

	protected function init() {
        $form = $this->getForm();
        $form->setOption('color', '#ff7a7a');
		$form->add('name',		new cmfFormText(array('name'=>'Контактное лицо', '!empty', 'specialchars')));
        $form->add('cod',		new cmfFormText(array('errorHide1', '!empty', 'phoneCod', 'min'=>4, 'max'=>4)));
		$form->add('phone',		new cmfFormText(array('errorHide1', '!empty', 'name'=>'Телефон', 'phonePostPrefix', 'min'=>7, 'max'=>7)));
        $form->add('title',     new cmfFormTextarea(array('name'=>'Вопрос', '!empty', 'specialchars', 'max'=>255)));

        if($this->isCaptcha()) {
            $form->add('captcha',	new cmfFormKcaptcha());
        }
	}

	public function loadData() {
        $this->getForm()->selectAll(cmfRegister::getUser()->all);
	}

    public function isCaptcha() {
        return cmfConfig::get('showcase', 'callBackType')==='sms';
    }

    public function isOn() {
        return cmfConfig::get('showcase', 'callBackOn')==='yes';
    }

	public function run() {
        if(!$this->isOn()) return;
		$data = $this->runStart();

        $data['phone'] = $data['cod'] . $data['phone'];
//        $data['phone'] = $data['cod'] .'-'. $data['phone'];
		$data2 = $this->getForm()->processingName($data);

		$userMail = $data;
        $userMail['data'] = cmfFormtaArray($data2);

        $isSmsLimit = false;
        if(cmfConfig::get('showcase', 'callBackType')==='sms') {
            $phone = cmfConfig::get('showcase', 'callBackSms');
            $message = cmfConfig::get('showcase', 'callBackTemplateSms');

            if(!empty($phone) and !empty($message)) {
                if(cmfLimit::is('showcase', cmfConfig::get('showcase', 'callBackSmsLimit'))) {
                    cmfLimit::add('showcase');
                    $sms = new cmfSmsInform();
                    $sms->send(cmfConfig::get('showcase', 'callBackSms'),
                            cmfConfig::get('showcase', 'callBackTemplateSms'),
                            $userMail);

                } else {
                    $isSmsLimit = true;
                }
            }
        }

        if($isSmsLimit
            or (cmfConfig::get('showcase', 'callBackType')==='email')
            or (cmfConfig::get('showcase', 'callBackType')==='sms' and cmfConfig::get('showcase', 'callBackIsEmail')==='yes')) {

            $cmfMail = new cmfMail();
            $cmfMail->sendType('callback', cmfConfig::get('showcase', 'callBackTemplateEmail'), $userMail);
        }

        if($this->isCaptcha()) {
            $this->getForm()->get('captcha')->free();
        }
        cmfAjax::get()->html($this->getIdForm(), '<b>Заявка&nbsp;отправлена</b>');
	}

	protected function runError($error=null) {
		parent::runError($error);
		cmfAjax::get()->script("cmf.main.fancybox.reView();");
	}

}

?>