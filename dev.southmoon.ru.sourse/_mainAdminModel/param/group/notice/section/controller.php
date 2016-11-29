<?php


class param_group_notice_section_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'param_group_notice_section_modul');

		// url
		$this->setSubmitUrl('/admin/param/group/notice/');
		$this->setCatalogUrl('/admin/param/group/notice/');
	}

	public function delete($id) {
		return $id;
	}

}

?>