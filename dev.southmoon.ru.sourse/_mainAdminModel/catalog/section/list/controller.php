<?php


class catalog_section_list_controller extends driver_controller_list_one {

	protected function init() {
		parent::init();
		$this->addModul('main',	'catalog_section_list_modul');

		// url
		$this->setSubmitUrl('/admin/catalog/section/edit/');
		$this->setEditUrl('/admin/catalog/section/edit/');

		$this->setUrl('shop', '/admin/catalog/section/shop/');
		$this->setUrl('product', '/admin/product/');
		$this->setUrl('select', '/admin/param/group/select/');
		$this->setUrl('notice', '/admin/param/group/notice/');
	}

    public function viewListSiteUrl() {
        $arg = func_get_arg(0);
        return parent::viewListSiteUrl('/section/', $arg->isUri);
    }

	public function getNewUrl($opt=null) {
		$opt['id'] = null;
		$opt['select'] = $this->getFilter('parent');
		$opt['parent'] = null;
		$opt['isList'] = null;
		return $this->getEditUrl($opt);
	}

	public function getProductUrl() {
		$opt = array('section'=>$this->getIndex());
		return $this->getUrl('product', $opt);
	}


	public function getShopUrl() {
		$opt = array('parentId'=>$this->getIndex());
		return $this->getUrl('shop', $opt);
	}

	public function getSelectUrl() {
		$opt = array('parentId'=>$this->getIndex());
		return $this->getUrl('select', $opt);
	}

	public function getNoticeUrl() {
		$opt = array('parentId'=>$this->getIndex());
		return $this->getUrl('notice', $opt);
	}


	public function delete($id) {
		$id = cmfModulLoad('catalog_section_edit_controller')->delete($id);
		return parent::delete($id);
	}

	public function getChild() {
		$listId = $this->getDataId();
		return $this->getSql()->placeholder('SELECT parent, count(id) FROM ?t WHERE parent ?@ GROUP BY parent', db_section, $listId)
								->fetchRowAll(0, 1);
	}

	public function getProduct() {
		$count = array();
		foreach($this->getDataId() as $id) {
            $count[$id] = get($count, $id) + $this->getSql()->placeholder("SELECT count(id) FROM ?t WHERE section IN(SELECT id FROM ?t WHERE id=? OR path LIKE '%[?i]%')", db_product, db_section, $id, $id)
															->fetchRow(0);
		}
		return $count;
	}

}

?>