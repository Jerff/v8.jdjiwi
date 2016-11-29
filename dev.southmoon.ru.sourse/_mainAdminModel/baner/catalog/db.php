<?php


class baner_catalog_db extends driver_db_list {

    public function updateController() {
		return 'model_baner';
	}

	protected function getTable() {
		return db_baner;
	}

	public function setNewRecord() {
		cmfCommand::set('$isReload');
	}

	protected function startSaveWhere() {
		return array('parent');
	}

	protected function getWhereFilter() {
		$filter = array();
		$filter['parent'] = (int)$this->getFilter('section');
		$filter[] = 'AND';
		$filter['parentBrand'] = (int)$this->getFilter('brand');
		return $filter;
	}

}

?>