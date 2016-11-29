<?php

$page = (int)cmfPages::getParam(1);
if(!$page) $page = 1;

$limit = cmfConfig::get('news', 'newsLimit');
$offset = ($page-1)*$limit;
if($offset>3000) return 404;
$res = cmfRegister::getSql()->placeholder("SELECT SQL_CALC_FOUND_ROWS id, uri, header, notice, date FROM ?t WHERE visible='yes' ORDER BY isMain, date DESC LIMIT ?i, ?i", db_news, $offset, $limit)
								->fetchAssocAll();
if(!$res) {
	return 404;
}
$_news = array();
foreach($res as $row) {
	$_news[] = array(	'date'=>date('d.m.Y', strtotime($row['date'])),
						'header'=>$row['header'],
						'notice'=>nl2br($row['notice']),
						'url'=>cmfGetUrl('/news/', array($row['uri'])));
}
$count = cmfRegister::getSql()->getFoundRows();


$_year = cmfRegister::getSql()->placeholder("SELECT YEAR(date) AS y FROM ?t WHERE visible='yes' GROUP BY y ORDER BY y DESC", db_news)
								->fetchRowAll(0, 0);
$itemYear = null;
foreach($_year as $k=>$row) {
	if(empty($itemYear)) $itemYear = $k;
	$_year[$k] = array(	'name'=>$k,
	                    'url'=>$itemYear===$k ? cmfGetUrl('/news/year/all/', array($k)) :  cmfGetUrl('/news/year/', array($k)));
}

$_page_url = cmfPagination::generate($page, $count, $limit, cmfConfig::get('news', 'newsPage'),
    create_function('&$page, $k, $v', '
    	$page[$k]["url"] = $k==1 ? cmfGetUrl("/news/all/") : cmfGetUrl("/news/page/", array($k));'));
$this->assing('_news', $_news);
if($_page_url) $this->assing('_page_url', $_page_url);
if($_year) {
    reset($_year);
    $this->assing('_year', $_year);
}


cmfMenu::add('Новости');

?>
