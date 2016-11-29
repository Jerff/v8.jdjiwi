<?php


class article_edit_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'article_edit_modul');

		// url
		$this->setSubmitUrl('/admin/article/edit/');
		$this->setCatalogUrl('/admin/article/');
	}

    public function viewSiteUrl() {
        return parent::viewSiteUrl('/article/', $this->viewSiteData('uri'));
    }

	public function delete($id) {
		$modul = cmfModulLoad('article_attach_product_db');
		$modul->deleteAttach($id);

		return parent::delete($id);
	}

}

?>