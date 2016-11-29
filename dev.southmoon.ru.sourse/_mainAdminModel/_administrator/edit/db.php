<?php


class _administrator_edit_db extends driver_db_edit {

	protected function getTable() {
		return db_user;
	}

	public function save($send) {
		$id = cmfAdminModel::save($send, $this->getId());
		$this->saveSetId($id);
		if(cmfRegister::getAdminId()==$id) {
            if(isset($send['name'])) {
				cmfAjax::get()->html('mainUserName', $send['name']);
            }
            if(isset($send['login']) or isset($send['password']) or isset($send['admin'])) {
            	$this->setReload();
			}
		}
		$this->saveEnd($id, $send);
		$this->setUpdateData($id, $send);
	}

	public function updateData($list, $send) {
	}

}

?>