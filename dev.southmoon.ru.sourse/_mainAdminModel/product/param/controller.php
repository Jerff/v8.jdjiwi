<?php


class product_param_controller extends driver_controller_edit_param {

	protected function init() {
		parent::init();
		$this->addModul('main',	'product_param_modul');

		// url
		$this->setSubmitUrl('/admin/product/param/');
		$this->setCatalogUrl('/admin/product/edit/');

		$this->setUrl('select', '/admin/param/group/select/');
		$this->setUrl('notice', '/admin/param/group/notice/');
	}

	public function getSelectUrl() {
		$opt = array('parentId'=>cmfGlobal::get('$typeProduct'), 'page'=>null);
		return $this->getUrl('select', $opt);
	}

	public function getNoticeUrl() {
		$opt = array('parentId'=>cmfGlobal::get('$typeProduct'), 'page'=>null);
		return $this->getUrl('notice', $opt);
	}
}

?>