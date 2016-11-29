<?php


class article_list_controller extends driver_controller_list {

	protected function init() {
		parent::init();
		$this->addModul('main',	'article_list_modul');

		// url
		$this->setSubmitUrl('/admin/article/');
		$this->setEditUrl('/admin/article/edit/');
		$this->setUrl('attach', '/admin/article/attach/');
	}

    public function viewListSiteUrl() {
        $arg = func_get_arg(0);
        return parent::viewListSiteUrl('/article/', $arg->uri);
    }

	public function filterSection() {
		$filter = cmfModulLoad('catalog_section_list_tree')->getNameList(array('level'=>array(0, 1)), array('isUri'));
		cmfGlobal::set('$sectionId', array_keys($filter));
		$filter[-1]['name'] = 'Без разделов';
		$filter[0]['name'] = 'Все разделы';
		return parent::abstractFilterPart($filter, 'section', 'end');
	}

	public function delete($id) {
		$id = cmfModulLoad('article_edit_controller')->delete($id);
		return parent::delete($id);
	}

	public function getProductUrl($opt=null) {
		$opt['article'] = $this->getId();
		$opt['page'] = 1;
		return $this->getUrl('attach', $opt);
	}

	public function attachProduct() {
		return $this->getSql()->placeholder("SELECT article, count(product2) AS count FROM ?t WHERE article ?@ GROUP BY article", db_article_attach, $this->getDataId())
                              ->fetchRowAll(0, 1);
	}


}

?>