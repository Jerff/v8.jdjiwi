<?php


class delivery_region_list_controller extends driver_controller_list_one {

	protected function init() {
		parent::init();
		$this->addModul('main',	'delivery_region_list_modul');

		// url
		$this->setSubmitUrl('/admin/delivery/region/edit/');
		$this->setEditUrl('/admin/delivery/region/edit/');
	}

	public function getNewUrl($opt=null) {
		$opt['id'] = null;
		$opt['select'] = $this->getFilter('parent');
		$opt['parent'] = null;
		$opt['isList'] = null;
		return $this->getEditUrl($opt);
	}

	public function getChild() {
		$listId = $this->getDataId();
		return $this->getSql()->placeholder('SELECT parent, count(id) FROM ?t WHERE parent ?@ GROUP BY parent', db_delivery_region, $listId)
								->fetchRowAll(0, 1);
	}

	public function delete($id) {
		$id = cmfModulLoad('delivery_region_edit_controller')->delete($id);
		return parent::delete($id);
	}

}

?>