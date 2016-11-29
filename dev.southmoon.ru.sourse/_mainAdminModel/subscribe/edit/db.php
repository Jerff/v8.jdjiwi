<?php


class subscribe_edit_db extends driver_db_edit {

	protected function getTable() {
		return db_subscribe;
	}

    public function isShop($id, $shop) {
        return $this->getSql()->placeholder("SELECT 1 FROM ?t WHERE ?w AND shop=?", $this->getTable(), $this->getWhereId($id), $shop)
									->numRows();
	}

	public function updateData($list, $send) {
		cmfUpdateCache::update('subscribe', $this->getId());
	}


    public function mailStart() {
        $data = array('status'=>'активна');
        $this->save($data);
    }

    public function mailContinue() {
        $data = array('status'=>'активна');
        $this->save($data);
    }

    public function mailReset() {
        $data = array('status'=>'активна');
        $this->save($data);
        $this->getSql()->del(db_subscribe_status, array('subscribe'=>$this->getId()));
	}

	public function mailStop() {
        $data = array('status'=>'остановлена');
        $this->save($data);
	}

}

?>