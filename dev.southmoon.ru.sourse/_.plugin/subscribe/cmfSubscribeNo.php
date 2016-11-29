<?php


cmfLoad('ajax/cmfMainAjax');
class cmfSubscribeNo extends cmfMainAjax {

	function __construct() {
		$name = 'subscribeNo';
        $formUrl = cmfControllerUrl .'/subscribe/subscribeNo/?';
        $func = 'cmfAjaxSendForm';

        parent::__construct($formUrl, $name, $func);
    }


    protected function init() {
        $form = $this->getForm();

        $form->add('email',        new cmfFormText(array('!empty', 'email', 'specialchars')));
    }

    public function run() {
        $data = $this->runStart();
        $email = $data['email'];

        $sql = cmfRegister::getSql();
        if($sql->placeholder("SELECT 1 FROM ?t WHERE email=? AND subscribe='yes'", db_subscribe_mail, $email)
                                    ->numRows()) {

            $data = array();
            $data['command'] = 'subscribeNo';
            $data['cod'] = $cod = sha1(rand(1, time()) . cmfSalt);
            $send = $data;

            $send['subscribeNoUrl'] = cmfGetUrl('/subscribe/command/', array("subscribeNo/email/". urlencode($email) ."/cod/$cod"));
            $send['email'] = $email;

            $cmfMail = new cmfMail();
            $cmfMail->sendTemplates('Рассылка: Запрос на отписку', $send, $email);
            $sql->add(db_subscribe_mail, $data, array('email'=>$email));

            $idForm = $this->getIdForm();
            $js = "$('#{$idForm}FormDiv').html('<b>Запрос на отписку отправлен</b>');";
            cmfAjax::get()->addScript($js);
            die();
        } else {
            $this->getForm()->setError('email', 'Вы не подписаны');
            $this->runEnd(true);
        }
    }


    public function run1ok($email, $cod) {
        if(!$email or !$cod) {
            $this->runExit('error');
        }
        $sql = cmfRegister::getSql();
        if($sql->placeholder("SELECT 1 FROM ?t WHERE email=? AND command='subscribeNo' AND cod=?", db_subscribe_mail, $email, $cod)
                                    ->numRows()) {
            $sql->del(db_subscribe_mail, array('email'=>$email));

            $send = array('email'=>$email);
            $cmfMail = new cmfMail();
            $cmfMail->sendTemplates('Рассылка: Отписка завершена', $send, $email);
            $this->runExit('ok');
        } else {
            $this->runExit('error');
        }
    }


    protected function runExit($command) {
        $url = cmfGetUrl('/subscribe/command/', array("subscribeNo/action/{$command}"));
        cmfRedirect($url);
    }

}

?>