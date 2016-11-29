<?php

cmfGlobal::set('$headerId', 'photo');
$uri = cmfPages::getParam(1);
if(!$uri) return 404;
$news = cmfRegister::getSql()->placeholder("SELECT id, date, header, content, title, keywords, description FROM ?t WHERE uri=? AND visible='yes'", db_photo, $uri)
							->fetchAssoc();
if(!$news) {
	cmfGlobal::set('$menuId', 'photo');
	return 'infoUrl';
}
$news['date'] = cmfView::date(strtotime($news['date']));
$this->assing('news', $news);


/* изображения */
$res =  cmfRegister::getSql()->placeholder("SELECT id, name, image_main AS main, image_section AS section FROM ?t WHERE photo=? AND visible='yes' AND image IS NOT NULL ORDER BY pos DESC", db_photo_image, $news['id'])
                             ->fetchAssocAll();
$_image = array();
foreach($res as $v) {
    $_image[$v['id']] = array('title'=>cmfString::specialchars($v['name'] ? $v['name'] : $news['header']),
                              'main'=>cmfBaseImg . cmfPathPhoto . $v['main'],
                              'section'=>cmfBaseImg . cmfPathPhoto . $v['section']);
}
if($_image) {
    $this->assing('_image', $_image);
}

cmfMenu::add('Фоторепортажи', cmfGetUrl('/photo/all/'));
cmfMenu::add($news['header']);

cmfSeo::set('title', $news['title']);
cmfSeo::set('keywords', $news['keywords']);
cmfSeo::set('description', $news['description']);

cmfHeader::setJs('/sourseJs/ad-gallery/jquery.ad-gallery.js');
cmfHeader::setCss('/sourseJs/ad-gallery/jquery.ad-gallery.css');

?>
