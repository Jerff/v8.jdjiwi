<?php


class cmfLimit {


	static public function is($id, $limit) {
		return $limit > cmfRegister::getSql()->placeholder("SELECT count(`date`) FROM ?t WHERE id=? AND date>=?", db_sys_limit, $id, date('Y-m-d H:i:s', time()-60*60))
									          ->fetchRow(0);
	}

	static public function add($id) {
		cmfRegister::getSql()->add(db_sys_limit, array('id'=>$id, 'date'=>date('Y-m-d H:i:s')));
	}

}

?>