<?php


class content_content_edit_controller extends driver_controller_edit_tree {

	protected function init() {
		parent::init();
		$this->addModul('main',	'content_content_edit_modul');

		// url
		$this->setSubmitUrl('/admin/content/content/edit/');
		$this->setCatalogUrl('/admin/content/content/');
	}

    public function viewSiteUrl() {
        return parent::viewSiteUrl('/content/', $this->viewSiteData('isUri'));
    }

}

?>