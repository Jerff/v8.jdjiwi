<?php


class content_info_edit_controller extends driver_controller_edit_tree {

	protected function init() {
		parent::init();
		$this->addModul('main',	'content_info_edit_modul');

		// url
		$this->setSubmitUrl('/admin/content/info/edit/');
		$this->setCatalogUrl('/admin/content/info/');
	}

    public function viewSiteUrl() {
        return parent::viewSiteUrl('/info/', $this->viewSiteData('isUri'));
    }

}

?>