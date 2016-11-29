<?php


abstract class driver_db_list_tree extends driver_db_list {


	// SELECT fileds FROM..
	protected function getFields() {
		return array('id', 'parent', 'level', 'pos', 'name', 'visible');
	}

	protected function getSort() {
		return array('level', 'pos');
	}

	protected function startSaveWhere() {
		return array('parent');
	}

    public function filterStartView() {
        return 0;
    }
	protected function runListQuery($id=null, $offset=null, $limit=null) {
		if(is_null($id)) {
			return $this->getSql()->placeholder("SELECT ?f FROM ?t WHERE ?w ORDER BY ?o", $this->getFields(), $this->getTable(), $this->getWhereFilter(), $this->getSort());
		}
		else {
			return $this->getSql()->placeholder("SELECT ?f FROM ?t WHERE ?w AND ?w ORDER BY ?o", $this->getFields(), $this->getTable(), $this->getWhereFilter(), $this->getWhereId($id), $this->getSort());
		}
	}
	protected function &runListData($res) {
		$data = $tree = $level = array();
		$list = $res->fetchAssocAll('id');
		$levelId = get2($list, $this->filterStartView(), 'level', 0);
		foreach($list as $id=>$row) {

			$tree[$row['parent']][] = $id;
			$row['level'] -= $levelId;
			$level[] = $row['level'];

			$this->loadData($row);
			$data[$id] = $row;
		}

		$colspan = count($level) ? max($level)+1 : 1;
		foreach($data as &$row) {
			$row['colspan'] = $colspan - $row['level'];
		}
		$data = array($data, $tree, $colspan);
		return $data;
	}


	public function getNameList($filter=null, $fileds=null, $isName=true) {
		if(is_null($filter)) $filter = $this->getWhereFilter();
		if(is_array($fileds)) {
			array_push($fileds, 'id', 'parent', 'name');
		} else {
			$fileds = array('id', 'parent', 'name');
		}

		$name = $this->getSql()->placeholder("SELECT ?f FROM ?t WHERE ?w ORDER BY ?o", $fileds, $this->getTable(), $filter, $this->getSort())
									->fetchAssocAll('parent', 'id');

		$line = array();
		$this->getNameListTree($name, $line);
		return $line;
	}

	protected function getNameListTree(&$tree, &$line, $parent=0, $name=null) {
		if(!isset($tree[$parent])) return;
		foreach($tree[$parent] as $key=>$value) {
			$value['name'] = $name . $value['name'];
			$line[$key] = $value;
			if(isset($tree[$key])) $this->getNameListTree($tree, $line, $key, $value['name'].' -> ');
		}
	}

	public function updateVisible($send) {
		cmfAdminTree::updateVisible($this->getTable(), $this->getId());
	}


	/* ������� ��� ������ */
	public function getChildList($section) {
		return $this->getSql()->placeholder("SELECT id FROM ?t WHERE id=? OR path LIKE '%[?i]%'", $this->getTable(), $section, $section)
								->fetchRowAll(0, 0);
	}

}

?>