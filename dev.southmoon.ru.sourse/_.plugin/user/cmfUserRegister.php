<?php

cmfLoad('contact/cmfContact');
cmfLoad('subscribe/cmfSubscribe');
cmfLoad('ajax/cmfMainAjax');
cmfLoad('user/model/cmfUserModel');
class cmfUserRegister extends cmfMainAjax {


	function __construct($name=null, $formUrl=null, $func=null) {
		switch($name ? $name : $name=cmfRegister::getRequest()->getGet('name')) {
			case 'fancyboxUserRegister':
				break;

			default:
				$name = 'userRegister';
				break;
		}
		if(!$formUrl)	$formUrl = cmfControllerUrl .'/user/register/?name='. $name;
		if(!$func)		$func = 'cmfAjaxSendForm';

		parent::__construct($formUrl, $name, $func, 2);
	}


	protected function init() {
		$form = $this->getForm(1);
    	$form->add('name',		        new cmfFormText(array('name'=>'Имя', '!empty', 'specialchars', 'max'=>250)));
		$form->add('family',		    new cmfFormText(array('name'=>'Фамилия', '!empty', 'specialchars', 'max'=>250)));
    	$form->add('login',		        new cmfFormText(array('name'=>'E-mail', '!empty', 'email', 'min'=>6, 'max'=>100)));
		$form->add('password',	        new cmfFormPasswordView(array('!empty', 'name'=>'Пароль', 'confirmName'=>'userPasssword')));
		$form->add('password2',	        new cmfFormPasswordView(array('!empty', 'confirmName'=>'userPasssword')));
		//$form->add('captcha',		    new cmfFormKcaptcha());


		$form = $this->getForm(2);
        $form->add('cod',		    new cmfFormText(array('errorHide1', 'phoneCod', 'min'=>4, 'max'=>4)));
		$form->add('phone',		    new cmfFormText(array('errorHide1', 'name'=>'Телефон', 'phonePostPrefix', 'min'=>7, 'max'=>7)));
	}


	public function run1() {
		$isActivate = cmfConfig::get('user', 'isActivate');

		list($userData, $userValue) = $this->runStart();
		//$this->getForm()->get('captcha')->free();

		$response = cmfAjax::get();
        if(!cmfUserModel::isNew($userData['login'])) {
            $this->getForm()->setError('login', 'Такой пользователь уже существует');
            $this->runEnd(true);
        }

		if(!$userId = $this->register($userData, $userValue, $isActivate)) {
			$this->getForm()->setError('login', 'Пользователь не добавлен');
            $this->runEnd(true);
		}

		if($isActivate) {
			$content = cmfRegister::getSql()->placeholder("SELECT content FROM ?t WHERE name='Личный кабинет: Регистрация (с активацией)'", db_content_static)
												->fetchRow(0);
		} else {
            cmfRegister::getUser()->select($userData['login'], $userData['password']);
			$response->redirect(cmfGetUrl('/user/'));
		}

		$idHash = $this->getIdHash();
		$response->hash("userRegisterHash")
		         ->html($this->getIdForm(), $content);
	}

	public function register($user, $userData, $isActivate=false) {
		$login = $user['login'];
        $password = $user['password'];
        $user['email'] = $email = $user['login'];

		$userMail = array();
		$userMail['login'] = $user['login'];
		$userMail['password'] = $user['password'];
		$userMail['name'] = cmfUser::generateName($user);

		if($isActivate) {
			$user['registerCommand'] = 'register';
			$user['registerCod'] = $cod = sha1(rand(1, time()) . cmfSalt);

			$user['register'] = 'no';
			$user['visible'] = 'no';
		} else {

			$user['register'] = 'yes';
			$user['visible'] = 'yes';
            $user['registerCommand'] = '';
		}

		$id = cmfUserModel::save($user);
		if(!$id) return false;

		if($userData) {
			cmfUserModel::saveParam($userData, $id);
		}

		if(!empty($userData['cod'])) $userData['phone'] = $userData['cod'] .' '. $userData['phone'];
		$userMail['data'] = cmfFormtaArray(array_merge($this->getForm(1)->processingName($user),
		                                               $this->getForm(2)->processingName($userData)));
		$userMail['adminUrl'] = cmfProjectAdmin .'#/user/edit/&id='. $id;


		if($isActivate) {
			$userMail['activateUrl'] = cmfGetUrl('/user/command/', array('userRegister/user/'. $id .'/cod/'. $cod));

			$cmfMail = new cmfMail();
			$cmfMail->sendType('userNew', 'Личный кабинет: Регистрация: Письмо админу (с активацией)', $userMail);
			$cmfMail->sendTemplates('Личный кабинет: Регистрация (c активацией)', $userMail, $email);
		} else {
			$cmfMail = new cmfMail();
			$cmfMail->sendType('userNew', 'Личный кабинет: Регистрация: Письмо админу (без активации)', $userMail);
			$cmfMail->sendTemplates('Личный кабинет: Регистрация (без активации)', $userMail, $email);
		}
		return $id;
	}


	public static function userActivate($id, $cod) {
        if(!$id or !$cod) {
        	self::runExit('error');
        }

		$row = cmfRegister::getSql()->placeholder("SELECT email, name, login, registerCommand, register FROM ?t WHERE id=? AND registerCod=?", db_user, $id, $cod)
										->fetchAssoc();
		if(!$row) {
            self::runExit('error');
		}
		if($row['registerCommand']!=='register' or $row['register']==='yes') {
			self::runExit('error');
		}
		cmfRegister::getSql()->add(db_user, array('registerCommand'=>'', 'register'=>'yes', 'visible'=>'yes'), $id);

		$cmfMail = new cmfMail();
		$cmfMail->sendTemplates('Личный кабинет: Активация', $row, $row['email']);
		self::runExit('ok');
	}


	protected static function runExit($command) {
		$url = cmfGetUrl('/user/command/', array('userRegister/action/'. $command));
		cmfRedirect($url);
	}


}

?>