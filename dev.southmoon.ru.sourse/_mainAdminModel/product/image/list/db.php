<?php


class product_image_list_db extends driver_db_gallery_list {

	protected function getTable() {
		return db_product_image;
	}

	public function returnParent() {
		return 'product_image_edit_db';
	}

	public function getSort() {
		return array('pos'=>'DESC');
	}

    public function loadData(&$row) {
        if($row['image_main']) {
            $row['image_main'] = cmfBaseImg . cmfPathProduct .$row['image_main'];
        }
        if($row['image_section']) {
            $row['image_section'] = cmfBaseImg . cmfPathProduct .$row['image_section'];
        }
		parent::loadData($row);
	}

	protected function startSaveWhere() {
		return array('product');
	}

	protected function getWhereFilter() {
		return array('product'=> cmfAdminMenu::getSubMenuId());
	}

	protected function getWhereId($list) {
		return array('id'=>$list, 'AND', 'product'=> cmfAdminMenu::getSubMenuId());
	}

}

?>