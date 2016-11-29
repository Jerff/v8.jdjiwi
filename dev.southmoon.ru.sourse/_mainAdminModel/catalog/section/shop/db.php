<?php


class catalog_section_shop_db extends driver_db_edit {

    function __construct($id=null) {
        $this->setIdName('parentId');
        parent::__construct($id);
	}

    public function updateController() {
		return 'model_catalog_section';
	}

	protected function getTable() {
		return db_section;
	}

}

?>