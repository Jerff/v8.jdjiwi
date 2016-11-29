<?php


class subscribe_edit_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'subscribe_edit_modul');

		// url
		$this->setSubmitUrl('/admin/subscribe/edit/');
		$this->setCatalogUrl('/admin/subscribe/');
		$this->callFuncWriteAdd('mailStart|mailContinue|mailReset|mailStop|mailTest');
	}

    public function delete($id) {
		$id = parent::delete($id);
        cmfModulLoad('subscribe_history_view_controller')->deleteSubscribe($id);
		$this->getSql()->del(db_subscribe_status, array('subscribe'=>$id));
		return $id;
	}

    public function getStatus($status) {
        return $this->getStatusHtml($status);
    }

    public function getStatusHtml($status) {
        ob_start();
        switch($status) {
            case 'неактивна':
                ?>Неактивна<br><?=cmfAdminView::onclickType1("if(confirm('Активировать?')) modul.postAjax('mailStart');", 'Активировать') ?>
                <?
                break;

            case 'активна':
                ?>Активна<br><?=cmfAdminView::onclickType1("if(confirm('Остановить?')) modul.postAjax('mailStop');", 'Остановить') ?>
                <?
                break;

            case 'остановлена':
                ?>Остановлена
                <br><?=cmfAdminView::onclickType1("if(confirm('Продолжить?')) modul.postAjax('mailContinue');", 'Продолжить') ?>
                <br><?=cmfAdminView::onclickType1("if(confirm('Начать заново?')) modul.postAjax('mailReset');", 'Начать заново') ?>
                <?
                break;

            case 'закончена':
                ?>Закончена
                <br><?=cmfAdminView::onclickType1("if(confirm('Повторить?')) modul.postAjax('mailReset');", 'Повторить') ?>
                <?
                break;

            default:
                break;
        }
        return ob_get_clean();
    }

    protected function mailIsRun() {
        $this->update();
        $this->run();
        $data = $this->getModul()->getData();
        if($data['type']==='user' and empty($data['email'])) {
            $this->getResponse()->alert('Заполните адреса получателей');
            exit;
        }
    }

    protected function mailStart() {
        $this->mailIsRun();
        $this->getModul()->getDB()->mailStart();;
        $this->getResponse()->html('#status', $this->getStatusHtml('активна'));
    }

    protected function mailContinue() {
        $this->mailIsRun();
        $this->getModul()->getDB()->mailContinue();;
        $this->getResponse()->html('#status', $this->getStatusHtml('активна'));
    }

    protected function mailReset() {
        $this->mailIsRun();
        $this->getModul()->getDB()->mailReset();;
        $this->getResponse()->html('#status', $this->getStatusHtml('активна'));
	}

	protected function mailStop() {
        $this->getModul()->getDB()->mailStop();;
        $this->getResponse()->html('#status', $this->getStatusHtml('остановлена'));
	}

	protected function mailTest() {
        $email = cmfConfig::read('subscribe', 'email');
        $send = $this->getModul()->getForm()->handler();

        $cmfMail = new cmfMail();
        $cmfMail->sendHTML($email, $send['header'], $send['content']);

        $this->getResponse()->alert('Письмо отправлено');
	}

}

?>