<?php


class product_watermark_modul extends driver_modul_edit {

	function __construct() {
		$this->setIdName('main');
		parent::__construct();
	}

	protected function init() {
		parent::init();

		$this->setDb('product_watermark_db');

		// формы
		$form = $this->getForm();
		$form->add('enable',    new cmfFormCheckbox());
		$form->add('type',	    new cmfFormRadio());
		$form->add('place',	    new cmfFormRadio());
		$form->add('notice',	new cmfFormText(array('max'=>255)));
		$form->add('size',	    new cmfFormText(array('max'=>255)));
		$form->add('image',	    new cmfFormFile(array('name'=>'image', 'path'=>cmfPathWatermark)));
	}

	public function loadForm() {
		parent::loadForm();

		$form = $this->getForm();
		$form->addElement('type', 'file', 	'Использовать файл');
		$form->addElement('type', 'text',   'Использовать текст');

		$form->addElement('place', 'NorthWest', 	'Верхний левый угол');
		$form->addElement('place', 'SouthWest',   'Нижний левый угол');
		$form->addElement('place', 'NorthEast', 	'Верхний правый угол');
		$form->addElement('place', 'SouthEast',   'Нижний правый угол');
	}

	protected function saveStart(&$send) {

		if(isset($send['type']) or isset($send['place']) or isset($send['size']) or isset($send['notice'])) {
            $type = get($send, 'type', $this->getForm()->handlerElement('type'));
            $size = get($send, 'size', $this->getForm()->handlerElement('size'));
            $notice = get($send, 'notice', $this->getForm()->handlerElement('notice'));
            if($type==='text') {
                cmfImage::createLogo($size, $notice);
            }
		}
		parent::saveStart($send);
	}

}

?>