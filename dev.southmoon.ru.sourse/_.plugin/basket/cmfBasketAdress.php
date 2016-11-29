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

		parent::__construct($formUrl, $name, $func, 5);
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
        $basket = new cmfBasket();
        list($formDelivery) = $basket->getStep(2);
        $this->set('$isDelivery', $formDelivery['isDelivery']);
        $this->set('$isContact', $formDelivery['isContact']);

        $form = $this->getForm();
        $form->add('name',            new cmfFormText(array('!empty', 'name'=>'Имя', 'specialchars', 'max'=>250)));
        $form->add('family',          new cmfFormText(array('!empty', 'name'=>'Фамилия', 'specialchars', 'max'=>250)));
        $form->add('email',           new cmfFormText(array('!empty', 'name'=>'E-mail', 'email', 'min'=>4, 'max'=>100)));
        $form->add('cod',		      new cmfFormText(array('!empty', 'errorHide1', 'phoneCod', 'min'=>4, 'max'=>4)));
		$form->add('phone',		      new cmfFormText(array('!empty', 'errorHide1', 'name'=>'Телефон', 'phonePostPrefix', 'min'=>7, 'max'=>7)));
		
        $form = $this->getForm(2);
        //$form->add('delivery',  new cmfFormRadioInt(array('name'=>'Cпособ доставки', '!empty')));
		$res = cmfRegister::getSql()->placeholder("SELECT id, name, isDelivery, isContact, notice, basket FROM ?t WHERE visible='yes' ORDER BY pos", db_delivery)
		                                ->fetchAssocAll('id');
		$delivery = $contact = $deliveryNotice = array();
		foreach($res as $k=>$v) {
            //$form->addElement('delivery', $k, $v['name']);
            
            $delivery[$k] = $v['isDelivery']==='yes';
            //$form->addOptions('delivery', $k, 'delivery', $delivery[$k] ? 'true' : 'false');
                        
            $contact[$k] = $v['isContact']==='yes';
            //$form->addOptions('delivery', $k, 'contact', $contact[$k] ? 'true' : 'false');
                        
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
	}

	public function loadData() {
		$user = cmfRegister::getUser();
		$basket = new cmfBasket();
		if($basket->isStep(3)) {
            foreach($basket->getStep(3) as $data) if(is_array($data)) {
                $this->getForm(1)->selectAll($data);
        		$this->getForm(2)->selectAll($data);
        		$this->getForm(3)->selectAll($data);
        		$this->getForm(4)->selectAll($data);
        		$this->getForm(5)->selectAll($data);
            }
		} else {
            $this->getForm(1)->selectAll($user->all);
    		$this->getForm(2)->selectAll($user->all);
    		$this->getForm(3)->selectAll($user->all);
    		$this->getForm(4)->selectAll($user->all);
    		$this->getForm(5)->selectAll($user->all);
		}

	}

	protected function runStart() {
        $isDelivery = $this->get('$isDelivery');
        $isContact = $this->get('$isContact'); 
        
        $r = cmfRegister::getRequest();
		$isError = $isUpdate = false;
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
                                  
		    	$send['isDelivery'] = $isDelivery;
		    	$send['isContact'] = $isContact;
		    }
			$data[] = $send;
		}
        if(!$isError and $isUpdate) {
            return $data;
		}
		$this->runEnd(true);
	}

	public function run1() {
		list($userData, $form2, $form3, $form4, $form5) = $this->runStart();       

		$basket = new cmfBasket();
		if(!$basket->isOrder()) {
			cmfAjax::get()->redirect(cmfGetUrl('/basket/'));
		}

		$data = array_merge($userData, $form2, $form3, $form4, $form5);
        $data['phoneFull'] = $data['cod'] . $data['phone'];

        $email = $userData['email'];
        $userData['phone'] = $userData['cod'] .'-'. $userData['phone'];
		$userData2 = $this->getForm(1)->processingName($userData);
		$userAdress2 = array_merge($this->getForm(2)->processingName($form2),
		                      $this->getForm(4)->processingName($form4),
		                      $this->getForm(3)->processingName($form3),
		                      $this->getForm(5)->processingName($form5));

		
        $basket->setStep(3, array($data, $email, $userData2, $userAdress2));
		$basket->save();
        
        if(cmfRegister::getUser()->is()) {
            cmfAjax::get()->redirect(cmfGetUrl('/basket/pay/'));
        } else {
            cmfAjax::get()->redirect(cmfGetUrl('/basket/subscribe/'));
        }       
	}

	protected function runEnd($error=false) {
		cmfAjax::get()->script("cmf.basket.scroll('#". $this->getIdForm() ."');");
		parent::runEnd($error);
	}

}

?>