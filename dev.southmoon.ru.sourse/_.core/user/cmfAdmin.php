<?php

cmfLoad('user/authorization/cmfAuth');
class cmfAdmin extends cmfAuth {

	protected function getName() {
	    return 'sessionAdmin';
	}

	// ������ ������ ������
	protected function getFields() {
		return array('id', 'login', 'name', 'admin', 'debugError', 'debugSql', 'debugExplain', 'debugCache');
	}
    // ������ �������������� ������
	public function getFieldsParam() {
		return array('id');
	}


	protected function getWhere() {
		return array("(LENGTH(`admin`)>1)");
	}


	protected function sessionUpdate() {
		$data = $this->getData();
		$group = cmfString::pathToArray($data['admin']);
		$this->set('group', $group);
		$this->set('groupString', implode(',', $group));
		parent::sessionUpdate();
	}

	// ������ ������
	public function getGroup() {
		return $this->get('group');
	}
	public function getGroupString() {
		return $this->get('groupString');
	}

}

?>