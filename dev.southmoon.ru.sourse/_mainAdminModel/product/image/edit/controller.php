<?php


class product_image_edit_controller extends driver_controller_gallery_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'product_image_edit_modul');

		// url
		$this->setSubmitUrl('/admin/product/image/');
		$this->setCatalogUrl('/admin/product/image/');
	}

	public function getCatalogUrl($opt=null) {
		$opt['id'] = null;
		return $this->getUrl('catalog', $opt);
	}

	public function deleteProduct($id) {
		$old = cmfAdminMenu::getSubMenuId();
		cmfAdminMenu::setSubMenuId($id);
		$this->delete($this->getListId(array('product'=>$id)));
		cmfAdminMenu::setSubMenuId($old);
	}

}

?>