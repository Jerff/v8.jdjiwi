<?php


class dump_size_modul extends driver_modul_list {

	protected function init() {
		parent::init();

		$this->setDb('dump_size_db');

		// формы
		$form = $this->getForm();
		$form->add('name',		    new cmfFormText(array('max'=>150)));
		$form->add('param',		    new cmfFormSelectInt());
		$form->add('value',		    new cmfFormSelectInt());
	}

    public function loadForm() {
        $form = $this->getForm();

        $name = cmfModulLoad('param_list_db')->getNameList();
        cmfGlobal::set('$paramId', key($name));
        $form->addElement('param', 0, 'Не выбрано');
        foreach($name as $key=>$value)
            $form->addElement('param', $key, $value['name']);

        $form->addElement('value', 0, 'Не выбрано');
    }

    public function loadFormRunning($id=0) {
        $form = $this->getForm();
        $form->resetElement('value');
        $form->addElement('value', 0, 'Не выбрано');

        if(!$id) $id = $this->getId();
        $data = $this->getDataId($id);
        if(empty($data)) {
            $param = $form->handlerElement('param');
            if(empty($param)) {
                return;
            }
        }
        if($data) {
            $param = $data['param'];
        }

        $row = cmfModulLoad('param_edit_db')->getDataId($param);
        foreach(cmfString::unserialize($row['value']) as $key=>$value)
            $form->addElement('value', $key, $value);
    }

    public function onchangeParam($id) {
        $form = $this->getForm();
        $form->changeName($this->getNameID($id));
        $param = $form->handlerElement('param');

        $row = cmfModulLoad('param_edit_db')->getDataId($param);
        foreach(cmfString::unserialize($row['value']) as $key=>$value)
            $form->addElement('value', $key, $value);

		$this->getResponse()->script($form->get('value')->jsUpdate());
	}

}

?>