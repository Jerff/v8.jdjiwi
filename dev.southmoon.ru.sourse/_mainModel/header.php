<?php


include_once(cmfModel .'header.include.php');

if($head = cmfCache::get('_header')) {
	list($head, $callback, $isCallBack, $content, $showcase, $_catalog) = $head;
} else {

	$head = cmfConfig::get('seo', 'head');
    $callback = cmfConfig::get('user', 'callback');
    $isCallBack = cmfConfig::get('showcase', 'callBackOn')==='yes';

	$showcase = cmfConfig::get('showcase');
	$showcase['logo'] = cmfBaseImg . cmfPathConfig . $showcase['logo'];
	$showcase['phone'] = array_map('trim', explode(',', $showcase['phone']));
	foreach($showcase['phone'] as $k=>$v) {
        $showcase['phone'][$k] = explode(')', $v);
    	$showcase['phone'][$k][0] .= ')';
	}

	$phone = cmfRegister::getSql()->placeholder("SELECT phone FROM ?t WHERE id='contact/main' LIMIT 0, 1", db_main)
									->fetchRow(0);
	$_catalog = cmfRegister::getSql()->placeholder("SELECT id, name, isUri FROM ?t WHERE parent='0' AND id IN(SELECT section FROM ?t WHERE brand='0' AND isMenu='yes') AND isVisible='yes' ORDER BY pos", db_section, db_section_is_brand)
									->fetchAssocAll('id');
	foreach($_catalog as $id=>$v) {
		$_catalog[$id] = array(	'name'=>nl2br($v['name']),
								'url'=>cmfGeturl('/section/', array($v['isUri'])));
	}

	$url = cmfPages::getUri();
	$content = cmfRegister::getSql()->placeholder("SELECT content FROM ?t WHERE `type`='header' AND adress=? AND visible='yes' LIMIT 0, 1", db_content_pages, $url)
									->fetchRow(0);
	if(!$content) {
	    $res = cmfRegister::getSql()->placeholder("SELECT adress, content FROM ?t WHERE `type`='header' AND isReg='yes' AND visible='yes'", db_content_pages)
									->fetchAssocAll();
		foreach($res as $v) {
            $preg = str_replace('\{\*\}', '.*', preg_quote($v['adress']));
            if(preg_match('~'. $preg .'~is', $url)) {
                $content = $v['content'];
                break;
            }
		}
	}

	cmfCache::set('_header', array($head, $callback, $isCallBack, $content, $showcase, $_catalog), 'sectionList,contact');
}
cmfMenu::select('$rootId', $_catalog);

$this->assing('head', $head);
$this->assing('showcase', $showcase);

$this->assing('callback', $callback);
if($content)
    $this->assing('content', $content);

if($isCallBack) {
    $this->assing2('callBackUrl', cmfGetUrl('/call-back/'));
}
$this->assing2('index', cmfGetUrl('/index/'));
$this->assing2('basket', cmfGetUrl('/basket/'));
$this->assing('_catalog', $_catalog);


$this->assing2('userRegister', cmfGetUrl('/user/register/'));
$this->assing2('userEnter',    cmfGetUrl('/user/enter/'));
$this->assing2('user',         cmfGetUrl('/user/'));
$this->assing2('userExit',     cmfGetUrl('/user/exit/'));


$this->assing2('isMain',    cmfPages::isMain('/index/'));

$this->assing2('searchUrl', cmfGlobal::is('$searchUrl') ? cmfGlobal::get('$searchUrl') : cmfGeturl('/search/'));
$this->assing2('defaultName', 'Поиск...');
$this->assing2('searchName', cmfGlobal::get('$searchName', 'Поиск...'));


?>
