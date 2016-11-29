<?php


class param_group_list_controller extends driver_controller_list_all {

	protected function init() {
		parent::init();
		$this->addModul('main',	'param_group_list_modul');

		// url
		$this->setSubmitUrl('/admin/param/group/');
		$this->setEditUrl('/admin/param/group/edit/');

		$this->setUrl('select', '/admin/param/group/select/');
		$this->setUrl('notice', '/admin/param/group/notice/');
	}

	public function getSelectUrl() {
		$opt = array('parentId'=>$this->getIndex());
		return $this->getUrl('select', $opt);
	}

	public function getNoticeUrl() {
		$opt = array('parentId'=>$this->getIndex());
		return $this->getUrl('notice', $opt);
	}

	public function delete($id) {
		$id = cmfModulLoad('param_group_edit_controller')->delete($id);
		return parent::delete($id);
	}

}

?>