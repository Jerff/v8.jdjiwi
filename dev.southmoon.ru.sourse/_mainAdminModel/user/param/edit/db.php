<?php


class user_param_edit_db extends driver_db_edit {

	protected function getTable() {
		return db_user_data;
	}

	public function updateData($list, $send) {
	    if(isset($send['subscribe']) or isset($send['shop'])) {
            list($subscribe, $shop) = cmfModulLoad('user_param_edit_db')->getFeildsId(array('subscribe', 'shop'), $this->getId());
            list($email) = cmfModulLoad('user_edit_db')->getFeildsId(array('email'), $this->getId());
            if($subscribe==='yes') {
                cmfSubscribe::addUser($email, $shop, $this->getId());
            } else {
                cmfSubscribe::delUser($this->getId());
            }
	    }
	}

}

?>