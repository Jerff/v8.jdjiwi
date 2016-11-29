<?php


class product_list_controller extends driver_controller_list {

	protected function init() {
		parent::init();
		$this->addModul('main',	'product_list_modul');

		// url
		$this->setSubmitUrl('/admin/product/');
		$this->setEditUrl('/admin/product/edit/');
		$this->setUrl('attach', '/admin/product/attach/');

		$this->callFuncReadAdd('changeFilter');
	}

    public function viewListSiteUrl() {
        $arg = func_get_args();
        return parent::viewListSiteUrl('/product/', get2($arg[0], $arg[1]->section, 'isUri') .'/'. $arg[1]->uri);
    }

	public function changeFilter() {
        $atricul = trim($this->getRequest()->getPost('articul'));
        $price1 = cmfToFloat($this->getRequest()->getPost('price1'));
        $price2 = cmfToFloat($this->getRequest()->getPost('price2'));

        $opt = array();
        $opt['articul'] = $atricul ? $atricul : null;
		$opt['price1'] = $price1 ? $price1 : null;
		$opt['price2'] = $price2 ? $price2 : null;
		$this->getResponse()->redirect($this->getSubmitUrl($opt));
	}

	public function filterSection() {
		$filter = cmfModulLoad('catalog_section_list_tree')->getNameList(null, array('isUri'));
		cmfGlobal::set('$sectionId', array_keys($filter));
		$filter[-1]['name'] = 'Без разделов';
		$filter[0]['name'] = 'Все разделы';
		return parent::abstractFilterPart($filter, 'section', 'end');
	}

	public function filterBrand() {
		$filter = cmfModulLoad('catalog_brand_list_db')->getNameList();
		$filter[0]['name'] = 'Все';
		return parent::abstractFilterPart($filter, 'brand', 'end');
	}

	public function filterFilter() {
		$filter = array();
		$filter['dumpYes']['name'] = 'В наличие';
		$filter['dumpNo']['name'] = 'Отсуствуют в наличии';
		$filter['visibleYes']['name'] = 'Показываются на сайте';
		$filter['visibleNo']['name'] = 'Не показываются на сайте';
		$filter['new']['name'] = 'Новинки';
		$filter['sale']['name'] = 'Распродажа';
		$filter['all']['name'] = 'Все';
		return parent::abstractFilterPart($filter, 'filter', 'start');
	}

	public function delete($id) {
		$id = cmfModulLoad('product_edit_controller')->delete($id);
		return parent::delete($id);
	}

	public function getProductUrl($opt=null) {
		$opt['product1'] = $this->getId();
		$opt['page'] = 1;
		return $this->getUrl('attach', $opt);
	}

	public function attachProduct() {
		return $this->getSql()->placeholder("SELECT product1, count(product2) AS count FROM ?t WHERE product1 ?@ GROUP BY product1", db_product_attach, $this->getDataId())
                              ->fetchRowAll(0, 1);
	}

}

?>