<?php

cmfModul('product_list_controller');
class article_attach_controller extends product_list_controller {

	protected function init() {
		//parent::init();
		$this->addModul('main',		'article_attach_modul', false);
		$this->addModul('product',	'article_attach_product_modul');

		// url
		$this->setSubmitUrl('/admin/article/attach/');
		if($this->getFilter('edit')) {
			$this->setCatalogUrl('/admin/article/edit/');
		} else {
			$this->setCatalogUrl('/admin/article/');
		}

		$this->callFuncWriteDel('delete');
		$this->callFuncReadAdd('changeFilter');
	}

	public function filterMenu() {
		return parent::filterMenu2('Рекомендуемые товары для', 'article', 'article_edit_db', 'header');
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
		$data = cmfModulLoad('product_edit_db')->getDataId($this->getFilter('article'));
		return $data['name'];
	}

}

?>