<?php


cmfLoad('ajax/cmfMainAjax');
class cmfSubscribeYes extends cmfMainAjax {

	function __construct($name='') {
		if(!$name) $name = cmfRegister::getRequest()->getGet('userName');
		switch($name) {
			case 'leftSubscribeYes':
				$name = 'leftSubscribeYes';
				break;

			default:
				$name = 'SubscribeYes';
		}

		$formUrl = cmfControllerUrl .'/subscribe/subscribeYes/?userName='. $name;
		$func = 'cmfAjaxSendForm';

		parent::__construct($formUrl, $name, $func);
	}


	protected function init() {
        $form = $this->getForm();

		if($this->getName()==='leftSubscribeYes') {
		    $form->add('email',		new cmfFormText(array('!empty', 'email', 'specialchars', 'errorHide')));
		} else {
		    $form->add('email',		new cmfFormText(array('!empty', 'email', 'specialchars')));
		}

	}

	public function run() {
		$data = $this->runStart();
        $email = $data['email'];


		$sql = cmfRegister::getSql();
		if(!$sql->placeholder("SELECT 1 FROM ?t WHERE email=? AND subscribe='yes'", db_subscribe_mail, $email)
		                            ->numRows()) {
			$data = array();
			$data['created'] = date('Y-m-d H:i:s');
			$data['type'] = '';
			$data['visible'] = 'no';
			$data['subscribe'] = 'no';
			$data['email'] = $email;
			$data['command'] = 'subscribeYes';
			$data['cod'] = $cod = sha1(rand(1, time()) . cmfSalt);
			$send = $data;

			$send['subscribeYesUrl'] = cmfGetUrl('/subscribe/command/', array("subscribeYes/email/". urlencode($email) ."/cod/$cod"));

            $cmfMail = new cmfMail();
            $cmfMail->sendTemplates('Рассылка: Запрос на подписку', $send, $email);
            $sql->add(db_subscribe_mail, $data, array('email'=>$email, 'AND', '1'));

            $idForm = $this->getIdForm();
            $idHash = $this->getIdHash();
            $js = "$('#{$idForm}FormDiv').html('<b>Запрос на подписку отправлен</b>');";
            cmfAjax::get()->addScript($js);
            die();
        } else {
            $this->getForm()->setError('email', 'Вы уже подписаны');
			$this->runEnd(true);
		}
	}


	public function run1ok($email, $cod) {
		if(!$email or !$cod) {
			$this->runExit('error');
		}
		$sql = cmfRegister::getSql();
		if($sql->placeholder("SELECT 1 FROM ?t WHERE email=? AND command='subscribeYes' AND cod=?", db_subscribe_mail, $email, $cod)
		                            ->numRows()) {
			$data = array();
			$data['visible'] = 'yes';
			$data['subscribe'] = 'yes';
			$data['command'] = '';
			$data['cod'] = '';
			$sql->add(db_subscribe_mail, $data, array('email'=>$email));

			$send = array('email'=>$email);
			$cmfMail = new cmfMail();
			$cmfMail->sendTemplates('Рассылка: Подписка завершена', $send, $email);
			$this->runExit('ok');
		} else {
			$this->runExit('error');
		}
	}


	protected function runExit($command) {
		$url = cmfGetUrl('/subscribe/command/', array("subscribeYes/action/{$command}"));
		cmfRedirect($url);
	}

}

?>