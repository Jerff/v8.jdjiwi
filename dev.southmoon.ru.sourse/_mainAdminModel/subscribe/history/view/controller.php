<?php


class subscribe_history_view_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'subscribe_history_view_modul');
	}

    public function deleteSubscribe($id) {
		$old = cmfAdminMenu::getSubMenuId();
		cmfAdminMenu::setSubMenuId($id);
		$this->delete($this->getListId(array('subscribe'=>$id)));
		cmfAdminMenu::setSubMenuId($old);
	}
    
}

?>