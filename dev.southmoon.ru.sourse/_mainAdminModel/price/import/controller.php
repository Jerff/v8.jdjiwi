<?php


class price_import_controller extends driver_controller_list {

	protected function init() {
		parent::init();

		// url
		$this->setSubmitUrl('/admin/price/import/');

		$this->callFuncWriteAdd('import|export');
	}

	public function filterShop() {
		$filter = cmfModulLoad('shop_list_db')->getNameList();
		return parent::abstractFilterPart($filter, 'shop', 'end');
	}

	public function shop() {
		return cmfModulLoad('shop_edit_db')->getDataId($this->getFilter('shop'));
	}

	public function exportUrl() {
		return cmfGetAdminCommand('/admin/price/import/') .'&command=export&shop='. $this->getFilter('shop');
	}


	static protected function encode($text) {
        return cmfString::translate($text);
	}
	public function export() {
	    if(!$this->isWrite()) return;
	    $shop = cmfModulLoad('shop_edit_db')->getDataId($this->getFilter('shop'));
	    if(!$shop) return;

        new cmfPriceExport($shop['id'], $shop['uri']);
        die();
	}

	public function import() {
	    if(!$this->isWrite()) return;
	    $shop = cmfModulLoad('shop_edit_db')->getDataId($this->getFilter('shop'));
	    if(!$shop) return;

        if(get2($_FILES, 'upload', 'error')!==0) {
            $this->getResponse()->addAlert('Ошибка загрузки файла');
            return;
        }
        new cmfPriceImport($shop['id'], $_FILES['upload']['tmp_name']);
        $this->setNewView();
	}

	public function isWrite() {
        $is = (int)cmfRegister::getAdmin()->shop;
        if($is) {
            $shop = (int)$this->getFilter('shop');
            return $shop==$is;
        } else {
            return true;
        }
	}

}

?>