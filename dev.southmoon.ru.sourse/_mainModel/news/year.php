<?php

$year = (int)cmfPages::getParam(2);
$page = (int)cmfPages::getParam(4);
if(!$page) $page = 1;

if($year) {
    $year = cmfRegister::getSql()->placeholder("SELECT YEAR(date) AS y FROM ?t WHERE visible='yes' AND YEAR(date)=? GROUP BY y ORDER BY y DESC LIMIT 0, 1", db_news, $year)
								->fetchRow(0);
} else {
    $year = cmfRegister::getSql()->placeholder("SELECT YEAR(date) AS y FROM ?t WHERE visible='yes' GROUP BY y ORDER BY y DESC LIMIT 0, 1", db_news)
								->fetchRow(0);
}
if(!$year) return 404;

$limit = cmfConfig::get('news', 'newsLimit');
$offset = ($page-1)*$limit;
if($offset>3000) return 404;
$res = cmfRegister::getSql()->placeholder("SELECT SQL_CALC_FOUND_ROWS id, uri, header, notice, date FROM ?t WHERE visible='yes' AND YEAR(date)=? ORDER BY isMain, date DESC LIMIT ?i, ?i", db_news, $year, $offset, $limit)
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
$first = null;
foreach($_year as $k=>$row) {
	if(empty($first)) $first = $k;
	$_year[$k] = array(	'name'=>$k,
	                    'url'=>$first===$k ? cmfGetUrl('/news/year/all/', array($k)) :  cmfGetUrl('/news/year/', array($k)));
}

$_page_url = cmfPagination::generate($page, $count, $limit, cmfConfig::get('news', 'newsPage'),
    create_function('&$page, $k, $v', '
    	if('. $first .'=='. $year .') {
    	    $page[$k]["url"] = $k==1 ? cmfGetUrl("/news/year/all/") : cmfGetUrl("/news/year/all/page/", array($k));
    	} else {
    	    $page[$k]["url"] = $k==1 ? cmfGetUrl("/news/year/", array('. $year .')) : cmfGetUrl("/news/year/page/", array('. $year .', $k));
    	}
 ;'));
$this->assing('_news', $_news);
if($_page_url) $this->assing('_page_url', $_page_url);
if($_year) {
    reset($_year);
    $this->assing('_year', $_year);
}


cmfMenu::add('Новости', cmfGetUrl('/news/all/'));
cmfMenu::add($year);

?>
