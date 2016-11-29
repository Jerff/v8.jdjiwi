<?php


abstract class driver_controller_gallery_edit extends driver_controller_edit {

    protected function init() {
        parent::init();
		$this->callFuncWriteAdd('updatePreview');
	}

	protected function updatePreview() {
	    $this->getModul()->updatePreview();
	    $this->getResponse()->script("cmf.admin.gallery.show();");
	}

    public function getGalleryPath() {
        return $this->getModul()->getGalleryPath();
    }
	public function getGallerySize() {
	    return $this->getModul()->getGallerySize();
	}
	public function getGalleryId() {
	    return $this->getModul()->getGalleryId();
	}
}

?>
