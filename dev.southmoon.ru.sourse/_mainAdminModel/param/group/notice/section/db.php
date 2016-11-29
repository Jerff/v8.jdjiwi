<?php


class param_group_notice_section_db extends driver_db_edit {

	protected function getTable() {
		return db_section;
	}

	public function getId() {
		return cmfAdminMenu::getSubMenuId();
	}

}

?>