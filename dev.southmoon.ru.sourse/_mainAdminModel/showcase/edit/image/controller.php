<?php


class showcase_edit_image_controller extends driver_controller_list_all {

    function __construct($id=null) {
        $this->setIdName('image');
        parent::__construct($id);
	}

	protected function init() {
		parent::init();
		$this->addModul('main',	'showcase_edit_image_modul');

		// url
		$this->setSubmitUrl('/admin/showcase/edit/');
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
		$filter[0]['name'] = 'Выберите раздел';
		$filter[0]['parent'] = 1;
		$filter = parent::abstractFilterPart($filter, 'section', 'end');
  		$res = cmfRegister::getSql()->placeholder("SELECT section, count(id) FROM ?t WHERE section ?@ GROUP BY section", db_baner, array_keys($filter))
									->fetchRowAll(0, 1);
		foreach($filter as $k=>$v) {
        	$c = get($res, $k, 0);
        	$filter[$k]['name'] = '['. ($c>9 ? $c : '0'. $c) .'] '. $v['name'];
		}
		return $filter;
	}

}

?>