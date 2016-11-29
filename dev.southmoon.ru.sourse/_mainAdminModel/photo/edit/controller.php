<?php


class photo_edit_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'photo_edit_modul');

		// url
		$this->setSubmitUrl('/admin/photo/edit/');
		$this->setCatalogUrl('/admin/photo/');
	}

    public function viewSiteUrl() {
        return parent::viewSiteUrl('/photo/', $this->viewSiteData('uri'));
    }

	public function delete($id) {
		cmfModulLoad('photo_image_edit_controller')->deleteProduct($id);
		return parent::delete($id);
	}

}

?>