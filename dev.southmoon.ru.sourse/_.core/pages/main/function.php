<?php

function cmfGetUrl($page, $param=null) {
	$conf = cmfPages::getPage($page);
	if(!isset($conf['url'])) return false;
	return cmfPages::getBase($conf['part']) . cmfUrl::reform($conf['url'], $param);
}

if(!function_exists('cmfGetAdminUrl')) {
    function cmfGetAdminUrl($page, $param=null) {
    	$uri = cmfPages::getPageFlag($page, 'url');
    	if(!$uri) return false;
    	return cmfPages::getBase('admin') . cmfUrl::reform($uri, $param) .'#';
    }
}



function cmfGetLangUrl($lang, $page, $param=null) {
	$conf = cmfPages::getPage($page);
	if(!isset($conf['url'])) return false;
	return cmfPages::getBase($conf['part']) . mfUrl::reform($conf['url'], $param);
}

function cmfGetUri($page, $param=null) {
	$conf = cmfPages::getPage($page);
	if(!isset($conf['url'])) return false;
	return cmfUrl::reform($conf['url'], $param);
}

?>