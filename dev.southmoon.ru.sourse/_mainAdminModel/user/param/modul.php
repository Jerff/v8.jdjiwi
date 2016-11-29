<?php


class user_param_modul extends driver_modul_edit {

	protected function init() {
		parent::init();

		$this->setDb('user_param_db');

		// формы
		$form = $this->getForm();
		$form->add('cod',           new cmfFormText(array('errorHide1', 'specialchars', 'max'=>250)));
		$form->add('phone',		    new cmfFormText(array('errorHide1', 'name'=>'Телефон', 'specialchars', 'max'=>250)));
        $form->add('gorod',     new cmfFormText(array('name'=>'Город', 'max'=>100)));
        $form->add('index',     new cmfFormText(array('name'=>'Индекс', 'max'=>15)));  
        
		foreach(model_subscribe::typeList() as $k=>$v) {
            $form->add($k,    new cmfFormCheckbox(array('label'=>$v['name'])));
		}
	}

	public function loadForm() {
		parent::loadForm();

		$user = cmfModulLoad('user_edit_db')->getDataId($this->getId());
		cmfGlobal::set('$userName', cmfUser::generateName($user));
	}

	protected function selectForm($data) {
		parent::selectForm($data);
		$user = cmfModulLoad('user_edit_db')->getDataId($this->getId());

        $isAll = true;
        foreach(model_subscribe::typeList() as $k=>$v) {
            if(get($data, $k)==='yes') {
                $isAll = false;
            }
		}
		if($isAll) {
            cmfSubscribe::selectForm($this->getForm(), $this->getId(), $user['email']);
		}
	}

	protected function saveStart(&$send) {
		parent::saveStart($send);
		if(!$this->getId()) {
			$send['date'] = date('Y-m-d H:i:s');
			$send['status'] = 'неактивна';
		}
	}

	protected function saveEnd($send) {
	    $user = cmfModulLoad('user_edit_db')->getDataId($this->getId());
	    foreach(model_subscribe::typeList() as $k=>$v) {
            if(isset($send[$k])) {
        		if($send[$k]==='yes') {
        		    cmfSubscribe::addUser($this->getId(), $user['email'], $k);
        		} else {
                    cmfSubscribe::delUser($this->getId(), $user['email'], $k);
        		}
    		}
		}
	}

}

?>