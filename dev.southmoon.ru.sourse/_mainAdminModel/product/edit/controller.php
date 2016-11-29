<?php


class product_edit_controller extends driver_controller_edit_param {

	protected function init() {
		parent::init();
		$this->addModul('edit',	'product_edit_modul');
		$this->addModul('main',	'product_param_modul');

		// url
		$this->setSubmitUrl('/admin/product/edit/');
		$this->setCatalogUrl('/admin/product/');
		$this->setUrl('attach', '/admin/product/attach/');
	}

	public function getProductUrl($opt=null) {
		$opt['product1'] = $this->getId();
		$opt['edit'] = 1;
		$opt['page'] = 1;
		return $this->getUrl('attach', $opt);
	}

	public function attachProduct() {
		return $this->getSql()->placeholder("SELECT count(product2) AS count FROM ?t WHERE product1=?", db_product_attach, $this->getId())
											->fetchRow(0);
	}

    public function viewSiteUrl($id=null) {
        list($section, $uri) = $this->getModul('edit')->getDb()->getFeildsId(array('section', 'uri'), $id ? $id : $this->getId());
        $secUri = cmfModulLoad('catalog_section_edit_db')->getFeildOfId('isUri', $section);
        return parent::viewSiteUrl2('/product/', $secUri .'/'. $uri);
    }

	public function deleteSection($id) {
		$where = array('section'=>$id);
		$this->delete($this->getListId($where));
	}

	public function deleteBrand($id) {
		$where = array('brand'=>$id);
		$this->delete($this->getListId($where));
		if($where) {
			$this->getModul()->getDb()->saveId($this->getListId($where), array('brand'=>0));
		}
	}

	public function delete($id) {
		cmfModulLoad('product_image_edit_controller')->deleteProduct($id);
		cmfModulLoad('product_param_db')->deleteProduct($id);

		$modul = cmfModulLoad('product_attach_product_db');
		$modul->deleteProduct($id);
		$modul->deleteAttach($id);

		return parent::delete($id);
	}

}

?>