<?php


class catalog_section_edit_controller extends driver_controller_edit_tree {

	protected function init() {
		parent::init();
		$this->addModul('main',	'catalog_section_edit_modul');

		// url
		$this->setSubmitUrl('/admin/catalog/section/edit/');
		$this->setCatalogUrl('/admin/catalog/section/edit/');
	}

    public function viewSiteUrl() {
        return parent::viewSiteUrl('/section/', $this->viewSiteData('isUri'));
    }

	public function delete($id) {
		$id = parent::delete($id);
		cmfModulLoad('product_edit_controller')->deleteSection($id);
		cmfModulLoad('param_group_notice_controller')->deleteSection($id);
		cmfModulLoad('param_group_select_controller')->deleteSection($id);
		cmfModulLoad('catalog_section_shop_controller')->deleteSection($id);
		return $id;
	}

	public function getNewUrl() {
		$opt = array('isList'=>null);
		return parent::getNewUrl($opt);
	}

	// страница списка
	public function getCatalogUrl($opt=null) {
		$opt['id'] = $this->getFilter('parent');
		return parent::getCatalogUrl($opt);
	}

	public function &path() {
		$path = $this->getModul()->path();
		$item_id = $this->getId();
		foreach($path as $id=>&$value)
			if($item_id!=$id) $value['url'] = $this->getSubmitUrl(array('id'=>$id, 'isList'=>1, 'parentId'=>null));

		$root = array('name'=>'Начало',
					  'url'=>$this->getRootUrl());
		array_unshift($path, $root);
		return $path;
	}

}

?>