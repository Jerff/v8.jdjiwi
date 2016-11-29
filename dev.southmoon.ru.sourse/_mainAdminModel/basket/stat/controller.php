<?php


class basket_stat_controller extends driver_controller_list {

	protected function init() {
		parent::init();
		$this->addModul('main',	'basket_stat_modul');

		// url
		$this->setSubmitUrl('/admin/basket/stat/');
		$this->callFuncWriteAdd('changeFilter');
	}

    public function filterPrice($price) {
        return str_replace(' ', '', $price);
    }

    public function filterType() {
        $start = $this->getFilter('start');
        $end = $this->getFilter('end');
        if(!$end) {
            $end =  date('d-m-Y');
            $this->setFilter('end', $end);
        }
        if(!$start) {            $start = date('d-m-Y', strtotime(cmfReformDate($end, '{d}-{m}-{Y}', '{Y}-{m}-{d}'))-60*60*24*30);
            $this->setFilter('start', $start);        }

		$filter = array();
		$filter['all']['name'] = 'Все';
		$filter[1]['name'] = 'Заказ выполняется';
		$filter[2]['name'] = 'Заказ закончен';
		$filter[0]['name'] = 'Заказ отменен';
		return parent::abstractFilterPart($filter, 'status');
	}

	protected function changeFilter() {
        $opt = array();
		$opt['start'] = $this->getRequest()->getPost('start');
		$opt['end'] = $this->getRequest()->getPost('end');
		$this->getResponse()->addRedirect($this->getSubmitUrl($opt));
	}

	protected function getLimit() {
		return 1000;
	}

	public function getStatus($status) {
		static $_status = array();
		if(!$_status) {
			$_status = cmfModulLoad('basket_status_list_db')->getStatusList();
		}
		return get2($_status, $status, 'name');
	}

}

?>