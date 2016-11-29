<?php


class _administrator_list_controller extends driver_controller_list {

	protected function init() {
		parent::init();
		$this->addModul('main',	'_administrator_list_modul');

		// url
		$this->setSubmitUrl('/admin/administrator/');
		$this->setEditUrl('/admin/administrator/edit/');

		$this->callFuncWriteAdd('userUnban|userExit');
	}

	public function filterGroup() {
		$filter = cmfModulLoad('_administrator_group_list_db')->getNameList();
		$filter[-1]['name'] = 'Не администраторы';
		$filter[0]['name'] = 'Все администраторы';
		return parent::abstractFilterPart($filter, 'admin', 'end');
	}

	protected function updateAccess($list) {
		foreach($list as $id) {
			cmfAdminModel::accesIs($id);
		}
	}

	public function delete($id) {
		cmfAdminModel::accesIs($id);
		$id = cmfModulLoad('_administrator_edit_controller')->delete($id);
		return parent::delete($id);
	}

	protected function userUnban($id){
		cmfAdminModel::accesIs($id);
		cmfAdminModel::userUnban($id);
		$this->getResponse()->script("
\$('#userUnban{$id}').hide();
\$('#userExit{$id}').show();");
	}

	protected function userExit($id){
		cmfAdminModel::accesIs($id);
		if($id==cmfRegister::getAdminId()) {
			$this->getResponse()->script("cmfExit();");
		} else {
			cmfAdminModel::userExit($id);
		}
	}

}

?>