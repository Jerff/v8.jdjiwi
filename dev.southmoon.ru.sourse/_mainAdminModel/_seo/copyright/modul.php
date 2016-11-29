<?php


class _seo_copyright_modul extends driver_modul_edit {

	protected function init() {
		parent::init();

		$this->setDb('_seo_copyright_db');

		// формы
		$form = $this->getForm();
		$form->add('copyright',	new cmfFormTextarea(array('!empty')));
	}

}

?>