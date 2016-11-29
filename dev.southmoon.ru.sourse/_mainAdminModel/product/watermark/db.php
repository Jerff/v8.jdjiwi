<?php


class product_watermark_db extends driver_db_edit_param_of_record {

	function __construct() {
		$this->setIdName('main');
		parent::__construct();
	}

    public function isShop($id, $shop) {
        return !$shop;
	}

	protected function getTable() {
		return db_sys_config;
	}

	public function updateData($list, $send) {
		cmfUpdateCache::update('config');
	}

}

?>