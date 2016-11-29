<?php


class delivery_region_edit_controller extends driver_controller_edit_tree {

	protected function init() {
		parent::init();
		$this->addModul('main',	'delivery_region_edit_modul');

		// url
		$this->setSubmitUrl('/admin/delivery/region/edit/');
		$this->setCatalogUrl('/admin/delivery/region/edit/');
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