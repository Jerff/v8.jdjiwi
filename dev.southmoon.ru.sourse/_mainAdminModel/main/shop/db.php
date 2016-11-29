<?php


class main_shop_db extends driver_db_list {

	protected function getTable() {
		return db_shop;
	}

	public function updateData($list, $send) {
		cmfUpdateCache::update('shop');
	}

}

?>