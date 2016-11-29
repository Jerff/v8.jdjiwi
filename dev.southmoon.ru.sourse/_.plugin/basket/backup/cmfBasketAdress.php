<?php


cmfLoad('ajax/cmfMainAjax');
cmfLoad('user/cmfUserRegister');
cmfLoad('basket/cmfOrder');
cmfLoad('subscribe/cmfSubscribe');
class cmfBasketAdress extends cmfMainAjax {

	function __construct($formUrl=null, $name=null, $func=null) {

		if(!$name)		$name = 'basketAdress';
		if(!$formUrl)	$formUrl = cmfControllerUrl .'/basket/adress/?';
		if(!$func)		$func = 'cmfAjaxSendForm';

		parent::__construct($formUrl, $name, $func, 6);
	}

	public function get($n) {
		return parent::get($n);
	}

	public function get2($n, $n2) {
		return parent::get2($n, $n2);
	}

	public function get3($n, $n2, $n3) {
		return parent::get3($n, $n2, $n3);
	}

	protected function init() {
        $form = $this->getForm();
        $form->add('name',            new cmfFormText(array('!empty', 'name'=>'Имя', 'specialchars', 'max'=>250)));
        $form->add('family',          new cmfFormText(array('!empty', 'name'=>'Фамилия', 'specialchars', 'max'=>250)));
        $form->add('email',           new cmfFormText(array('!empty', 'name'=>'E-mail', 'email', 'min'=>4, 'max'=>100)));
        $form->add('cod',		      new cmfFormText(array('!empty', 'errorHide1', 'int', 'min'=>4, 'max'=>4)));
		$form->add('phone',		      new cmfFormText(array('!empty', 'errorHide1', 'name'=>'Телефон', 'int', 'min'=>7, 'max'=>7)));
		
        $form = $this->getForm(2);
        $form->add('delivery',  new cmfFormRadioInt(array('name'=>'Cпособ доставки', '!empty')));
		$res = cmfRegister::getSql()->placeholder("SELECT id, name, isDelivery, isContact, notice, basket FROM ?t WHERE visible='yes' ORDER BY pos", db_delivery)
		                                ->fetchAssocAll('id');
		$delivery = $contact = $deliveryNotice = array();
		foreach($res as $k=>$v) {
            $form->addElement('delivery', $k, $v['name']);
            
            $delivery[$k] = $v['isDelivery']==='yes';
            $form->addOptions('delivery', $k, 'delivery', $delivery[$k] ? 'true' : 'false');
                        
            $contact[$k] = $v['isContact']==='yes';
            $form->addOptions('delivery', $k, 'contact', $contact[$k] ? 'true' : 'false');
                        
            $deliveryNotice[$k] = array('notice'=>$v['notice'],
                                        'basket'=>$v['basket']);
    	}
    	$this->set('$delivery', $delivery);
    	$this->set('$contact', $contact);
    	$this->set('$deliveryNotice', $deliveryNotice);

		$form = $this->getForm(3);
        $form->add('adress',		  new cmfFormTextarea(array('!empty', 'name'=>'Адрес', 'specialchars', 'max'=>2000)));

		$form = $this->getForm(4);
        $form->add('gorod',           new cmfFormText(array('!empty', 'name'=>'Город', 'max'=>100)));
        $form->add('index',           new cmfFormText(array('!empty', 'name'=>'Индекс', 'max'=>15)));

		$form = $this->getForm(5);
        $form->add('notice',		  new cmfFormTextarea(array('name'=>'Пожелания', 'specialchars', 'max'=>1000)));

		$form = $this->getForm(6);
        if($this->set('$isSubscribe', !cmfRegister::getUser()->is()))
        foreach(cmfSubscribe::typeList() as $k=>$v) {
            $form->add($k,    new cmfFormCheckbox(array('name'=>$v)));
		}
	}

	public function loadData() {
		$user = cmfRegister::getUser();
		$basket = new cmfBasket();
		if($basket->isStep(2)) {
            foreach($basket->getStep(2) as $data) if(is_array($data)) {
                $this->getForm(1)->selectAll($data);
        		$this->getForm(2)->selectAll($data);
        		$this->getForm(3)->selectAll($data);
        		$this->getForm(4)->selectAll($data);
        		$this->getForm(5)->selectAll($data);
                $this->getForm(6)->selectAll($data);
                if(isset($data['delivery'])) {
                    $this->set('$isDelivery', $this->get2('$delivery', $data['delivery']));
                    $this->set('$isContact', $this->get2('$contact', $data['delivery']));
                }
            }
		} else {
            $this->getForm(1)->selectAll($user->all);
    		$this->getForm(2)->selectAll($user->all);
    		$this->getForm(3)->selectAll($user->all);
    		$this->getForm(4)->selectAll($user->all);
    		$this->getForm(5)->selectAll($user->all);
    		$this->getForm(6)->selectAll($user->all);
    		if($this->get('$isSubscribe'))
        		cmfSubscribe::selectForm($this->getForm(6), $user->getId(), $user->email);
		}
	}

	protected function runStart() {
        $r = cmfRegister::getRequest();

		$isError = $isUpdate = $isDelivery = $isContact = false;
		$data = array();
		foreach($this->getFormAll() as $i=>$form) {
			if(!$isDelivery and ($i==3 or $i==4)) {
                $data[] = array();
                continue;
			} elseif(!$isContact and $i==4) {
                $data[] = array();
                continue;
			}
			$form->setRequest($r);
			$send = $form->handler();
			$isUpdate |= count($send);
		    $isError |= $form->isError();

		    if($i==1) {
                if($form->getErrorElement('cod')===$form->getErrorElement('phone')) {
                    $form->delError('cod');
                }
		    }
		    if($i==2) {
		    	if($send['delivery']) {
                    $isDelivery = $this->get2('$delivery', (int)$send['delivery']);
		    	    $isContact = $this->get2('$contact', (int)$send['delivery']);
		    	} else {
		    	    $isDelivery = $isContact = true;
		    	}
		    	$send['isDelivery'] = $isDelivery;
		    	$send['isContact'] = $isContact;
		    	$send['dNotice'] = $this->get3('$deliveryNotice', (int)$send['delivery'], 'notice');
		    	$send['dBasket'] = $this->get3('$deliveryNotice', (int)$send['delivery'], 'basket');
		    }
			$data[] = $send;
		}
        if(!$isError and $isUpdate) {
            return $data;
		}
		$this->runEnd(true);
	}

	public function run1() {
		list($userData, $form2, $form3, $form4, $form5, $form6) = $this->runStart();

		$basket = new cmfBasket();
		if(!$basket->isOrder()) {
			cmfAjax::get()->redirect(cmfGetUrl('/basket/'));
		}

		$data = array_merge($userData, $form2, $form3, $form4, $form5, $form6);
        $data['phoneFull'] = $data['cod'] . $data['phone'];

        $delivery = array();
        if($delivery['isDelivery'] = $data['isDelivery']) {
            $delivery['deliveryPrice'] = cmfRegister::getSql()->placeholder("SELECT price FROM ?t WHERE id=? AND visible='yes'", db_delivery, $data['delivery'])
		                                ->fetchRow(0);
            $basket->setStep('delivery', $delivery);
        } else {
            $basket->delStep('delivery');
        }
        $email = $userData['email'];
        $userData['phone'] = $userData['cod'] .'-'. $userData['phone'];
		$userData2 = $this->getForm(1)->processingName($userData);
		$userAdress2 = array_merge($this->getForm(2)->processingName($form2),
		                      $this->getForm(4)->processingName($form4),
		                      $this->getForm(3)->processingName($form3),
		                      $this->getForm(5)->processingName($form5));
        $data['dName'] = $userAdress2['Cпособ доставки'];
        if(!empty($form2['dNotice'])) {
            $userAdress2['Cпособ доставки'] .= ' <small>('. $form2['dNotice'] .')</small>';
        }
		$userSubscribe2 = $this->getForm(6)->processingName($form5);


		$basket->setStep(2, array($data, $email, $userData2, $userAdress2, $userSubscribe2));
		$basket->save();
        cmfAjax::get()->redirect(cmfGetUrl('/basket/pay/'));
	}

	protected function runEnd($error=false) {
		cmfAjax::get()->script("cmf.basket.scroll('#". $this->getIdForm() ."');");
		parent::runEnd($error);
	}

}

?>