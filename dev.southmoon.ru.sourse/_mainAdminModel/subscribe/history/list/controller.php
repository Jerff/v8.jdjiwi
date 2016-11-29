<?php


class subscribe_history_list_controller extends driver_controller_list {

	protected function init() {
		parent::init();
		$this->addModul('main',	'subscribe_history_list_modul');

		// url
		$this->setSubmitUrl('/admin/subscribe/history/');
		$this->setEditUrl('/admin/subscribe/history/view/');
        $this->callFuncDeleteDel('delete');    
	}
    
	public function getEditUrl($opt=null) {
		return $this->getUrl('edit', $opt);
	}
    
	public function delete($id) {
		$id = cmfModulLoad('subscribe_history_edit_controller')->delete($id);
		return parent::delete($id);
	}

}

?>