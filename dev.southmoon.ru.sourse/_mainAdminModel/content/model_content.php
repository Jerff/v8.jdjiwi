<?php


class model_content extends cmfDriverModel {

    const name = '/content/';
    static public function update($id=null) {
        self::updateUri($id);
	}


    static public function delete($id) {
        cmfContentUrl::delete(self::name, $id);
	}


    static public function updateUri($where=null) {
        self::updateWhere($where);
        cmfRegister::getSql()->placeholder("
                REPLACE ?t SELECT ?, id, 0, 0, isUri FROM ?t WHERE ?w",
                db_content_url, self::name, db_content, $where);
	}

}

?>