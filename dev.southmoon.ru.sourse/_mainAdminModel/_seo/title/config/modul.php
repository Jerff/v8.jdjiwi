<?php


class _seo_title_config_modul extends driver_modul_edit {

	protected function init() {
		parent::init();

		$this->setDb('_seo_title_config_db');

		// �����
		$form = $this->getForm();
		$form->add('head',	    new cmfFormTextarea());
	}

}

?>