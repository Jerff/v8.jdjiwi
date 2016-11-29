<?php


class subscribe_mail_list_controller extends driver_controller_list {

	protected function init() {
		parent::init();
		$this->addModul('main',	'subscribe_mail_list_modul');

		// url
		$this->setSubmitUrl('/admin/subscribe/mail/');
		$this->setEditUrl('/admin/subscribe/mail/edit/');
		$this->callFuncWriteAdd('setActive|changeFilter');
		$this->setUrl('user', '/admin/user/');
	}

	public function changeFilter() {
        $email = trim($this->getRequest()->getPost('email'));
        $opt = array();
        $opt['email'] = $email ? urlencode($email) : null;
		$this->getResponse()->redirect($this->getSubmitUrl($opt));
	}

	public function getUserUrl($user) {
		$opt['id'] = $user;
		return $this->getUrl('user', $opt);
	}
	public function listUser() {
		$res = $this->getSql()->placeholder("SELECT id, name, family FROM ?t WHERE id IN(SELECT user FROM ?t WHERE id ?@ GROUP BY `user`)", db_user, db_subscribe_mail, $this->getDataId())
								->fetchAssocAll('id');
		foreach($res as $k=>$v) {
		    $res[$k] = cmfUser::generateName($v);
		}
		return $res;
	}

	public function filterType() {
		$filter = model_subscribe::typeList();
		$filter[0]['name'] = 'Все';
		return parent::abstractFilterPart($filter, 'type', 'end');
	}

	public function delete($id) {
		$id = cmfModulLoad('subscribe_mail_edit_controller')->delete($id);
		return parent::delete($id);
	}


    public function getStatus($status) {
        if(!$this->getId()) return;
        return $this->getStatusHtml($status);
    }

    public function getStatusHtml($status) {
        $id = $this->getId();
        ob_start();
        switch($status) {
            case 'no':
                ?>Неактивирован<br><?=cmfAdminView::onclickType1("if(confirm('Активировать?')) modul.postAjax('setActive', $id);", 'Активировать') ?>
                <?
                break;

            case 'yes':
                ?>Активирован<?
                break;

            default:
                break;
        }
        return ob_get_clean();
    }

    protected function setActive($id) {
        $this->setId($id);
        $this->accessShop();
        cmfModulLoad('subscribe_mail_edit_db')->setActive();
        $this->getResponse()->html('#status'. $id, $this->getStatusHtml('yes'));
    }

}

?>