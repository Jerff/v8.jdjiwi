<?php


class photo_image_list_db extends driver_db_gallery_list {

	protected function getTable() {
		return db_photo_image;
	}

	public function returnParent() {
		return 'photo_image_edit_db';
	}

	public function getSort() {
		return array('pos'=>'DESC');
	}

    public function loadData(&$row) {
        if($row['image_main']) {
            $row['image_main'] = cmfBaseImg . cmfPathPhoto .$row['image_main'];
        }
        if($row['image_section']) {
            $row['image_section'] = cmfBaseImg . cmfPathPhoto .$row['image_section'];
        }
		parent::loadData($row);
	}

	protected function startSaveWhere() {
		return array('photo');
	}

	protected function getWhereFilter() {
		return array('photo'=> cmfAdminMenu::getSubMenuId());
	}

	protected function getWhereId($list) {
		return array('id'=>$list, 'AND', 'photo'=> cmfAdminMenu::getSubMenuId());
	}

}

?>