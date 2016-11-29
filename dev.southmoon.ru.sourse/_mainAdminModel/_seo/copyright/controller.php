<?php


class _seo_copyright_controller extends driver_controller_edit_param_of_record {

	protected function init() {
		parent::init();
		$this->addModul('main',	'_seo_copyright_modul');

		// url
		$this->setSubmitUrl('/admin/seo/copyright/');
	}


}

?>