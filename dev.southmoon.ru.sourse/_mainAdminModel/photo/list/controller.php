<?php


class photo_list_controller extends driver_controller_list {

	protected function init() {
		parent::init();
		$this->addModul('main',	'photo_list_modul');

		// url
		$this->setSubmitUrl('/admin/photo/');
		$this->setEditUrl('/admin/photo/edit/');
		$this->setUrl('attach', '/admin/photo/attach/');
	}

    public function viewListSiteUrl() {
        $arg = func_get_arg(0);
        return parent::viewListSiteUrl('/photo/', $arg->uri);
    }

	public function delete($id) {
		$id = cmfModulLoad('photo_edit_controller')->delete($id);
		return parent::delete($id);
	}

}

?>