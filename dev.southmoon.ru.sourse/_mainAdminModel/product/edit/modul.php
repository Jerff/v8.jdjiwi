<?php


class product_edit_modul extends driver_modul_edit {

	protected function init() {
		parent::init();

		$this->setDb('product_edit_db');

		// формы
		$form = $this->getForm();
        $this->setNewPos();

		$form->add('section',		new cmfFormSelectInt(array('!empty')));
		$form->add('brand',		    new cmfFormSelectInt(array('!empty1')));

		$form->add('uri',			new cmfFormText(array('uri'=>100)));
		$form->add('articul',		new cmfFormText(array('max'=>50, '!empty1')));
		$form->add('name',		    new cmfFormTextarea(array('max'=>255, '!empty')));
		$form->add('notice',		new cmfFormTextareaWysiwyng('product', $this->getId(), array('max'=>10000)));

		$form->add('type',		    new cmfFormRadio());
		$form->add('discount',	    new cmfFormSelect());
		$form->add('price1',	    new cmfFormTextInt());
		$form->add('color',		    new cmfFormSelectCheckbox());
		$form->add('salesNotes',	new cmfFormText(array('max'=>100)));

		$form->add('title',			new cmfFormTextarea(array('max'=>500)));
		$form->add('keywords',		new cmfFormTextarea(array('max'=>500)));
		$form->add('description',	new cmfFormTextarea(array('max'=>500)));

		$form->add('isOrder',	    new cmfFormCheckbox());
		$form->add('dumpUrl',	    new cmfFormText());
		$form->add('count',	        new cmfFormTextInt());
		$form->add('visible',	    new cmfFormCheckbox());
		$form->add('discount',	    new cmfFormSelectInt());
	}

	public function loadForm() {
		parent::loadForm();

		$form = $this->getForm();
		$name = cmfModulLoad('catalog_section_list_tree')->getNameList();
		$form->addElement('section', 0, 'Отсуствует');
		foreach($name as $k=>$v) {
            $form->addElement('section', $k, $v['name']);
            if(!$v['parent'])
            $form->addOptions('section', $k, 'disabled', 'true');
		}
		$form->select('section', $this->getFilter('section'));

		$name = cmfModulLoad('catalog_brand_list_db')->getNameList();
		$form->addElement('brand', 0, 'Отсуствует');
		foreach($name as $k=>$v) {
            $form->addElement('brand', $k, $v['name']);
		}
		$form->select('brand', $this->getFilter('brand'));


		$name = cmfModulLoad('param_discount_list_db')->getNameList();
		$form->addElement('discount', 0, 'Отсуствует');
		foreach($name as $k=>$v) {
            $form->addElement('discount', (int)$v['name'], $v['name'] .'%');
		}

        $name = cmfModulLoad('param_color_list_db')->getNameList();
		foreach($name as $k=>$v) {
            $form->addElement('color', $k, $v['name']);
            $form->select('color', $k);
        }

        $form->addElement('type', 'none', 'Обычный товар');
        $form->select('type', 'none');
        $form->addElement('type', 'sale', 'Распродажа');
	}

	protected function saveStart(&$send) {
		parent::saveStart($send);
		if(isset($send['pos']) and (empty($send['pos']) or $send['pos']>9999)) {
				$send['pos'] = 9999;
		}
		if(!$this->getId()) {
			 $send['created'] = time();
		}
		$send['isUpdate'] = 'yes';
		if(isset($send['discount'])) {
			$send['discount'] = 1-($send['discount']/100);
		}

		$section = $this->getForm()->handlerElement('section');
		parent::saveStartUri($send, 'name', 100, array('section'=>$section));
	}

}

?>