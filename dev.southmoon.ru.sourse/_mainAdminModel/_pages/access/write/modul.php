<?php


class _pages_access_write_modul extends driver_modul_list_product_attach {

	protected function init() {
		parent::init();

		$this->setDb('_pages_access_write_db');

		$form = $this->getForm();
		//$form->add('object', new cmfFormText());
	}

}

?>