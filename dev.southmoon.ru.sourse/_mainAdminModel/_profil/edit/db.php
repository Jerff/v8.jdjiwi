<?php


class _profil_edit_db extends driver_db_edit {

	protected function getTable() {
		return db_user;
	}

	public function save($send) {
		cmfModelAdmin::save($send, $this->getId());
		if(isset($send['name'])) {
			cmfAjax::get()->html('mainUserName', $send['name']);
        }
		$this->setUpdateData($send);
	}

	public function updateData($list, $send) {
	}

}

?>