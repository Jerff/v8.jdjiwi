<?php


class basket_edit_controller extends driver_controller_edit {

	protected function init() {
		parent::init();
		$this->addModul('main',	'basket_edit_modul');

		// url
		$this->setSubmitUrl('/admin/basket/edit/');
		$this->setCatalogUrl('/admin/basket/');
		$this->setUrl('print', '/admin/basket/printer/');
		$this->setUrl('user', '/admin/user/edit/');

		$this->callFuncWriteAdd('setType|changePay|updatePrice|deleteBasket|changeSection|changeProduct|productAdd|sendEMSMail|updateDelivery|updateDeliveryTypeStatus|sendDeliveryStatusMail');
	}


	public function getPrintUrl($opt=null) {
		$opt['id'] = $this->getId();
		return $this->getUrl('print', $opt);
	}
	public function getUserUrl($user) {
		$opt['id'] = $user;
		return $this->getUrl('user', $opt);
	}

	public function listUser() {
		$res = $this->getSql()->placeholder("SELECT id, name, family FROM ?t WHERE id IN(SELECT user FROM ?t WHERE id=? GROUP BY `user`)", db_user, db_basket, $this->getId())
								->fetchAssocAll('id');
		foreach($res as $k=>$v) {
		    $res[$k] = cmfUser::generateName($v);
		}
		return $res;
	}
	public function listStatus() {
		return $this->getSql()->placeholder("SELECT id, name FROM ?t WHERE id IN(SELECT status FROM ?t WHERE id=? GROUP BY `status`)", db_basket_status, db_basket, $this->getId())
								->fetchRowAll(0, 1);
	}


	public function getStatus($data, $jsName=null) {
		static $_status = array();
		if(!$_status) {
			$_status = cmfModulLoad('basket_status_list_db')->getStatusList();
		}

		if(!isset($_status[$data->status])) return '';
		$status = $_status[$data->status];
		$html = <<<HTML
<font color="{$status['color']}">{$status['name']}</font>
HTML;
		if($data->changeDate!==$data->registerDate) {
		    $html .= <<<HTML
<br><font color="{$status['color']}">{$data->changeDate}</font>
HTML;
		}
		if($status['stop']=='1') {
            if($data->isPay=='yes') {
                $html .= '<br><br>оплачено';
            } else {
                if(!$jsName) {
        		    $jsName = $this->getModulName();
        		}
        		$html .= '<br><br>не оплачено<br />'.  cmfAdminView::onclickType1("if(confirm('оплатить?')) {$jsName}.postAjax('changePay', {$this->getId()});", 'оплатить');
            }
		}
		return $html;
	}


	public function getCommand($id, $data, $jsName=null) {
		static $_status = array();
		$isPay = $data->isPay;
		$itemStatus = $data->status;
		if(!isset($_status[$isPay])) {
			$_status[$isPay] = cmfModulLoad('basket_status_list_db')->getStatusList($isPay);
		}
		$html = '';
		if(!$jsName) {
		    $jsName = $this->getModulName();
		}
		if(isset($_status[$isPay][$data->status])) {
            $switch = $_status[$isPay][$data->status]['stop'];
            $status = $data->status;
		} else {
            $switch = 1;
            $status = key($_status[$isPay]);
		}

        $html .=<<<HTML
<select onchange="cmf.pages.typeShange(this, '{$id}');">
<option value="0">Выберите статус</option>
<optgroup label="Заказ выполняется">
HTML;
		switch($switch) {
			case '0':
			case '2':
    			reset($_status[$isPay]);
    			while(list($k, $v) = each($_status[$isPay])) if($v['stop'] == 1)  {
    				$html .=<<<HTML
<option value="{$k}">{$v['name']}</option>
HTML;
				}
				break;

			case '1':
				$is = false;
				for($i=0;$i<=1;$i++) if((!$is and $i) or !$i) {
    				if($i) $is = true;
    				reset($_status[$isPay]);
    				while(list($k, $v) = each($_status[$isPay])) if($v['stop'] == 1)  {
    					if($k==$status and !$is) {
    						$is = true;
    						list($k, $v) = each($_status[$isPay]);
    					}
    					if($is) {
    						$html .=<<<HTML
<option value="{$k}">{$v['name']}</option>
HTML;
                        }
    				}
				}
				break;
		}

        $html .=<<<HTML
</optgroup>
<optgroup label="Заказ отменен">
HTML;
        foreach($_status[$isPay] as $k=>$v) if($itemStatus!=$k) {
        	if(!$v['stop']){
        		$html .=<<<HTML
<option value="{$k}">{$v['name']}</option>
HTML;
        	}
        }

        $html .=<<<HTML
</optgroup>
<optgroup label="Заказ закончен">
HTML;
        foreach($_status[$isPay] as $k=>$v) if($itemStatus!=$k) {
        	if($v['stop']==2){
        		$html .=<<<HTML
<option value="{$k}">{$v['name']}</option>
HTML;
        	}
        }

		$html .=<<<HTML
</optgroup>
</select>
<script language="JavaScript">
cmf.pages.typeShange = function(t, key) {
	if(t.value<0) return;
	if(confirm($('option:eq('+ t.selectedIndex +')', $(t)).text() +'?')) modul.postAjax('setType', key, t.value);
};
cmf.pages.parentShange();
</script>
HTML;
		return $html;
	}


	public function changePay($id) {
		cmfControllerOrder::changePay($id);
		cmfCommand::del('$is');
		$this->setNewView();
    }
	public function setType($id, $status) {
		if(false!==$stop = cmfControllerOrder::setType($id, $status)) {
			if($stop==0 or $stop==2) {
        		cmfCommand::del('$is');
    		}
    		$this->setNewView();
		}
	}

	public function initProduct() {
		$_section = cmfModulLoad('catalog_section_list_tree')->getNameList(array('visible'=>'yes'));
		$_brand = cmfModulLoad('catalog_brand_list_db')->getNameList(array('visible'=>'yes'));
		return array($_section, $_brand);
	}

	protected function changeSection() {
		$this->getModul()->changeSection();
	}
	protected function changeProduct() {
		$this->getModul()->changeProduct();
	}

	protected function updatePrice() {
		$this->getModul()->updatePrice($this->getRequest()->getPost('isAddProduct'));
	}

	protected function updateDeliveryTypeStatus() {
        cmfCronBasketDeliveryStatus::update($this->getId());
        $this->setNewView();
		$this->getResponse()->alert('Обновлено');
	}

	protected function updateDelivery() {
		$this->update();
		$this->getModul()->updatePrice(false);
		cmfCommand::del('$isEdit');
	}

	protected function sendDeliveryStatusMail() {
		$this->getModul()->sendDeliveryStatusMail();
	}

	protected function sendEMSMail() {
		$this->getModul()->sendEMSMail();
	}

	public function delete($list) {
        cmfControllerOrder::delete($list);
		$this->setNewView();
		return $list;
	}

	protected function deleteBasket() {
        $this->delete($this->getId());
        $this->getResponse()->addRedirect($this->getCatalogUrl());
	}

}

?>