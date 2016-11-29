<?php

cmfLoad('basket/cmfBasket');
cmfLoad('user/model/cmfDriverUser');
cmfLoad('user/authorization/cmfAuth');
class cmfUser extends cmfAuth {

	protected function getName() {
	    return 'sessionUser';
	}

    // ������ ������ ������
    protected function getFields() {
		return array('id', 'login', 'email', 'name', 'family', 'email');
	}
    // ������ �������������� ������
	public function getFieldsParam() {
		return array('discount', 'userBasket', 'userPay');
	}

	// ������
	public function filterIsUser(){
		if($this->is()) return;
		cmfRedirect(cmfGetUrl('/user/enter/'));
	}
	public function filterNoUser(){
		if(!$this->is()) return;
		if(isset($_GET['fancybox'])) {
		    ?>
            <script type="text/javascript">
            cmf.redirect('<?=cmfGetUrl('/user/') ?>');
            </script>
		    <?
            exit;
		} else {
		    cmfRedirect(cmfGetUrl('/user/'));
		}
	}


	protected function sessionUpdate() {
        $data = $this->getData();
		cmfCookie::set($this->getName() .'Name', $data['name']);
		cmfCookie::set($this->getName() .'Email', $data['email']);
		cmfCacheUser::setDiscount($data['discount']);
		cmfCacheUser::setPay($data['userPay']);
		if(!empty($data['userBasket'])) {
			$basket = new cmfBasket();
			$basket->loadUser($data['userBasket']);
		}
	}


	public function updateBasket($basket) {
		if($this->getId())
		cmfRegister::getSql()->add(db_user_data, array('userBasket'=>$basket), $this->getId());
	}


	protected function sessionRemove() {
		parent::sessionRemove();
		cmfCookie::del($this->getName() .'Name');
		cmfCacheUser::setDiscount(0);
	}

    // ������������
	public function logOut(){
		parent::logOut();
		$basket = new cmfBasket();
		$basket->disable();
	}

	public static function generateName($send){
		$name = array();
        if(isset($send['Имя'])) {
            if(!empty($send['Имя'])) $name[] = $send['Имя'];
            if(!empty($send['Фамилия'])) $name[] = $send['Фамилия'];         
        } else {
            if(!empty($send['name'])) $name[] = $send['name'];
            if(!empty($send['family'])) $name[] = $send['family'];            
        }
		return implode(' ', $name);
	}

	public static function getUserId() {
		return cmfGlobal::get('$userId');
	}

}

?>