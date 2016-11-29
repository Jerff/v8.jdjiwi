<?php


class basket_edit_modul extends driver_modul_edit {

	protected function init() {
		parent::init();

		$this->setDb('basket_edit_db');
	}

	protected function deleteBasket() {

	}

	protected function isEdit() {

		return true;
		$data = $this->getData();
		if(!isset($data['status'])) {
			$data = $this->runData();
		}
		if($data['isPay']==='yes') return false;
		return (bool)cmfModulLoad('basket_status_edit_db')->getDataWhere(array('id'=>$data['status'], 'AND', 'stop'=>1));
	}

	public function loadForm() {
    	$form = $this->getForm();
	    if($this->isEdit()) {
	        cmfCommand::set('$is');
    	    $form->add('deliveryType',		new cmfFormSelect());
            $form->addElement('deliveryType', '', 'Не выбрано');
            $form->addElement('deliveryType', 'russian-post', 'Почта-россии');
            $form->addElement('deliveryType', 'ems', 'EMS');
            $form->select('deliveryType', 'ems');

    	    $form->add('deliveryCod',		new cmfFormText());
    	    $form->add('EMS',		        new cmfFormText());

    		$form->add('isDelivery',		new cmfFormCheckbox());
    		$form->add('deliveryPrice',		new cmfFormTextInt());
	    }
	}

	protected function selectForm($data) {
		parent::selectForm($data);
		if(isset($data['data'])) {
    		list(, $email, $userData, $userAdress, $userSubscribe) = unserialize($data['data']);
		}
	}

    public function updatePrice($isNew) {
		if(!$this->isEdit()) return;

        $r = $this->getRequest();
		$newList = array();
        $productList = $r->getPost('productList');
        $deleteList = $r->getPost('deleteList');
		if($isNew) {
    		$newId = (int)$r->getPost('product');
    		$newParam = $r->getPost('param');
            $param = $this->getParamProduct($newId);
            foreach((array)$newParam as $k=>$v) {
                if(!isset($param[$k])) unset($newParam[$k]);
            }
            if(empty($newParam) and empty($param)) {
                $newParam = array(0=>'on');
            }

            $newColor = $r->getPost('color');
            $color = $this->getColorProduct($newId);
            foreach((array)$newColor as $k=>$v) {
                if(!isset($color[$k])) unset($newColor[$k]);
            }
            if(empty($newColor)) {
                $newColor = array(0=>'on');
            }

            if($newParam and $newColor) {
                foreach($newParam as $pId=>$v) {
                    foreach($newColor as $cId=>$v) {
                        $newList[$newId][$pId][$cId] = 1;
                    }
                }
            }
		}

        cmfControllerOrder::updatePrice($this->getId(), $productList, $newList, $deleteList);
		$this->setNewView();
		cmfCommand::set('$isEdit');
    }


	public function changeSection() {
        $r = $this->getRequest();
        $section = (int)$r->getPost('section');
        $brand = (int)$r->getPost('brand');
        if(!$section) {
            $this->getResponse()->loadHTML('productId', '')
                                ->loadHTML('paramId', '')
                                ->loadHTML('colorId', '');
        }

		$section = cmfModulLoad('catalog_section_list_db')->getListId(array("(id='{$section}' OR path LIKE '%[{$section}]%')", 'AND', 'visible'=>'yes'));
        $where = array('section'=>$section);
		if($brand) {
            $where[] = 'AND';
            $where['brand'] = $brand;
		}
		$where[] = 'AND';
		$where['visible'] = 'yes';

		$product = cmfModulLoad('product_list_db')->getDataList($where);
        $html = '<select name="product" style="width:99%" onchange="modul.postAjax(\'changeProduct\');">
        <option>Выберите</option>';
        foreach($product as $k=>$v) {
        	$html .= '<option value="'. $k .'">'. $v['name'] .'</option>';
        }
        $html .= '</select>';
        $this->getResponse()->loadHTML('productId', $html)
                            ->loadHTML('paramId', '')
                            ->loadHTML('colorId', '');
	}

	public function changeProduct() {
        $sql = cmfRegister::getSql();
        $r = $this->getRequest();
        $product = (int)$r->getPost('product');
        if(!$product) {
            $this->getResponse()->loadHTML('paramId', '')
                                ->loadHTML('colorId', '');
        }

        $html = '';
        foreach($this->getParamProduct($product) as $k=>$v) {
            $html .= '<label><input name="param['. $k .']" type="checkbox"> '. $v .'</label>';
        }
        $this->getResponse()->loadHTML('paramId', $html);

        $html = '';
        foreach($this->getColorProduct($product) as $k=>$v) {
            $html .= '<label><input name="color['. $k .']" type="checkbox"> '. $v .'</label>';
        }
        $this->getResponse()->loadHTML('colorId', $html);
	}

	public function getParamProduct($product) {
        $sql = cmfRegister::getSql();
        $product = cmfModulLoad('product_list_db')->getDataId($product);
        $section = $product['section'];
        $basket = 0;
        while($section) {
            list($section, $basket) = $sql->placeholder("SELECT parent, basket FROM ?t WHERE id=?", db_section, $section)
                                           ->fetchRow();
        }
        $param = $sql->placeholder("SELECT value FROM ?t WHERE id=?", db_param, $basket)
                                           ->fetchRow(0);
        $param = cmfString::unserialize($param);
        $value = cmfString::unserialize($product['param']);

        $isPrice = !$product['price1'];
        $productPrice = cmfString::unserialize($product['paramPrice']);
        foreach($param as $k=>$v) {
            if(!isset($value[$basket][$k]) or
                ($isPrice and empty($productPrice[$k]))) {
                unset($param[$k]);
            }
        }
        return $param;
	}


	public function getColorProduct($product) {
        $sql = cmfRegister::getSql();
        $product = cmfModulLoad('product_list_db')->getDataId($product);
        $color = cmfString::pathToArray($product['colorAll']);
        return $sql->placeholder("SELECT id, name FROM ?t WHERE id ?@ ORDER BY name", db_color, cmfString::pathToArray($product['colorAll']))
                                           ->fetchRowAll(0, 1);
	}

	public function sendDeliveryStatusMail() {
        $data = $this->runData();
        list($userData, $email) = unserialize($data['data']);

		$userData['orderUrl'] = cmfGetUrl('/user/order/one/', array($this->getId()));
        $userData['orderId'] = $this->getId();
        $userData['EMS'] = $data['deliveryCod'];
        $cmfMail = new cmfMail();
		$cmfMail->sendTemplates('Корзина заказа: Cообщение клиенту о EMS номере заказа', $userData, $email);

		$this->getDb()->save(array('deliverySend'=>'yes'));
		$this->setNewView();
    }

	public function sendEMSMail() {
        $data = $this->runData();
        list($userData, $email) = unserialize($data['data']);

		$userData['orderUrl'] = cmfGetUrl('/user/order/one/', array($this->getId()));
        $userData['orderId'] = $this->getId();
        $userData['EMS'] = $data['EMS'];
        $cmfMail = new cmfMail();
		$cmfMail->sendTemplates('Корзина заказа: Cообщение клиенту о EMS номере заказа', $userData, $email);

		$this->getDb()->save(array('EMSSend'=>'yes'));
		$this->setNewView();
    }

	protected function processingForm($id) {
	    $send = $this->getForm()->processing($id);
        $data = $this->runData();
        $userRes = cmfString::unserialize($data['data']);
        $text = (array)$this->getRequest()->getPost('text');

        $isUpdate = false; $i = 0;
        for($id=2; $id<=3; $id++)
        if(isset($userRes[$id]) and is_array($userRes[$id])) foreach($userRes[$id] as $k=>$v) if(isset($text[$i])) {
            if($text[$i]!=$v) {
                $isUpdate = true;
                $userRes[$id][$k] = $text[$i];
            }
            $i++;
        }
		$send['data'] = cmfString::serialize($userRes);
	    return $send;
	}

	protected function saveStart(&$send) {
		if(isset($send['EMS'])) {
		    $send['EMSSend'] = 'no';
		}
		parent::saveStart($send);
	}

}

?>