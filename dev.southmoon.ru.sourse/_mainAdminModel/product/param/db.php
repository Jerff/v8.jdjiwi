<?php


class product_param_db extends driver_db_edit_param {

    public function updateController() {
		return 'model_product';
	}

    public function returnParent() {
		return 'product_edit_db';
	}

	protected function init() {
		parent::init();
    }

	protected function getTable() {
		return db_product;
	}

    public function isShop($id, $shop) {
        return $this->getSql()->placeholder("SELECT 1 FROM ?t WHERE id=? AND shop=?", db_product, $this->getId(), $shop)
									->numRows();
	}

	public function paramList() {
		return cmfModulLoad('param_list_db')->getParamList($this->getTypeProduct(), array('visible'=>'yes'));
	}

	protected function getTypeProduct() {
		$type = cmfModulLoad('product_edit_db')->getSection($this->getId());
		cmfGlobal::set('$typeProduct', $type);
		return $type;
	}

	public function saveProductPrice($send) {
        cmfModulLoad('product_edit_db')->save($send);
	}

}

?>