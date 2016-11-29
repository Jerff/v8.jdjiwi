<?php


class catalog_section_shop_modul extends driver_modul_edit {

    function __construct($id=null) {
        $this->setIdName('parentId');
        parent::__construct($id);
	}

	protected function init() {
		parent::init();

		$this->setDb('catalog_section_shop_db');

		// формы
		$form = $this->getForm();
		$form->add('width',	    new cmfFormTextInt());
		$form->add('height',	new cmfFormTextInt());
		$form->add('image',		new cmfFormFile(array('path'=>cmfPathCatalog)));
	}

	protected function saveStart(&$send) {
		parent::saveStart($send);
		$this->setNewView();
	}

}

?>