<?php


cmfLoad('ajax/cmfMainAjax');
cmfLoad('user/cmfUserRegister');
cmfLoad('basket/cmfOrder');
cmfLoad('subscribe/cmfSubscribe');
class cmfBasketDelivery extends cmfMainAjax {

	function __construct($formUrl=null, $name=null, $func=null) {

		if(!$name)		$name = 'basketAdress';
		if(!$formUrl)	$formUrl = cmfControllerUrl .'/basket/delivery/?';
		if(!$func)		$func = 'cmfAjaxSendForm';

		parent::__construct($formUrl, $name, $func);
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
	}

	public function loadData() {
		$basket = new cmfBasket();
		if($basket->isStep(2)) {
            list($formDelivery) = $basket->getStep(2);
            $this->getForm()->selectAll($formDelivery);
            if(isset($formDelivery['delivery'])) {
                $this->set('$isDelivery', $this->get2('$delivery', $formDelivery['delivery']));
                $this->set('$isContact', $this->get2('$contact', $formDelivery['delivery']));
            }
		} 
	}

	protected function runStart() {
        $r = cmfRegister::getRequest();

		$isError = $isUpdate = $isDelivery = $isContact = false;
		$data = array();
		foreach($this->getFormAll() as $i=>$form) {
			$form->setRequest($r);
			$send = $form->handler();
			$isUpdate |= count($send);
		    $isError |= $form->isError();

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

			$data[] = $send;
		}
        if(!$isError and $isUpdate) {
            return $data;
		}
		$this->runEnd(true);
	}

	public function run1() {
		list($formDelivery) = $this->runStart();
		//list($userData, $form2, $form3, $form4, $form5, $form6) = $this->runStart();

		$basket = new cmfBasket();
		if(!$basket->isOrder()) {
			cmfAjax::get()->redirect(cmfGetUrl('/basket/'));
		}

        $delivery = array();
        if($delivery['isDelivery'] = $formDelivery['isDelivery']) {
            $delivery['deliveryPrice'] = cmfRegister::getSql()->placeholder("SELECT price FROM ?t WHERE id=? AND visible='yes'", db_delivery, $formDelivery['delivery'])
		                                ->fetchRow(0);
            $basket->setStep('delivery', $delivery);
        } else {
            $basket->delStep('delivery');
        }
      

		$userDelivery = $this->getForm()->processingName($formDelivery);
        $formDelivery['dName'] = $userDelivery['Cпособ доставки'];
        if(!empty($formDelivery['dNotice'])) {
            $userDelivery['Cпособ доставки'] .= ' <small>('. $formDelivery['dNotice'] .')</small>';
        }

		$basket->setStep(2, array($formDelivery, $userDelivery));
		$basket->save();
        cmfAjax::get()->redirect(cmfGetUrl('/basket/adress/'));
	}

	protected function runEnd($error=false) {
		cmfAjax::get()->script("cmf.basket.scroll('#". $this->getIdForm() ."');");
		parent::runEnd($error);
	}

}

?>