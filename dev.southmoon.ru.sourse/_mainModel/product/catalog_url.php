<?php


if(cmfPages::getParam(3)==='search') return '/section/search/';
$row = cmfRegister::getSql()->placeholder("SELECT page, id AS section, brand, product FROM ?t WHERE url=?", db_content_url, cmfPages::getParam(5))
							->fetchRow();
if(!$row) return 404;
list($page, $section, $brand, $product) = $row;

cmfGlobal::set('$sectionId', $section);
cmfGlobal::set('$brandId', $brand);
cmfGlobal::set('$productId', $product);
switch($page) {
	case '/section/':
		return '/section/';

	case '/brand/':
		if($section) {
    		return '/brand/section/';
        } else {
        	return '/brand/';
        }

	case '/product/':
		if(count(cmfPages::getParamAll())==5) {
		    return '/product/';
		} else {
		    return 404;
		}
}


cmfGlobal::set('$infoUri', cmfString::substr(cmfPages::getParam(1)));
return $page;

?>