<?php


class article_edit_modul extends driver_modul_edit {

	protected function init() {
		parent::init();

		$this->setDb('article_edit_db');

		// формы
		$form = $this->getForm();
		$form->add('section',		new cmfFormSelectInt(array('!empty')));
		$form->add('date',		new cmfFormTextDateTime());

		$form->add('uri',			new cmfFormText(array('uri'=>95)));
		$form->add('header',		new cmfFormTextarea(array('max'=>255, '!empty')));
		$form->add('image',	        new cmfFormFile(array('path'=>cmfPathArticle)));
		$form->add('image_title',	new cmfFormText(array('max'=>255)));
		$form->add('notice',		new cmfFormTextarea(array('!empty')));
		$form->add('content',		new cmfFormTextareaWysiwyng('article', $this->getId()));
		$form->add('visible',		new cmfFormCheckbox());

		$form->add('title',			new cmfFormTextarea());
		$form->add('keywords',		new cmfFormTextarea());
		$form->add('description',		new cmfFormTextarea());
	}

    public function loadForm() {
        parent::loadForm();

        $form = $this->getForm();
        $name = cmfModulLoad('catalog_section_list_tree')->getNameList(array('level'=>array(0, 1)));
        $form->addElement('section', 0, 'Отсуствует');
        foreach($name as $k=>$v) {
            $form->addElement('section', $k, $v['name']);
        }
        $form->select('section', $this->getFilter('section'));
	}

	protected function saveStart(&$send) {
		parent::saveStart($send);
		if(isset($send['notice']) and empty($send['notice'])) {
			$notice = $this->getForm()->handlerElement('content');
			$send['notice'] = cmfSubContent($notice);
		}

		parent::saveStartUri($send, 'header', 95);
	}

}

?>