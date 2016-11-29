<?php


class catalog_section_shop_image_db extends driver_db_list {

    function __construct($id=null) {
        $this->setIdName('image');
        parent::__construct($id);
	}

    public function updateController() {
		return 'model_catalog_showcase';
	}

	protected function getTable() {
		return db_section_shop;
	}

	public function setNewRecord() {
		cmfCommand::set('$isReload');
	}

	protected function startSaveWhere() {
		return array('parent');
	}

	protected function getWhereFilter() {
		$filter = array();
		$filter['parent'] = cmfAdminMenu::getSubMenuId();
		return $filter;
	}

}

?>