<?php

$info = cmfRegister::getSql()->placeholder("SELECT * FROM ?t WHERE id='contact'", db_main)
							->fetchAssoc();
if(!$info) return 404;
$this->assing('info', $info);

cmfSeo::set('title', $info['title']);
cmfSeo::set('keywords', $info['keywords']);
cmfSeo::set('description', $info['description']);

cmfMenu::add('Контакты');
cmfGlobal::set('$catalogId', 'contact');

$office = cmfRegister::getSql()->placeholder("SELECT * FROM ?t WHERE id='contact/main'", db_main)
							->fetchAssoc();
$mapYandexApi = explode("\n", str_replace("\r", '', $office['mapYandexApi']));
if(false!==($res=array_search(cmfGetUrl('/index/'), $mapYandexApi))) {
	if(isset($mapYandexApi[$res+1])) {
		cmfHeader::setJsSourse('http://api-maps.yandex.ru/1.1/index.xml?key='. $mapYandexApi[$res+1]);
		$this->assing2('office', $office);
    }
}

?>