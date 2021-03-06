<?php


abstract class driver_controller_edit_tree extends driver_controller_edit {


	public function copy($id) {
		$this->setUpdate();
		$new = array();
		$modulAll = $this->getModulAll();
		while(list($name, $modul) = each($modulAll))
			if($name!=='main') $new[$name] = $modul;
		$this->getModul()->copy($id, $new);
	}

	public function delete($list) {
		$this->setUpdate();
		$list = $this->getModul()->delete($list);
		$modulAll = $this->getModulAll();
		while(list($name, $modul) = each($modulAll))
			if($name!=='main') $modul->delete($list);

		$this->deleteChild($list);

		foreach($list as $id) {
			cmfWysiwyng::delRecord($this->getWysiwyngPath(), $id);
		}

		return $list;
	}

	public function deleteChild($id) {
	}
	public function copyChild($id) {
	}


	// возвращает массив пути с url
	public function &path() {
		$path = $this->getModul()->path();
		$item_id = $this->getId();
		foreach($path as $id=>&$value)
			if($item_id!=$id) $value['url'] = $this->getSubmitUrl(array('id'=>$id, 'parentId'=>null));

		$root = array('name'=>'Начало',
					  'url'=>$this->getRootUrl());
		array_unshift($path, $root);
		return $path;
	}

	public function getRootUrl() {
		return $this->getUrl2('catalog');
	}

}

?>