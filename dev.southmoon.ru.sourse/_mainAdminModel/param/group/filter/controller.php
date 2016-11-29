<?php


class param_group_filter_controller extends driver_controller_list_all {

	protected function init() {
		parent::init();
		$this->addModul('main',	'param_group_filter_modul');

		// url
		$this->setSubmitUrl('/admin/param/group/filter/');
		$this->setUrl('filter', '/admin/param/group/filter/');
	}

}

?>