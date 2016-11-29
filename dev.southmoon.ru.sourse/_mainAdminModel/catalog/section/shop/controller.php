<?php


class catalog_section_shop_controller extends driver_controller_edit {

    function __construct($id=null) {
        $this->setIdName('parentId');
        parent::__construct($id);
	}

	protected function init() {
		parent::init();
		$this->addModul('main',	'catalog_section_shop_modul');

		// url
		$this->setSubmitUrl('/admin/catalog/section/shop/');
		$this->setCatalogUrl('/admin/catalog/section/shop/');
	}

	public function delete($id) {
	}

}

?>