<?php


cmfLoad('ajax/cmfMainAjax');
cmfLoad('user/cmfUserRegister');
cmfLoad('basket/cmfOrder');
cmfLoad('subscribe/cmfSubscribe');
class cmfBasketSubscribe extends cmfMainAjax {

	function __construct($formUrl=null, $name=null, $func=null) {

		if(!$name)		$name = 'basketAdress';
		if(!$formUrl)	$formUrl = cmfControllerUrl .'/basket/subscribe/?';
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
        foreach(cmfSubscribe::typeList() as $k=>$v) {
            $form->add($k,    new cmfFormCheckbox(array('name'=>$v)));
		}
	}

	public function loadData() {		
		$basket = new cmfBasket();
		if($basket->isStep(4)) {
            foreach($basket->getStep(4) as $data) if(is_array($data)) {
                $this->getForm()->selectAll($data);
            }
		} else {
    		$user = cmfRegister::getUser();
            $this->getForm()->selectAll($user->all);
    		if($this->get('$isSubscribe'))
        		cmfSubscribe::selectForm($this->getForm(), $user->getId(), $user->email);
		}
	}


	public function run1() {
		$formSubscribe = $this->runStart();

        $basket = new cmfBasket();
		if(!$basket->isOrder()) {
			cmfAjax::get()->redirect(cmfGetUrl('/basket/'));
		}       
        
		$userSubscribe = $this->getForm()->processingName($formSubscribe);

		$basket->setStep(4, array($formSubscribe, $userSubscribe));
		$basket->save();
        
        cmfAjax::get()->redirect(cmfGetUrl('/basket/pay/'));
	}

	protected function runEnd($error=false) {
		cmfAjax::get()->script("cmf.basket.scroll('#". $this->getIdForm() ."');");
		parent::runEnd($error);
	}

}

?>