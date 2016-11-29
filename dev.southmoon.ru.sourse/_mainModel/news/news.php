<?php

cmfGlobal::set('$headerId', 'news');
$uri = cmfPages::getParam(1);
if(!$uri) return 404;
$news = cmfRegister::getSql()->placeholder("SELECT id, date, header, content, title, keywords, description FROM ?t WHERE uri=? AND visible='yes'", db_news, $uri)
							->fetchAssoc();
if(!$news) {
	cmfGlobal::set('$menuId', 'news');
	return 'infoUrl';
}
$news['date'] = cmfView::date(strtotime($news['date']));
$this->assing('news', $news);

cmfMenu::add('Новости', cmfGetUrl('/news/all/'));
cmfMenu::add($news['header']);

cmfSeo::set('title', $news['title']);
cmfSeo::set('keywords', $news['keywords']);
cmfSeo::set('description', $news['description']);

?>
