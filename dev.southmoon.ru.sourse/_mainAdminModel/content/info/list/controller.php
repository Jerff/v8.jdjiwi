<?php


class content_info_list_controller extends driver_controller_list_tree {

	protected function init() {
		parent::init();
		$this->addModul('main',	'content_info_list_modul');

		// url
		$this->setSubmitUrl('/admin/content/info/');
		$this->setEditUrl('/admin/content/info/edit/');

	}

    public function viewListSiteUrl() {
        $arg = func_get_arg(0);
        return parent::viewListSiteUrl('/info/', $arg->isUri);
    }

	public function delete($id) {
		$id = cmfModulLoad('content_info_edit_controller')->delete($id);
		return parent::delete($id);
	}

	public function copy($id) {
		$this->copyInit();
		cmfModulLoad('content_info_edit_controller')->copy($id);
		$this->copyInit();
	}

}

?>