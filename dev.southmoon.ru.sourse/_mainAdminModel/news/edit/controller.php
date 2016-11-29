<?php


class news_edit_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'news_edit_modul');

		// url
		$this->setSubmitUrl('/admin/news/edit/');
		$this->setCatalogUrl('/admin/news/');
	}

    public function viewSiteUrl() {
        return parent::viewSiteUrl('/news/', $this->viewSiteData('uri'));
    }

}

?>