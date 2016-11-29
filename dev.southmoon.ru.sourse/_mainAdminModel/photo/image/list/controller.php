<?php


class photo_image_list_controller extends driver_controller_gallery_list {


	protected function init() {
		parent::init();
		$this->addModul('main',	'photo_image_list_modul');

		// url
		$this->setSubmitUrl('/admin/photo/image/');
		$this->setEditUrl('/admin/photo/image/');
	}

	public function delete($id) {
		$is = $this->getId()==$id;
		$id = cmfModulLoad('photo_image_edit_controller')->delete($id);
		if($is) {
		    $this->getResponse()->redirect($this->getSubmitUrl(array('id'=>null)));
		}
		return parent::delete($id);
	}

}

?>