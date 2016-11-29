<?php


class subscribe_history_list_db extends driver_db_list {

	public function returnParent() {
		return 'subscribe_history_edit_db';
	}

	protected function getTable() {
		return db_subscribe_history;
	}

	protected function getSort() {
		return array('date'=>'DESC');
	}

    protected function getWhereFilter() {
		return array('subscribe'=> cmfAdminMenu::getSubMenuId());
	}

	protected function getWhereId($list) {
		return array('id'=>$list, 'AND', 'subscribe'=> cmfAdminMenu::getSubMenuId());
	}
    
	protected function getFields() {
		return array('id', 'date', 'header', 'email');
	}

	public function loadData(&$row) {
		$row['date'] = date("d.m.Y H:i", strtotime($row['date']));
		parent::loadData($row);
	}

}

?>