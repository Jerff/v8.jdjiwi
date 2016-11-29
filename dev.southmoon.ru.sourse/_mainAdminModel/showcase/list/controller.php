<?php


class showcase_list_controller extends driver_controller_list {

	protected function init() {
		parent::init();
		$this->addModul('main',	'showcase_list_modul');

		// url
		$this->setSubmitUrl('/admin/showcase/');
		$this->setEditUrl('/admin/showcase/edit/');

	}

    public function viewListSiteUrl() {
        $arg = func_get_arg(0);
        return parent::viewListSiteUrl('/showcase/', $arg->uri);
    }

	public function delete($id) {
		$id = cmfModulLoad('showcase_edit_controller')->delete($id);
		return parent::delete($id);
	}

}

?>