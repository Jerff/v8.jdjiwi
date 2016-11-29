<?php


class product_remains_controller extends product_list_controller {

	protected function init() {
		parent::init();
		$this->addModul('main',	'product_remains_modul');

		// url
		$this->setSubmitUrl('/admin/product/remains/');
		$this->setEditUrl('/admin/product/edit/');
	}

	public function getBasketId($section) {
		static $_section = array();
        if(!$section) return ;
		if(isset($_section[$section])) {
            return $_section[$section];
        }
        list($parent, $basket) = $this->getSql()->placeholder("SELECT parent, basket FROM ?t WHERE id=?", db_section, $section)
                                 ->fetchRow();
        if($basket) {
            $value = $this->getSql()->placeholder("SELECT value FROM ?t WHERE id=?", db_param, $basket)
                                    ->fetchRow(0);
            return $_section[$section] = array($basket, cmfString::unserialize($value));
        }
        return $_section[$section] = $this->getBasketId($parent);
	}

}

?>