<?php


class product_attach_product_db extends driver_db_list_product_attach {

	protected function getTable() {
		return db_product_attach;
	}

	protected function attach()  {
		return 'product1';
	}

	protected function product()  {
		return 'product2';
	}


	public function save($send) {
		if(isset($send['visible'])) {
			$name = $this->attach();
			$product = $this->product();

			$id = $this->getId();
			$attach = (int)$this->getFilter($name);
			$value = $send['visible'];

			$sql = $this->getSql();
			$table = $this->getTable();
			if($value==='yes') {
				$sql->replace($table, array($name=>$attach, $product=>$id));
				$sql->replace($table, array($name=>$id, $product=>$attach));
			}
			elseif($value==='no') {
				$sql->del($table, array($name=>$attach, 'AND', $product=>$id));
				$sql->del($table, array($name=>$id, 'AND', $product=>$attach));
			}
			$this->setUpdateData(array($product, $attach), $send);
		}
	}

	public function updateData($list, $send) {
        model_product::updateCache($list);
	}

}

?>