<?php


$infoUri = cmfGlobal::get('$infoUri');;
if(!$infoUri) return 404;
$info = cmfRegister::getSql()->placeholder("SELECT id, view, parent, name, content, title, keywords, description FROM ?t WHERE isUri=? AND isVisible='yes'", db_content_info, $infoUri)
								->fetchAssoc();
if(!$info) return 404;
$infoId = $info['id'];
$this->assing('info', $info);


if($info['parent']) {
	$parent = cmfRegister::getSql()->placeholder("SELECT id, view, name, isUri FROM ?t WHERE id=? AND visible='yes'", db_content_info, $info['parent'])
									->fetchAssoc();
	if($parent['view']=='faq') return 404;
	if(!$parent) return 404;
    cmfMenu::add($parent['name'], cmfGetUrl('/info/', array($parent['isUri'])));
}
cmfMenu::add($info['name']);


switch($info['view']) {
    case 'faq':
        $res = cmfRegister::getSql()->placeholder("SELECT id, name, content FROM ?t WHERE parent=? AND visible='yes'", db_content_info, $infoId)
									->fetchAssocAll();
		$_info = array();
		foreach($res as $row) {
            $_info[] = array('name'=>$row['name'],
                             'content'=>$row['content']);
		}
		$this->assing('_faq', $_info);
        break;

    case 'info':
        $res = cmfRegister::getSql()->placeholder("SELECT name, isUri FROM ?t WHERE parent=? AND isVisible='yes' ORDER BY pos", db_content_info, $infoId)
                                            ->fetchAssocAll();
        $_info = array();
        foreach($res as $row) {
            $_info[] = array(   'name'=>$row['name'],
                                'url'=>cmfGetUrl('/info/', array($row['isUri'])));
        }
        if($_info)
            $this->assing('_info', $_info);
        break;
}

cmfMenu::setSelect('$menuId', $infoId .'menu');
cmfSeo::set('title', $info['title']);
cmfSeo::set('keywords', $info['keywords']);
cmfSeo::set('description', $info['description']);

?>