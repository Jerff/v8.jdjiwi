<?php


class subscribe_list_controller extends driver_controller_list {

	protected function init() {
		parent::init();
		$this->addModul('main',	'subscribe_list_modul');

		// url
		$this->setSubmitUrl('/admin/subscribe/');
		$this->setEditUrl('/admin/subscribe/edit/');
		$this->callFuncWriteAdd('mailStart|mailContinue|mailReset|mailStop');

	}

	public function delete($id) {
		$id = cmfModulLoad('subscribe_edit_controller')->delete($id);
		return parent::delete($id);
	}

	public function filterType() {
		$filter = array();
        $filter['all']['name'] = 'Обычная рассылка';
		foreach(model_subscribe::typeList() as $k=>$v) {
            $filter[$k]['name'] = 'Обычная рассылка -> '. $v['name'];
        }
        
		$filter['user']['name'] = 'Произвольная рассылка';
		$filter[0]['name'] = 'Все';
		return parent::abstractFilterPart($filter, 'type', 'end');
	}

    public function getStatus($status) {
        if(!$this->getId()) return;
        return $this->getStatusHtml($status);
    }

    public function getStatusHtml($status) {
        $id = $this->getId();
        ob_start();
        switch($status) {
            case 'неактивна':
                ?>Неактивна<br><?=cmfAdminView::onclickType1("if(confirm('Активировать?')) modul.postAjax('mailStart', $id);", 'Активировать') ?>
                <?
                break;

            case 'активна':
                ?>Активна<br><?=cmfAdminView::onclickType1("if(confirm('Остановить?')) modul.postAjax('mailStop', $id);", 'Остановить') ?>
                <?
                break;

            case 'остановлена':
                ?>Остановлена
                <br><?=cmfAdminView::onclickType1("if(confirm('Продолжить?')) modul.postAjax('mailContinue', $id);", 'Продолжить') ?>
                <br><?=cmfAdminView::onclickType1("if(confirm('Начать заново?')) modul.postAjax('mailReset', $id);", 'Начать заново') ?>
                <?
                break;

            case 'закончена':
                ?>Закончена
                <br><?=cmfAdminView::onclickType1("if(confirm('Повторить?')) modul.postAjax('mailReset', $id);", 'Повторить') ?>
                <?
                break;

            default:
                break;
        }
        return ob_get_clean();
    }

    protected function mailStart($id) {
        $this->setId($id);
        cmfModulLoad('subscribe_edit_db')->mailStart();
        $this->getResponse()->html('#status'. $id, $this->getStatusHtml('активна'));
    }

    protected function mailContinue($id) {
        $this->setId($id);
        cmfModulLoad('subscribe_edit_db')->mailContinue();
        $this->getResponse()->html('#status'. $id, $this->getStatusHtml('активна'));
    }

    protected function mailReset($id) {
        $this->setId($id);
        cmfModulLoad('subscribe_edit_db')->mailReset();
        $this->getResponse()->html('#status'. $id, $this->getStatusHtml('активна'));
	}

	protected function mailStop($id) {
        $this->setId($id);
        cmfModulLoad('subscribe_edit_db')->mailStop();
        $this->getResponse()->html('#status'. $id, $this->getStatusHtml('остановлена'));
	}

}

?>