<?php

cmfLoad('ajax/cmfMainAjax');
class cmfFeedback extends cmfMainAjax {

	function __construct($productId=0, $name='') {
		$this->set('$productId', $productId);

		if(!$name) $name = cmfRegister::getRequest()->getGet('userName');
		switch($name) {
			case 'leftFeedback':
				$name = 'leftFeedback';
				break;

			default:
				$name = 'feedback';
				break;
		}
		$this->set('type', $name);
		$formUrl = cmfControllerUrl .'/form/feedback/?userName='. $name .'&productId='. $productId;
		$func = 'cmfAjaxSendForm';

		parent::__construct($formUrl, $name, $func);
	}

	public function getIdForm() {
		return $this->getName() . $this->get('type');
	}

	protected function init() {
        $form = $this->getForm();
        $form->setOption('color', '#ff7a7a');
		$form->add('name',		new cmfFormText(array('name'=>'Контактное лицо', '!empty', 'specialchars')));
		$form->add('email',		new cmfFormText(array('name'=>'E-mail', '!empty', 'email', 'specialchars')));
        $form->add('notice',	new cmfFormTextarea(array('name'=>'Вопрос', '!empty', 'specialchars', 'max'=>1000)));
        //$form->add('captcha',	new cmfFormKcaptcha());
	}

	public function run() {
		$data = $this->runStart();

		$data2 = $this->getForm()->processingName($data);
		$userMail = array();
        if($this->get('$productId')) {
            $product = cmfRegister::getSql()->placeholder("SELECT u.url, p.name FROM ?t p LEFT JOIN ?t u ON(u.product=p.id) WHERE u.product=p.id AND p.id=? AND visible='yes'", db_product, db_product_url, $this->get('$productId'))
    				                        ->fetchAssoc();
            $data2['======'] = ' ';
            $data2['Товар'] = $product['name'];
            $data2['Ссылка'] = cmfGetUrl('/product/', array($product['url']));
        }

		$userMail['data'] = cmfFormtaArray($data2);


		$cmfMail = new cmfMail();
		$cmfMail->sendType('callback', 'Формы: Обратная Связь: Письмо менеджеру', $userMail);
        //$this->getForm()->get('captcha')->free();
        cmfAjax::get()->html($this->getIdForm(), '<b>Заявка&nbsp;отправлена</b>');
	}

	protected function runError($error=null) {
		parent::runError($error);
		cmfAjax::get()->script("cmf.main.fancybox.reView();");
	}

}

?>