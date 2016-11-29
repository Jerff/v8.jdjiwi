<?php


class main_shop_modul extends driver_modul_list {

	protected function init() {
		parent::init();

		$this->setDb('main_shop_db');

		// формы
		$form = $this->getForm();
		$this->setNewPos();
		$form->add('image',	new cmfFormFile(array('name'=>'image', 'path'=>cmfFilePathImage)));

		$form->add('name',		new cmfFormText(array('max'=>150)));
		$form->add('visible',		new cmfFormCheckbox());

		$form->add('section',		new cmfFormSelectInt());
		$form->add('product',		new cmfFormSelectInt());
	}

	public function loadForm() {
		$form = $this->getForm();
        $name = cmfModulLoad('catalog_section_list_db')->getNameList();
        cmfGlobal::set('$sectionId', key($name));
        foreach($name as $key=>$value)
			$form->addElement('section', $key, $value['name']);
	}

	public function newLine($index, &$data) {
		$this->getDb()->loadData($data);
		$line = array('data'=>$data);

		$form = $this->getForm();
		$form->changeName($this->getNameID($index));
		$this->selectForm($data);
		return $form;
	}

	public function loadForm2($id=null) {
		if(!$id) $id = $this->getId();

		$form = $this->getForm();
		$data = $this->getDataId($id);

		$section = get($data, 'section');
		if(!$section) $section = cmfGlobal::get('$sectionId');

        $name = cmfModulLoad('product_list_db')->getProductList($section, array(1), array('price'));
		$product = get($data, 'product');

		$form->resetElement('product');
		foreach($name as $key=>$value) {
			if(!$product) {
				$product = $key;
			}
			$form->addElement('product', $key, $value['name']);
		}
		$form->selectAll($data);
		return get($name, $product);
	}

	public function loadFormNewLine($index) {
		$product = $this->loadForm2($index);
		return $this->getJsProductData($index, $product);
	}


	public function onchangeSection($id) {
		$form = $this->getForm();
		$form->changeName($this->getNameID($id));
		$section = $form->handlerElement('section');

		$name = cmfModulLoad('product_list_db')->getProductList($section, array(1), array('price'));
		$js = $this->getJsProductData($id, $name ? $name[key($name)] : null);

		$form->resetElement('product');
		foreach($name as $key=>$value)
			$form->addElement('product', $key, $value['name']);
		$js .= $form->getJsSetElement('product', false);
		$this->getResponse()->script($js);
	}


	public function onchangeProduct($id) {
		$form = $this->getForm();
		$form->changeName($this->getNameID($id));
		$section = $form->handlerElement('section');
		$product = $form->handlerElement('product');


		$name = cmfModulLoad('product_list_db')->getProductList($section, array(1), array('price'));
		if(isset($name[$product])) {
			$this->getResponse()->script($this->getJsProductData($id, $name[$product]));
		}
	}

	protected function getJsProductData($id, $value=null) {
		$name = cmfToJsString(get($value, 'name'));
		$price = cmfToJsString(get($value, 'price'));
		$articul = cmfToJsString(get($value, 'articul'));
		$image = cmfToJsString(get($value, 'image'));
		return <<<HTML
\$('#name{$id}').html('Название: $name');
\$('#price{$id}').html('Цена: $price');
if('{$image}') {
	style.show('image{$id}');
	\$('#image{$id}>img').attr('src', '{$image}');
} else {
	style.hide('image{$id}');
}
HTML;
	}

}

?>