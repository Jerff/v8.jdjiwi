<?php


abstract class driver_db_edit_param_of_record extends driver_db_edit {

    function __construct() {
		$this->setIdName('config');
		parent::__construct();
	}

	public function constructOld() {
		parent::__construct();
	}

	protected function getTable() {
		return db_sys_config;
	}

	public function getRecordId() {
		return 'data';
	}

	protected function getWhereId($id) {
		return array('id'=>$id, 'AND', '1');
	}

	public function save($send) {
		$data = $this->runData();
		if($data) {
			foreach($send as $k=>$v)
				$data[$k] = $v;
			$send = $data;
		}
		$this->getSql()->add($this->getTable(), array($this->getRecordId()=>serialize($send)), $this->getWhere());
		$this->setUpdateData($this->getId(), $send);
	}

	protected function loadSetData(&$data) {
		if(!empty($data[$this->getRecordId()])) {
             $data = unserialize($data[$this->getRecordId()]);
		} else {
			 $data = array();
		}
		return $data;
	}

	public function setNotFount() {
	}

	public function updateData($list, $send) {
		cmfUpdateCache::update('config');
	}

}

?>