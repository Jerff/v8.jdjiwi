<?php


class model_content_info extends cmfDriverModel {

    const name = '/info/';
    static public function update($id=null) {
        self::updateUri($id);
	}

    static public function getListPage() {
        return array('info'=>'Информация',
                     'faq'=>'FAQ (подразделы показываются на этой же странице, как подсказки)');
	}
    
    static public function getViewMenu() {
        return array('none'=>'Обычное',
                     'right'=>'Показывать справо');
	}

    static public function delete($id) {
        cmfContentUrl::delete(self::name, $id);
	}


    static public function updateUri($where=null) {
        self::updateWhere($where);
        cmfRegister::getSql()->placeholder("
                REPLACE ?t SELECT ?, id, 0, 0, isUri FROM ?t WHERE ?w",
                db_content_url, self::name, db_content_info, $where);
	}

}

?>