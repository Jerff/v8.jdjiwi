<?php


class content_pages_list_controller extends driver_controller_list {

	protected function init() {
		parent::init();
		$this->addModul('main',	'content_pages_list_modul');

		// url
		$this->setSubmitUrl('/admin/content/pages/');
		$this->setEditUrl('/admin/content/pages/edit/');

	}

	public function filterType() {
		$filter = model_content_pages::typeList();
		$filter[0]['name'] = 'Все';
		return parent::abstractFilterPart($filter, 'type', 'end');
	}

	public function delete($id) {
		$id = cmfModulLoad('content_pages_edit_controller')->delete($id);
		return parent::delete($id);
	}

}

?>