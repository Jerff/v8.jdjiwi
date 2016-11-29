<?php


class param_group_notice_controller extends driver_controller_list_all {

	protected function init() {
		parent::init();
		$this->addModul('main',	'param_group_notice_modul');

		// url
		$this->setSubmitUrl('/admin/param/group/notice/');
		$this->setUrl('select', '/admin/param/group/notice/');
	}

	public function getSelectUrl($id) {
		$opt = array('parentId'=>$id);
		return $this->getUrl('select', $opt);
	}

	public function deleteSection($id) {
		$where = array('group'=>$id);
		$this->delete($this->getListId($where));
	}

	public function parentParam() {
		$parent = cmfAdminMenu::getSubMenuId();
		list($name, $path) = cmfModulLoad('catalog_section_edit_db')->getFeildsId(array('name', 'path'), $parent);
		$path1 = $path2 = cmfString::pathToArray($path);
		$path1[$parent] = $parent;
		$res = $this->getSql()->placeholder("SELECT p.param FROM ?t p WHERE p.`group` ?@ ORDER BY FIELD(`group`, ?s)", db_param_group_select, $path1, implode(',', $path1))
								->fetchRowAll(0, 0);
		$menu = model_param::initParamMenu();
        $filter = array();
        foreach($res as $p) {
            $filter[$p] = get($menu, $p);
        }

		if($path2) {
			$res = $this->getSql()->placeholder("SELECT p.`group`, (SELECT s.name FROM ?t s WHERE s.id=p.group) AS name, (SELECT name FROM ?t WHERE id IN (SELECT sec.basket FROM ?t sec WHERE sec.id=p.group)) AS basket, p.param FROM ?t p WHERE p.`group` ?@ ORDER BY FIELD(`group`, ?s), p.pos", db_section, db_param, db_section, db_param_group_notice, $path2, implode(',', $path2))
									->fetchAssocAll();
			$menu = model_param::initParamMenu();
			$param = array();
			foreach($res as $row) {
			    $param[$row['group']]['basket'] = $row['basket'];
	            $param[$row['group']]['name'] = $row['name'];
	            $param[$row['group']]['list'][$row['param']] = get($menu, $row['param']);
	            unset($filter[$row['param']]);
			}
		} else {
			$param = false;
		}

		return array($name, $filter, $param);
	}

}

?>