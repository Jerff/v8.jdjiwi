<?php


class photo_image_edit_modul extends driver_modul_gallery_list_edit {

	protected function init() {
		parent::init();

		$this->setDb('photo_image_edit_db');

		// формы
		$form = $this->getForm();
		$this->setNewPos();

		$form->add('name',		    new cmfFormText(array('max'=>255, '1!empty')));
		$form->add('visible',		new cmfFormCheckbox());


        $size=array();
        $size['main'] = array(photoMainWidth, photoMainHeight);
		$size['section'] = array(photoSmallWidth, photoSmallHeight);
		$form->add('image',	new cmfFormImage(array('name'=>'image', 'path'=>cmfPathPhoto, 'size'=>$size, 'addField', 'watermark')));

		$this->setGalleryPath(cmfPathProduct);
		$this->setGallerySize(imageSectionWidth, imageSectionHeight);
	}

	public function getGalleryId() {
	    return 'image_section';
	}

	protected function saveStart(&$send) {
		if(count($send) and !$this->getId()) {
			 $send['photo'] = cmfAdminMenu::getSubMenuId();
		}
		parent::saveStart($send);
	}

}

?>