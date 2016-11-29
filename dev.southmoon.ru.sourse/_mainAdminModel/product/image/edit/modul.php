<?php


class product_image_edit_modul extends driver_modul_gallery_list_edit {

	protected function init() {
		parent::init();

		$this->setDb('product_image_edit_db');

		// формы
		$form = $this->getForm();
		$this->setNewPos();

		$form->add('name',		    new cmfFormText(array('max'=>255, '1!empty')));
		$form->add('color',		    new cmfFormSelectCheckbox());
		$form->add('visible',		new cmfFormCheckbox());


        $size=array();
        $size['main'] = array(imageMainWidth, imageMainHeight);
		$size['section'] = array(imageSectionWidth, imageSectionHeight);
		$size['product'] = array(imageProductWidth, imageProductHeight);
		$size['small'] = array(imageSmallWidth, imageSmallHeight);
		$form->add('image',	new cmfFormImage(array('name'=>'image', 'path'=>cmfPathProduct, 'size'=>$size, 'addField', 'watermark')));

		$this->setGalleryPath(cmfPathProduct);
		$this->setGallerySize(imageSectionWidth, imageSectionHeight);
	}

    public function loadForm() {
        parent::loadForm();

        $form = $this->getForm();
        $name = cmfModulLoad('param_color_list_db')->getNameList();
		foreach($name as $k=>$v) {
            $form->addElement('color', $k, $v['name']);
            $form->select('color', $k);
        }
	}

	public function getGalleryId() {
	    return 'image_section';
	}

	protected function saveStart(&$send) {
		if(count($send) and !$this->getId()) {
			 $send['product'] = cmfAdminMenu::getSubMenuId();
		}
		parent::saveStart($send);
	}

}

?>