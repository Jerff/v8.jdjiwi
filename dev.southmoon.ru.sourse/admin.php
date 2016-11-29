<?php

define('cmfPart', 'admin');

chdir(dirname(__FILE__));
define('cmfRoot', realpath(dirname(__FILE__) .'/../') .'/');

// конфигурация
require('_.config/config.php');
require('_.config/configProject.php');


// системный кеш
if(cmfComplile)  {

	require(cmfCompileLib .'.includeAdmin.php');
} else {

	require('.includeAdmin.php');
}
//cmfDebug::setError();
//cmfDebug::setSql();
cmfCache::setPages();
cmfCache::setData();





set_time_limit(0);
// get_magic_quotes_gpc
cmfStripSlashesPost();
cmfPages::setBase($_b);
unset($_b);

/*if(stripos($_SERVER['HTTP_HOST'], 'www.')===0) {
    cmfRedirectSeo('http://'. substr($_SERVER['HTTP_HOST'], 4) . $_SERVER['REQUEST_URI']);
}*/

$admin = cmfRegister::getAdmin();
if(cmfAjax::is()) {
	if(!$admin->is()) {
		cmfPages::setMain('/admin/enter/');
	}
	if(cmfPages::isMain('/admin/index/') or ($admin->is() and cmfPages::isMain('/admin/enter/'))) {
		cmfAjax::get()->redirect(cmfProjectAdmin);
	}
	if(cmfAjax::isCommand('exit')) {
		$admin->logOut();
		cmfAjax::get()->alert('Выход из системы')
		              ->reload();
	}
}
$admin->is();
if($admin->debugError==='yes')	cmfDebug::setError();
if($admin->debugSql==='yes')	cmfDebug::setSql();
//if($admin->debugExplain==='yes')cmfDebug::setExplain();
unset($admin);

ob_start();
$controler = new cmfAdminTemplate();
$controler->main();

cmfDebug::getMemory();
?>
