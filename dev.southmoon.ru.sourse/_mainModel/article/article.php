<?php

cmfGlobal::set('$headerId', 'article');
$uri = cmfPages::getParam(1);
if(!$uri) return 404;
$news = cmfRegister::getSql()->placeholder("SELECT id, date, header, content, title, keywords, description FROM ?t WHERE uri=? AND visible='yes'", db_article, $uri)
							->fetchAssoc();
if(!$news) {
	cmfGlobal::set('$menuId', 'article');
	return 'infoUrl';
}
$news['date'] = cmfView::date(strtotime($news['date']));
$this->assing('news', $news);


/* attach */
$res = cmfRegister::getSql()->placeholder("SELECT  p.id, p.name, u.url, p.price, p.image_small AS image FROM ?t p LEFT JOIN ?t u ON(u.product=p.id) WHERE u.product=p.id AND p.id IN(SELECT product2 FROM ?t WHERE article=?) AND u.brand='0' AND p.count>'0' ORDER BY name", db_product, db_product_url, db_article_attach, $news['id'])
                ->fetchAssocAll();
$attach = array();
foreach($res as $row) {
    $attach[$row['id']] = array('title'=>cmfString::specialchars($row['name']),
                                'image'=>cmfBaseImg . cmfPathProduct . $row['image'],
                                'url'=>cmfGetUrl('/product/', array($row['url'])));
}
if($attach) {
    $this->assing('attach', $attach);
}


cmfMenu::add('Статьи', cmfGetUrl('/article/all/'));
cmfMenu::add($news['header']);

cmfSeo::set('title', $news['title']);
cmfSeo::set('keywords', $news['keywords']);
cmfSeo::set('description', $news['description']);

?>
