<?php


class showcase_edit_image_db extends driver_db_list {

    function __construct($id=null) {
        $this->setIdName('image');
        parent::__construct($id);
	}

    public function updateController() {
		return 'model_showcase';
	}

	protected function getTable() {
		return db_showcase_list;
	}

	public function setNewRecord() {
		cmfCommand::set('$isReload');
	}

	protected function startSaveWhere() {
		return array('parent');
	}

	protected function getWhereFilter() {
		$filter = array();
		$filter['parent'] = (int)$this->getFilter('id');
		return $filter;
	}

}

?>