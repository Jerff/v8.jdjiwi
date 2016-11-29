<?php

$infoUri = cmfGlobal::get('$infoUri');;
if(!$infoUri) return 404;
$info = cmfRegister::getSql()->placeholder("SELECT id, parent, path, name, content, title, keywords, description FROM ?t WHERE isUri=? AND isVisible='yes'", db_content, $infoUri)
								->fetchAssoc();
if(!$info) return 404;
$infoId = $info['id'];
$this->assing('info', $info);


if($info['parent']) {
	$parent = cmfRegister::getSql()->placeholder("SELECT id, name, isUri FROM ?t WHERE id=? AND visible='yes'", db_content, $info['parent'])
									->fetchAssoc();
	if(!$parent) return 404;
    cmfMenu::add($parent['name'], cmfGetUrl('/content/', array($parent['isUri'])));
    cmfMenu::add($info['name']);
}


cmfMenu::setSelect('$menuId', $infoId .'menu');
cmfSeo::set('title', $info['title']);
cmfSeo::set('keywords', $info['keywords']);
cmfSeo::set('description', $info['description']);

?>