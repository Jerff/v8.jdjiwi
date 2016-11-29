<?php


class dump_size_controller extends driver_controller_list_all {

	protected function init() {
		parent::init();
		$this->addModul('main',	'dump_size_modul');

		// url
		$this->setSubmitUrl('/admin/dump/');

		$this->callFuncWriteAdd('newLine|updateDump');
		$this->callFuncReadAdd('onchangeParam');
	}


	protected function updateDump() {
        cmfCronRun::runModul('product.dump');
        $this->setNewView();
        $this->getResponse()->addAlert('Обновление завершено');
	}


    public function getLog($all=true) {
        $res = $this->getSql()->placeholder("SELECT date, content FROM ?t WHERE important='yes' ORDER BY date DESC LIMIT 0, 20", db_product_dump_log)
                              ->fetchAssocAll();
        foreach($res as &$row) {
            if(strtotime($row['date']) + 10*24*60*60 - time()>0) {
                $row['isNew'] = true;
            }
            $row['date'] = date('d.m.Y H:i', strtotime($row['date']));
        }
        return $res;
	}

	protected function onchangeParam($id) {
		$this->getModul()->onchangeParam($id);
	}

	public function delete($id) {
		parent::deleteList($id);
		return parent::delete($id);
	}

}

?>