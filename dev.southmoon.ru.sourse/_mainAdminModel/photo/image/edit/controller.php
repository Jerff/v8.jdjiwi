<?php


class photo_image_edit_controller extends driver_controller_gallery_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'photo_image_edit_modul');

		// url
		$this->setSubmitUrl('/admin/photo/image/');
		$this->setCatalogUrl('/admin/photo/image/');
	}

	public function getCatalogUrl($opt=null) {
		$opt['id'] = null;
		return $this->getUrl('catalog', $opt);
	}

	public function deleteProduct($id) {
		$old = cmfAdminMenu::getSubMenuId();
		cmfAdminMenu::setSubMenuId($id);
		$this->delete($this->getListId(array('photo'=>$id)));
		cmfAdminMenu::setSubMenuId($old);
	}

}

?>