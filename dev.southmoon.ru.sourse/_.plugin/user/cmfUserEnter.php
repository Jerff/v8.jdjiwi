<?php

cmfLoad('ajax/cmfMainAjax');
cmfLoad('basket/cmfBasket');
class cmfUserEnter extends cmfMainAjax {

	function __construct($name='') {
		if(!$name) $name = cmfRegister::getRequest()->getGet('userName');
		switch($name) {
			case 'leftUserEnter':
				$name = 'leftUserEnter';
				//$this->set('errorHide', 1);
				break;

			case 'basket':
				$name = 'basket';
				break;

			default:
				$name = 'UserEnter';
				//$this->set('errorHide', null);
				break;
		}
		$this->set('type', $name);

		$formUrl = cmfControllerUrl .'/user/enter/?userName='. $name;
		$func = 'cmfAjaxSendForm';

		parent::__construct($formUrl, $name, $func);
	}


	protected function init() {
        $form = $this->getForm();

		$form->add('login',		new cmfFormText(array('!empty', 'email', 'specialchars')));
        $form->add('password',	new cmfFormPassword(array('!empty', 'default')));
	}



	public function run() {
		$data = $this->runStart();

		$is = cmfRegister::getUser()->select($data['login'], $data['password']);
		if($is) {
    		$url = cmfRegister::getRequest()->getPost('url');
            $index = cmfGetUrl('/index/');
    		if(strpos($url, $index)===0) {

    		} else
			switch($this->get('type')) {
				case 'basket':
					$url = cmfGetUrl('/basket/');
					break;

				default:
					$url = cmfGetUrl('/user/');
					break;
			}
			cmfAjax::get()->redirect($url);
		} else {
			$this->getForm()->setError('login', 'Неверен логин или пароль');
			$this->runEnd(true);
		}
	}

}

?>