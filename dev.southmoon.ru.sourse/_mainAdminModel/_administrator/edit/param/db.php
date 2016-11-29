<?php


class _administrator_edit_param_db extends driver_db_edit {

	protected function getTable() {
		return db_user_data;
	}

	public function updateData($list, $send) {
	}
	public function setNotFount() {
	}
}

?>