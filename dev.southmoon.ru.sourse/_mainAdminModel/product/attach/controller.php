<?php

cmfModul('product_list_controller');
class product_attach_controller extends product_list_controller {

	protected function init() {
		//parent::init();
		$this->addModul('main',		'product_attach_modul', false);
		$this->addModul('product',	'product_attach_product_modul');

		// url
		$this->setSubmitUrl('/admin/product/attach/');
		if($this->getFilter('edit')) {
			$this->setCatalogUrl('/admin/product/edit/');
		} else {
			$this->setCatalogUrl('/admin/product/');
		}

		$this->callFuncWriteDel('delete');
		$this->callFuncReadAdd('changeFilter');
	}

	public function filterMenu() {
		return parent::filterMenu2('Рекомендуемые товары для', 'product1', 'product_edit_db');
	}

	public function getCatalogUrl($opt=null) {
		$opt['id'] = $this->getFilter('product1');
		$opt['edit'] = null;
		return $this->getUrl('catalog', $opt);
	}


	public function filterAttach() {
		$filter = array();
		$filter['all']['name'] = 'Все товары';
		$filter['attach']['name'] = 'Только привязанные';
		return parent::abstractFilterPart($filter, 'attach', 'reset');
	}

	public function filterDump() {
		$filter = array();
		$filter['all']['name'] = 'Все';
		$filter['yes']['name'] = 'В наличии';
		$filter['no']['name'] = 'Отсутсвующие';
		return parent::abstractFilterPart($filter, 'dump', 'yes');
	}


	public function nameLink() {
		$data = cmfModulLoad('product_edit_db')->getDataId($this->getFilter('product1'));
		return $data['name'];
	}

}

?>