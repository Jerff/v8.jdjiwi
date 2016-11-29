<?php


class basket_list_controller extends driver_controller_list {

	protected function init() {
		parent::init();
		$this->addModul('main',	'basket_list_modul');

		// url
		$this->setSubmitUrl('/admin/basket/');
		$this->setEditUrl('/admin/basket/edit/');
		$this->setUrl('print', '/admin/basket/printer/');
		$this->setUrl('user', '/admin/user/edit/');
		$this->callFuncWriteAdd('setType|changePay');
		$this->callFuncReadAdd('searchOrder');
	}

	protected function getLimitAll() {
		return array(5, 10, 15, 'all');
	}

	public function filterType() {
		$filter = array();
		$filter[1]['name'] = 'Заказ выполняется';
		$filter[2]['name'] = 'Заказ закончен';
		$filter[0]['name'] = 'Заказ отменен';
		$filter['all']['name'] = 'Все';
		return parent::abstractFilterPart($filter, 'status');
	}

	public function delete($id) {
		$id = cmfModulLoad('basket_edit_controller')->delete($id);
		return parent::delete($id);
	}

	public function getPrintUrl($opt=null) {
		$opt['id'] = $this->getId();
		return $this->getUrl('print', $opt);
	}
	public function getUserUrl($user) {
		$opt['id'] = $user;
		return $this->getUrl('user', $opt);
	}

	public function listUser() {
		$res = $this->getSql()->placeholder("SELECT id, name, family FROM ?t WHERE id IN(SELECT user FROM ?t WHERE id ?@ GROUP BY `user`)", db_user, db_basket, $this->getDataId())
								->fetchAssocAll('id');
		foreach($res as $k=>$v) {
		    $res[$k] = cmfUser::generateName($v);
		}
		return $res;
	}

	protected function deleteView($dataId) {
		if(!$this->getResponse()) return;
		$jsModul = $this->getJsModulName();
		foreach((array)$dataId as $id) {
			$this->getResponse()->addScript("{$jsModul}.deleteLine('". $this->getHtmlIdDel($id) ."');
                                             {$jsModul}.deleteLine('data_". $this->getHtmlIdDel($id) ."');");
		}
	}


	protected function searchOrder() {
        $number = $this->getRequest()->getPost('number');
        $is = cmfModulLoad('basket_edit_db')->getDataWhere(array('id'=>$number, 'AND', 'delete'=>'no'));
        if($is) {
            $this->getResponse()->addRedirect($this->getEditUrl(array('id'=>$number)));
        } else {
            $this->getResponse()->addScript("cmf.style.show('#searchError'); $('#searchError').html('Заказ не найден')");
        }
	}

	public function getStatus($data) {
		return cmfModulLoad('basket_edit_controller')->getStatus($data, $this->getModulName());
	}
	public function getCommand($id, $data) {
		return cmfModulLoad('basket_edit_controller')->getCommand($id, $data, $this->getModulName());
	}

	public function changePay($id) {
		cmfControllerOrder::changePay($id);
		$this->setNewView();
    }
	public function setType($id, $status) {
		if(false!==$stop = cmfControllerOrder::setType($id, $status)) {
			$this->setNewView();
		}
	}

}

?>