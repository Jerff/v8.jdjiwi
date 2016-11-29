<?php


class baner_catalog_controller extends driver_controller_list_all {

	protected function init() {
		parent::init();
		$this->addModul('main',	'baner_catalog_modul');

		// url
		$this->setSubmitUrl('/admin/baner/');
		$this->callFuncReadAdd('onchangeSection|onchangeProduct');
	}

    public function loadForm2() {
        return $this->getModul()->loadForm2($this->getId());
	}

	protected function onchangeSection($id) {
		$this->getModul()->onchangeSection($id);
	}

	protected function onchangeProduct($id) {
		$this->getModul()->onchangeProduct($id);
	}

	public function delete($id) {
		parent::delete($id);
		$this->getResponse()->redirect($this->getSubmitUrl());
	}

	public function filterSection() {
		$filter = cmfModulLoad('catalog_section_list_tree')->getNameList();
		$filter[0]['name'] = 'Раздел не выбран';
		$filter[0]['parent'] = 0;
		$filter = parent::abstractFilterPart($filter, 'section', 'end');
  		$res = cmfRegister::getSql()->placeholder("SELECT parent, count(id) FROM ?t WHERE parent ?@ AND parentBrand='0' GROUP BY parent", db_baner, array_keys($filter))
									->fetchRowAll(0, 1);
		foreach($filter as $k=>$v) {
        	$c = get($res, $k, 0);
        	$filter[$k]['name'] = '['. ($c>9 ? $c : '0'. $c) .'] '. $v['name'];
		}
		return $filter;
	}

	public function filterBrand() {
		$filter = cmfModulLoad('catalog_brand_list_db')->getNameList();
		$filter[0]['name'] = 'Производитель не выбран';
		$filter[0]['parent'] = 0;
		$filter = parent::abstractFilterPart($filter, 'brand', 'end');
  		$res = cmfRegister::getSql()->placeholder("SELECT parentBrand, count(id) FROM ?t WHERE parent='0' AND parentBrand ?@ GROUP BY parentBrand", db_baner, array_keys($filter))
									->fetchRowAll(0, 1);
		foreach($filter as $k=>$v) {
        	$c = get($res, $k, 0);
        	$filter[$k]['name'] = '['. ($c>9 ? $c : '0'. $c) .'] '. $v['name'];
		}
		return $filter;
	}

}

?>