<?php


class product_image_list_controller extends driver_controller_gallery_list {


	protected function init() {
		parent::init();
		$this->addModul('main',	'product_image_list_modul');

		// url
		$this->setSubmitUrl('/admin/product/image/');
		$this->setEditUrl('/admin/product/image/');
	}

	public function delete($id) {
		$is = $this->getId()==$id;
		$id = cmfModulLoad('product_image_edit_controller')->delete($id);
		if($is) {
		    $this->getResponse()->redirect($this->getSubmitUrl(array('id'=>null)));
		}
		return parent::delete($id);
	}

	public function getColor($color) {
		static $_color = array();
		if(!$_color) {
			$_color = cmfModulLoad('param_color_list_db')->getNameList(null, array('color'));
		}
		$new = array();
		foreach(cmfString::pathToArray($color) as $id) {
            if(isset($_color[$id])) {
                $new[] = $_color[$id]['color'];
            }
		}
		return $new;
	}

}

?>