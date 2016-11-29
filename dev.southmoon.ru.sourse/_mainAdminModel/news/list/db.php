<?php


class news_list_db extends driver_db_list {

	public function returnParent() {
		return 'news_edit_db';
	}

	protected function getTable() {
		return db_news;
	}

	protected function getSort() {
		return array('isMain'=>'ASC', 'date'=>'DESC');
	}

	protected function getFields() {
		return array('id', 'date', 'header', 'uri', 'notice', 'isMain', 'visible');
	}

	public function loadData(&$row) {
		$row['date'] = date("d.m.Y H:i", strtotime($row['date']));
		$row['notice'] = cmfSubContent($row['notice'], 0, 100);
		parent::loadData($row);
	}

	public function updateData($list, $send) {
        if(isset($send['isMain'])) {
			$this->setNewView();
        }
	}

}

?>