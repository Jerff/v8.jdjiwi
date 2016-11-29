<?php


class user_edit_db extends driver_db_edit {

	protected function getTable() {
		return db_user;
	}

	public function save($send) {
		$id = cmfUserModel::save($send, $this->getId());
		$this->saveSetId($id);
		$this->saveEnd($id, $send);
		$this->setUpdateData($send);
	}

	public function updateData($list, $send) {
	    if(isset($send['email'])) {
            list($subscribe, $shop) = cmfModulLoad('user_param_edit_db')->getFeildsId(array('subscribe', 'shop'), $this->getId());
            list($email) = cmfModulLoad('user_edit_db')->getFeildsId(array('email'), $this->getId());
            if($subscribe==='yes') {
                cmfSubscribe::addUser($email, $shop, $this->getId());
            } else {
                cmfSubscribe::delUser($this->getId());
            }
	    }
	}

	public function getUserStat($id) {
		$stat = array();
		$stat['Заказы']  = $this->getSql()->placeholder("SELECT count(`id`) FROM ?t WHERE user=?", db_basket, $id)
												->fetchRow(0);
		$row = $this->getSql()->placeholder("SELECT `userPay`, discount FROM ?t WHERE id=?", db_user_data, $id)
									->fetchAssoc();
		$stat['Оплачено'] = $row['userPay'] ? $row['userPay'] .'руб.' : 'нет';
		$stat['Скидка'] = $row['discount']==1 ? 'нет' : (1-$row['discount'])*100 .'%';
		return $stat;
	}

}

?>