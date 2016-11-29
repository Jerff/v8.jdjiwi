<?php


class product_watermark_controller extends driver_controller_edit {

	function __construct($id=null) {
		$this->setIdName('main');
		parent::__construct($id);
	}

	protected function init() {
		parent::init();
		$this->addModul('main',		'product_watermark_modul');

		// url
		$this->setSubmitUrl('/admin/product/watermark/');
	}

}

?>