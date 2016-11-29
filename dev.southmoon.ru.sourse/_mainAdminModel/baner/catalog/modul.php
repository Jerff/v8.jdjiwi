<?php


class baner_catalog_modul extends driver_modul_list {

	protected function init() {
		parent::init();

		$this->setDb('baner_catalog_db');

		// формы
		$form = $this->getForm();
		$this->setNewPos();

        $form->add('name',          new cmfFormText(array('max'=>100)));
        $form->add('type',		    new cmfFormRadio(array('!empty')));
		$form->add('visible',		new cmfFormCheckbox());

		$form->add('url',			new cmfFormText(array('max'=>250)));
		$form->add('image',		    new cmfFormFile(array('path'=>cmfPathBaner, 'size'=>array(banerWidth, banerHeight))));

		$form->add('section',		new cmfFormSelectInt());
		$form->add('brand',		    new cmfFormSelectInt());
		$form->add('product',		new cmfFormSelectInt());
	}

	/*protected function updateIsErrorData($data, &$isError) {
		if(!$this->getId()) {
			if(!$this->getFilter('section') and !$this->getFilter('brand')) {
				$isError = true;
				$this->getForm()->setError('name', 'Выберите раздел или производителя');
			}
		}
		return $isError;
	}*/

    public function loadForm() {
        $form = $this->getForm();
        $form->addElement('type', 'product', 'Товар');
        $form->addElement('type', 'edit', 'Заполнить в ручную');
        $form->select('type', 'product');

        $section = cmfRegister::getSql()->getQuery("(id=? OR path LIKE '%[?i]%')", cmfAdminMenu::getSubMenuId(), cmfAdminMenu::getSubMenuId());
        $name = cmfModulLoad('catalog_section_list_tree')->getNameList();

        if($name) {
            cmfGlobal::set('$sectionId', key($name));
        }
        $form->addElement('section', 0, 'Не выбрано');
        foreach($name as $key=>$value)
            $form->addElement('section', $key, $value['name']);

        $name = cmfModulLoad('catalog_brand_list_db')->getNameList();
        cmfGlobal::set('$brandId', key($name));
        $form->addElement('brand', 0, 'Не выбрано (ccылка на раздел)');
        //$form->addElement('brand', -1, 'ссылка на раздел');
        foreach($name as $key=>$value)
            $form->addElement('brand', $key, $value['name']);
    }

    public function loadForm2($id=null) {
        if(!$id) $id = $this->getId();

        $form = $this->getForm();
        $data = $this->getDataId($id);

        $section = get($data, 'section');
        if(!$section) $section = cmfGlobal::get('$sectionId');

        $section = cmfRegister::getSql()->placeholder("SELECT id FROM ?t WHERE id=? OR path LIKE '%[?i]%'", db_section, $section, $section)
                                        ->fetchRowAll(0, 0);
        $name = cmfModulLoad('product_list_db')->getProductList($section, array(1), array('price'));
        $product = get($data, 'product');

        $form->resetElement('product');
        $form->addElement('product', 0, 'Не выбрано (ccылка на раздел)');
        //$form->addElement('product', -1, 'ссылка на раздел');
        foreach($name as $key=>$value) {
            $form->addElement('product', $key, $value['name']);
        }
        $form->selectAll($data);
        return get($name, $product);
    }


    public function newLine($index, &$data) {
        $data['type'] = 'edit';
        return parent::newLine($index, $data);
    }

    public function onchangeSection($id) {
        $form = $this->getForm();
        $form->changeName($this->getNameID($id));
        $section = $form->handlerElement('section');
        $brand = $form->handlerElement('brand');
        $product = $form->handlerElement('product');

        if(!$section) {
            $section = cmfRegister::getSql()->placeholder("SELECT id FROM ?t", db_section)
                                        ->fetchRowAll(0, 0);
        } else {
            $section = cmfRegister::getSql()->placeholder("SELECT id FROM ?t WHERE id=? OR path LIKE '%[?i]%'", db_section, $section, $section)
                                        ->fetchRowAll(0, 0);
        }

        $name = cmfModulLoad('product_list_db')->getProductList($section, $brand ? array('brand'=>$brand): array(1), array('price'));
        $js = $this->getJsProductData($id, get($name, $product));

        $form->resetElement('product');
        $form->addElement('product', 0, 'Не выбрано (ccылка на раздел)');
        //$form->addElement('product', -1, 'ссылка на раздел');
        foreach($name as $key=>$value)
            $form->addElement('product', $key, $value['name']);
		$form->select('product', $product);
		$js .= $form->get('product')->jsUpdate();
		$this->getResponse()->script($js);
	}

	public function onchangeProduct($id) {
		$form = $this->getForm();
		$form->changeName($this->getNameID($id));
		$section = $form->handlerElement('section');
		$brand = $form->handlerElement('brand');
		$product = $form->handlerElement('product');

		if(!$section) {
            $section = cmfRegister::getSql()->placeholder("SELECT id FROM ?t", db_section)
										->fetchRowAll(0, 0);
		} else {
			$section = cmfRegister::getSql()->placeholder("SELECT id FROM ?t WHERE id=? OR path LIKE '%[?i]%'", db_section, $section, $section)
										->fetchRowAll(0, 0);
		}

		$name = cmfModulLoad('product_list_db')->getProductList($section, $brand ? array('brand'=>$brand): array(1), array('price'));
		if(isset($name[$product])) {
			$this->getResponse()->script($this->getJsProductData($id, $name[$product]));
		}
	}

	protected function getJsProductData($id, $value=null) {
		$name = cmfToJsString(get($value, 'name'));
		return <<<HTML
\$('#name{$id}').html('$name');
HTML;
	}

	protected function saveStart(&$send) {
		$send['parent'] = (int)$this->getFilter('section');
		$send['parentBrand'] = (int)$this->getFilter('brand');
		parent::saveStart($send);
	}

}

?>