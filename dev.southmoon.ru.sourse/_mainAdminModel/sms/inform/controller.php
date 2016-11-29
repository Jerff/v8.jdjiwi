<?php


class sms_inform_controller extends driver_controller_list_all {

	protected function init() {
		parent::init();
		$this->addModul('main',	'sms_inform_modul');

		// url
		$this->setSubmitUrl('/admin/sms/inform/');

		$this->callFuncWriteAdd('newLine');
	}

	public function delete($id) {
		parent::deleteList($id);
		return parent::delete($id);
	}

}

?>