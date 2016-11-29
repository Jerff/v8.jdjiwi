<?php


class param_group_select_db extends driver_db_list {

	protected function getTable() {
		return db_param_group_select;
	}

	protected function getWhereFilter() {
		$filter = array();
		$filter['group'] = cmfAdminMenu::getSubMenuId();
		return $filter;
	}

	protected function startSaveWhere() {
		return array('group');
	}

	public function updateData($list, $send) {
		cmfUpdateCache::update('param');
	}
}

?>